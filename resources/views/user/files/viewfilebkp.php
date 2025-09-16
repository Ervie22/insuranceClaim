@extends('layouts.app')

@section('content')
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
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

    #map2 {
        height: 600px;
        width: 100%;
    }

    .tile-info2 {
        background: rgba(255, 255, 255, 0.8);
        padding: 5px;
        border-radius: 3px;
        font-size: 12px;
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1000;
    }




    /* Customize active tab */
    .nav-tabs .nav-link.active {
        background-color: #8A6FDE;
        /* blue background */
        color: #fff !important;
        /* white text */
        font-weight: bold;
        border-color: #8A6FDE #8A6FDE #fff;
    }

    /* Optional: hover effect */
    .nav-tabs .nav-link:hover {
        background-color: #e9ecef;
        color: #8A6FDE;
    }

    /* Optional: hover effect */
    .nav-tabs .nav-link {
        color: #8A6FDE;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-body">
                    <h4> <strong>Pathology Slide Viewer</strong> </h4>
                    <p>Interactive viewer for histopathology slides</p>
                </div>
                <div class="card-body">
                    <div class="row" style="height:600px;">
                        <!-- LEFT SIDE: TABS + CONTENT -->
                        <div class="col-10">
                            <div class="container-fluid p-0 w-100 h-100">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs w-100" id="myTab" role="tablist">
                                    @if(isset($getHEFile['file_name']))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">H&E</button>
                                    </li>
                                    @endif
                                    @if(isset($getHERFile['file_name']))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab">HER2</button>
                                    </li>
                                    @endif

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content mt-3 w-100 h-100 ">
                                    @if(isset($getHEFile['file_name']))
                                    <div class="tab-pane fade show active w-100 h-100" id="tab1" role="tabpanel">
                                        <h2>{{$getHEFile['study_name']}}</h2>
                                        <form id="layerForm" class="mb-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="name" placeholder="Layer Name" class="form-control mb-2" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div id="map" class="w-100 h-100 border">
                                            <div class="tile-info" id="tileInfo">
                                                Tiles: <span id="tileCount">0</span> | Zoom: <span id="zoomLevel">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if(isset($getHERFile['file_name']))
                                    <div class="tab-pane fade w-100 h-100" id="tab2" role="tabpanel">
                                        <div class="tab-pane fade show active w-100 h-100" id="tab1" role="tabpanel">
                                            <h2>{{$getHERFile['study_name']}}</h2>
                                            <form id="layerForm2" class="mb-3">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" name="name2" placeholder="Layer Name" class="form-control mb-2" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div id="map2" class="w-100 h-100 border">
                                                <div class="tile-info2" id="tileInfo2">
                                                    Tiles: <span id="tileCount2">0</span> | Zoom: <span id="zoomLevel2">0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if(isset($getKIFile['file_name']))
                                    <div class="tab-pane fade w-100 h-100" id="tab3" role="tabpanel">
                                        <p>Displaying Ki-67 content</p>
                                    </div>
                                    @endif

                                    @if(isset($getERFile['file_name']))
                                    <div class="tab-pane fade w-100 h-100" id="tab4" role="tabpanel">
                                        <p>Displaying ER content</p>
                                    </div>
                                    @endif

                                    @if(isset($getPGRile['file_name']))
                                    <div class="tab-pane fade w-100 h-100" id="tab5" role="tabpanel">
                                        <p>Displaying PGR content</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE: SLIDE INFO -->
                        <div class="col-2">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6><strong>Slide Information</strong></h6>
                                    <!-- Add more info if required -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function openTab(id) {
        var studyid = "<?php echo $study_id; ?>";
        window.location = '/view/jobs/' + studyid + '/' + id;
    }
    $(document).ready(function() {
        // Get the base tile URL from Laravel
        const baseTileUrl = "{{ $getHEFile['result_url'] }}";
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