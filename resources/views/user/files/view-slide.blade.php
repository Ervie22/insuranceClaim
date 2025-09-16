@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />

<style>
    #map {
        height: 600px;
        width: 100%;
    }

    .zoom-controls {
        margin-bottom: 10px;
    }

    .tile-info {
        background: rgba(255, 255, 255, 0.8);
        padding: 5px;
        border-radius: 3px;
        font-size: 12px;
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1000;
    }
</style>

<div>
    <h2>{{$getFile['study_name']}}</h2>


    <!--
    <form id="layerForm">
        <input type="text" name="name" placeholder="Layer Name" class="form-control mb-2" required>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    -->

    <div id="map">
        <div class="tile-info" id="tileInfo">
            Tiles: <span id="tileCount">0</span> | Zoom: <span id="zoomLevel">0</span>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

<script>
    $(document).ready(function() {
        // Get the base tile URL from Laravel
        const baseTileUrl = "{{ $getFile['result_url'] }}";
        console.log("Base tile URL:", baseTileUrl);

        // Extract the base URL (everything before {z})
        const baseUrl = baseTileUrl.substring(0, baseTileUrl.indexOf('{z}'));
        console.log("Extracted base URL:", baseUrl);

        // Initialize the map with CRS.Simple for non-geographic images
        const map = L.map('map', {
            crs: L.CRS.Simple,
            minZoom: 0,
            maxZoom: 10,
            center: [0, 0],
            zoom: 2
        });

        // Custom tile layer class for better error handling
        const DeepZoomTileLayer = L.TileLayer.extend({
            initialize: function(url, options) {
                L.TileLayer.prototype.initialize.call(this, url, options);
                this.tileCount = 0;
            },

            createTile: function(coords, done) {
                const tile = document.createElement('img');

                // Handle tile load
                L.DomEvent.on(tile, 'load', function() {
                    this.tileCount++;
                    this._updateTileInfo();
                    done(null, tile);
                }.bind(this));

                // Handle tile error
                L.DomEvent.on(tile, 'error', function() {
                    console.warn(`Tile not found: ${coords.z}/${coords.x}/${coords.y}`);
                    // Create a placeholder tile
                    tile.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==';
                    done(null, tile);
                });

                // Set the tile URL
                tile.src = this.getTileUrl(coords);
                return tile;
            },

            _updateTileInfo: function() {
                $('#tileCount').text(this.tileCount);
            }
        });

        // Create the tile layer
        const tileLayer = new DeepZoomTileLayer(baseTileUrl, {
            attribution: 'Pathology Deep Zoom',
            tileSize: 256,
            noWrap: true,
            bounds: [
                [-1000, -1000],
                [1000, 1000]
            ] // Adjust based on your image dimensions
        });

        // Add tile layer to map
        tileLayer.addTo(map);

        // Auto-detect optimal zoom and bounds
        function autoDetectImageBounds() {
            const testPromises = [];
            const maxTestZoom = 6;

            // Test different zoom levels to find available tiles
            for (let z = 0; z <= maxTestZoom; z++) {
                const testUrl = baseUrl + `${z}/0/0.png`;
                testPromises.push(
                    fetch(testUrl, {
                        method: 'HEAD'
                    })
                    .then(response => ({
                        zoom: z,
                        available: response.ok
                    }))
                    .catch(() => ({
                        zoom: z,
                        available: false
                    }))
                );
            }

            Promise.all(testPromises).then(results => {
                const availableZooms = results.filter(r => r.available).map(r => r.zoom);
                console.log("Available zoom levels:", availableZooms);

                if (availableZooms.length > 0) {
                    const maxZoom = Math.max(...availableZooms);
                    const minZoom = Math.min(...availableZooms);

                    // Update tile layer options
                    tileLayer.options.maxZoom = maxZoom;
                    tileLayer.options.minZoom = minZoom;

                    // Set initial view
                    map.setView([0, 0], minZoom + 1);

                    console.log(`Set zoom range: ${minZoom} - ${maxZoom}`);
                }
            });
        }

        // Run auto-detection
        autoDetectImageBounds();

        // Drawing functionality
        let drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        const drawControl = new L.Control.Draw({
            draw: {
                polygon: true,
                polyline: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: {
                featureGroup: drawnItems
            }
        });
        map.addControl(drawControl);

        let latestLayer = null;

        map.on(L.Draw.Event.CREATED, function(event) {
            drawnItems.clearLayers();
            latestLayer = event.layer;
            drawnItems.addLayer(latestLayer);
        });

        // Zoom event handlers
        map.on('zoomend', function() {
            const currentZoom = map.getZoom();
            $('#currentZoom').text('Zoom: ' + currentZoom);
            $('#zoomLevel').text(currentZoom);
            tileLayer.tileCount = 0; // Reset tile count on zoom change
        });

        // Control buttons
        $('#zoomIn').click(function() {
            map.zoomIn();
        });

        $('#zoomOut').click(function() {
            map.zoomOut();
        });

        $('#fitBounds').click(function() {
            if (tileLayer.options.bounds) {
                map.fitBounds(tileLayer.options.bounds);
            } else {
                map.setView([0, 0], 2);
            }
        });

        // Form submission
        $('#layerForm').on('submit', function(e) {
            e.preventDefault();
            if (!latestLayer) return alert("Draw something first!");

            const geojson = latestLayer.toGeoJSON();
            const name = $('input[name="name"]').val();

            $.ajax({
                url: "{{ route('map.store') }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    geojson: JSON.stringify(geojson),
                    study_id: '{{ $getFile["id"] ?? "" }}'
                },
                success: function(res) {
                    alert("Layer Saved!");
                    $('#layerForm')[0].reset();
                    drawnItems.clearLayers();
                    latestLayer = null;
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("Save failed");
                }
            });
        });

        // Load existing layers
        $.get("{{ route('map.load') }}", function(data) {
            data.forEach(layer => {
                const geoLayer = L.geoJSON(JSON.parse(layer.geojson), {
                    style: {
                        color: '#ff0000',
                        weight: 2,
                        opacity: 0.8,
                        fillOpacity: 0.3
                    }
                });
                geoLayer.addTo(map);

                // Add popup with layer name
                geoLayer.bindPopup(`<strong>${layer.name}</strong>`);
            });
        }).fail(function() {
            console.warn("Could not load existing layers");
        });
    });
</script>
@endsection