let map1Initialized = false;
let map2Initialized = false;

$('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
    const targetTab = $(e.target).attr("data-bs-target");

    if (targetTab === "#tab1-tab" && !map1Initialized) {
        initMap1();
        map1Initialized = true;
    } else if (targetTab === "#tab2-tab" && !map2Initialized) {
        initMap2();
        map2Initialized = true;
    } else {
        // Invalidate only if already initialized
        setTimeout(() => {
            if (targetTab === "#tab1-tab" && window.map1) map1.invalidateSize();
            if (targetTab === "#tab2-tab" && window.map2) map2.invalidateSize();
        }, 100);
    }
});

// Optionally, trigger the first map on load
$(document).ready(function () {
    $('a[data-bs-toggle="tab"].active').trigger("shown.bs.tab");
});

function initMap1() {
    // ... your current Tab 1 full code goes here, with changes:
    // Replace: const map1 = L.map(...)
    // With:    window.map1 = L.map(...)
    const baseTileUrl = "{{ $getHEFile['result_url'] }}";
    // console.log("Base tile URL:", baseTileUrl);

    // Extract the base URL (everything before {z})
    const baseUrl = baseTileUrl.substring(0, baseTileUrl.indexOf("{z}"));
    // console.log("Extracted base URL:", baseUrl);

    // Initialize the map with CRS.Simple for non-geographic images
    window.map1 = L.map("map-tab1", {
        crs: L.CRS.Simple,
        minZoom: 0,
        maxZoom: 10,
        center: [-30, 75],
        zoom: 3,
    });
    $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
        if (window.map1) {
            setTimeout(() => map1.invalidateSize(), 100);
        }
        if (window.map2) {
            setTimeout(() => map2.invalidateSize(), 100);
        }
    });
    // Custom tile layer class for better error handling
    const DeepZoomTileLayer = L.TileLayer.extend({
        initialize: function (url, options) {
            L.TileLayer.prototype.initialize.call(this, url, options);
            this.tileCount = 0;
        },

        createTile: function (coords, done) {
            const tile = document.createElement("img");
            // Show the loading spinner
            $("#mapLoadingSpinner1").show();
            // Handle tile load
            L.DomEvent.on(
                tile,
                "load",
                function () {
                    this.tileCount++;
                    this._updateTileInfo();
                    done(null, tile);
                    // Hide spinner when tile is loaded
                    $("#mapLoadingSpinner1").hide();
                }.bind(this)
            );

            // Handle tile error
            L.DomEvent.on(tile, "error", function () {
                console.warn(
                    `Tile not found: ${coords.z}/${coords.x}/${coords.y}`
                );
                // Create a placeholder tile
                tile.src =
                    "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==";
                done(null, tile);
                // Hide spinner when tile is loaded
                $("#mapLoadingSpinner1").hide();
            });

            // Set the tile URL
            tile.src = this.getTileUrl(coords);
            return tile;
        },

        _updateTileInfo: function () {
            $("#tileCount").text(this.tileCount);
        },
    });

    // Create the tile layer
    const tileLayer = new DeepZoomTileLayer(baseTileUrl, {
        attribution: "Pathology Deep Zoom",
        tileSize: 256,
        noWrap: true,
        keepBuffer: 4,
        unloadInvisibleTiles: false,
        updateWhenIdle: true,
        updateWhenZooming: false,
        bounds: [
            [-1000, -1000],
            [1000, 1000],
        ], // Adjust based on your image dimensions
    });

    // Add tile layer to map
    tileLayer.addTo(map1);

    // Auto-detect optimal zoom and bounds
    function autoDetectImageBounds() {
        const testPromises = [];
        const maxTestZoom = 6;

        // Test different zoom levels to find available tiles
        for (let z = 0; z <= maxTestZoom; z++) {
            const testUrl = baseUrl + `${z}/0/0.png`;
            testPromises.push(
                fetch(testUrl, {
                    method: "HEAD",
                })
                    .then((response) => ({
                        zoom: z,
                        available: response.ok,
                    }))
                    .catch(() => ({
                        zoom: z,
                        available: false,
                    }))
            );
        }

        Promise.all(testPromises).then((results) => {
            const availableZooms = results
                .filter((r) => r.available)
                .map((r) => r.zoom);
            console.log("Available zoom levels:", availableZooms);

            if (availableZooms.length > 0) {
                const maxZoom = Math.max(...availableZooms);
                const minZoom = Math.min(...availableZooms);

                // Update tile layer options
                tileLayer.options.maxZoom = maxZoom;
                tileLayer.options.minZoom = minZoom;

                // Set initial view
                map1.setView([0, 0], minZoom + 1);

                console.log(`Set zoom range: ${minZoom} - ${maxZoom}`);
            }
        });
    }

    // Run auto-detection
    autoDetectImageBounds();

    // Drawing functionality
    let drawnItems = new L.FeatureGroup();
    map1.addLayer(drawnItems);

    const drawControl = new L.Control.Draw({
        draw: {
            polygon: false,
            polyline: false,
            rectangle: true,
            circle: false,
            marker: false,
            circlemarker: false,
        },
        edit: {
            featureGroup: drawnItems,
        },
    });
    map1.addControl(drawControl);

    let latestLayer = null;

    map1.on(L.Draw.Event.CREATED, function (event) {
        drawnItems.clearLayers();
        latestLayer = event.layer;
        drawnItems.addLayer(latestLayer);
    });

    // Zoom event handlers
    map1.on("zoomend", function () {
        const currentZoom = map1.getZoom();
        $("#currentZoom").text("Zoom: " + currentZoom);
        $("#zoomLevel").text(currentZoom);
        tileLayer.tileCount = 0; // Reset tile count on zoom change
    });

    // Control buttons
    $("#zoomIn").click(function () {
        map1.zoomIn();
    });

    $("#zoomOut").click(function () {
        map1.zoomOut();
    });

    $("#fitBounds").click(function () {
        if (tileLayer.options.bounds) {
            map1.fitBounds(tileLayer.options.bounds);
        } else {
            map1.setView([0, 0], 2);
        }
    });

    // Form submission
    $("#layerForm1").on("submit", function (e) {
        e.preventDefault();
        if (!latestLayer) return alert("Draw something first!");

        const geojson = latestLayer.toGeoJSON();
        const name = $('input[name="name"]').val();

        $.ajax({
            url: "{{ route('map.store') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                name: name,
                geojson: JSON.stringify(geojson),
                study_id: '{{ $study_id ?? "" }}',
            },
            success: function (res) {
                alert("Layer Saved!");
                $("#layerForm1")[0].reset();
                drawnItems.clearLayers();
                latestLayer = null;
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert("Save failed");
            },
        });
    });
    const studyId = "<?php echo $study_id; ?>";
    // Load existing layers
    $.get(
        "{{ route('map.load') }}",
        {
            study_id: studyId,
        },
        function (data) {
            data.forEach((layer) => {
                const geoLayer = L.geoJSON(JSON.parse(layer.geojson), {
                    style: {
                        color: "#ff0000",
                        weight: 2,
                        opacity: 0.8,
                        fillOpacity: 0.3,
                    },
                });
                geoLayer.addTo(map1);

                // Add popup with layer name
                geoLayer.bindPopup(`<strong>${layer.name}</strong>`);
            });
        }
    ).fail(function () {
        console.warn("Could not load existing layers");
    });
    // Zoom sync logic — add in both maps
    window.map1.on("zoomend", () => {
        if (window.map2 && !window.syncing) {
            window.syncing = true;
            window.map2.setZoom(window.map1.getZoom());
            window.syncing = false;
        }
    });
    if (window.map1 && window.map2) {
        const commonZoom = Math.min(map1.getZoom(), map2.getZoom());
        map1.setZoom(commonZoom);
        map2.setZoom(commonZoom);
    }
}

function initMap2() {
    // ... your current map2 code here (with tileLayer, autoDetect, etc.)
    // Replace: const map2 = L.map(...)
    // With:    window.map2 = L.map(...)
    const baseTileUrl = "{{ $getHERFile['result_url'] }}";
    const baseUrl = baseTileUrl.substring(0, baseTileUrl.indexOf("{z}"));

    // Initialize map-tab2
    window.map2 = L.map("map-tab2", {
        crs: L.CRS.Simple,
        minZoom: 0,
        maxZoom: 10,
        center: [-30, 75],
        zoom: 3,
    });
    $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
        if (window.map1) {
            setTimeout(() => map1.invalidateSize(), 100);
        }
        if (window.map2) {
            setTimeout(() => map2.invalidateSize(), 100);
        }
    });
    const DeepZoomTileLayer = L.TileLayer.extend({
        initialize: function (url, options) {
            L.TileLayer.prototype.initialize.call(this, url, options);
            this.tileCount = 0;
        },
        createTile: function (coords, done) {
            const tile = document.createElement("img");
            $("#mapLoadingSpinner2").show();
            L.DomEvent.on(
                tile,
                "load",
                function () {
                    this.tileCount++;
                    this._updateTileInfo();
                    done(null, tile);
                    $("#mapLoadingSpinner2").hide();
                }.bind(this)
            );
            L.DomEvent.on(tile, "error", function () {
                tile.src =
                    "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==";
                done(null, tile);
                $("#mapLoadingSpinner2").hide();
            });
            tile.src = this.getTileUrl(coords);
            return tile;
        },
        _updateTileInfo: function () {
            $("#tileCount2").text(this.tileCount);
        },
    });

    const tileLayer = new DeepZoomTileLayer(baseTileUrl, {
        attribution: "Pathology Deep Zoom",
        tileSize: 256,
        noWrap: true,
        keepBuffer: 4,
        unloadInvisibleTiles: false,
        updateWhenIdle: true,
        updateWhenZooming: false,
        bounds: [
            [-1000, -1000],
            [1000, 1000],
        ],
        keepBuffer: 2,
    });

    tileLayer.addTo(map2);

    function autoDetectImageBounds() {
        const testPromises = [];
        const maxTestZoom = 6;
        for (let z = 0; z <= maxTestZoom; z++) {
            const testUrl = baseUrl + `${z}/0/0.png`;
            testPromises.push(
                fetch(testUrl, {
                    method: "HEAD",
                })
                    .then((response) => ({
                        zoom: z,
                        available: response.ok,
                    }))
                    .catch(() => ({
                        zoom: z,
                        available: false,
                    }))
            );
        }

        Promise.all(testPromises).then((results) => {
            const availableZooms = results
                .filter((r) => r.available)
                .map((r) => r.zoom);
            if (availableZooms.length > 0) {
                const maxZoom = Math.max(...availableZooms);
                const minZoom = Math.min(...availableZooms);
                tileLayer.options.maxZoom = maxZoom;
                tileLayer.options.minZoom = minZoom;
                map2.setView([0, 0], minZoom + 1);
            }
        });
    }

    autoDetectImageBounds();

    let drawnItems = new L.FeatureGroup();
    map2.addLayer(drawnItems);

    let latestLayer = null;

    map2.on(L.Draw.Event.CREATED, function (event) {
        drawnItems.clearLayers();
        latestLayer = event.layer;
        drawnItems.addLayer(latestLayer);
    });

    map2.on("zoomend", function () {
        const currentZoom = map2.getZoom();
        $("#currentZoom").text("Zoom: " + currentZoom);
        $("#zoomLevel2").text(currentZoom);
        tileLayer.tileCount = 0;
    });

    $("#zoomIn").click(function () {
        map2.zoomIn();
    });

    $("#zoomOut").click(function () {
        map2.zoomOut();
    });

    $("#fitBounds").click(function () {
        if (tileLayer.options.bounds) {
            map2.fitBounds(tileLayer.options.bounds);
        } else {
            map2.setView([0, 0], 2);
        }
    });

    const studyId = "<?php echo $study_id; ?>";
    $.get(
        "{{ route('map.load') }}",
        {
            study_id: studyId,
        },
        function (data) {
            data.forEach((layer) => {
                const geoLayer = L.geoJSON(JSON.parse(layer.geojson), {
                    style: {
                        color: "#ff0000",
                        weight: 2,
                        opacity: 0.8,
                        fillOpacity: 0.3,
                    },
                });
                geoLayer.addTo(map2);
                geoLayer.bindPopup(`<strong>${layer.name}</strong>`);
            });
        }
    ).fail(function () {
        console.warn("Could not load existing layers");
    });

    // ✅ Add zoom sync logic — ensure map1 is already loaded
    let syncing = false;

    map2.on("zoomend", function () {
        if (!syncing && window.map1) {
            syncing = true;
            map1.setZoom(map2.getZoom());
            syncing = false;
        }
    });

    if (window.map1) {
        map1.on("zoomend", function () {
            if (!syncing) {
                syncing = true;
                map2.setZoom(map1.getZoom());
                syncing = false;
            }
        });
    }
    window.map2.on("zoomend", () => {
        if (window.map1 && !window.syncing) {
            window.syncing = true;
            window.map1.setZoom(window.map2.getZoom());
            window.syncing = false;
        }
    });
    if (window.map1 && window.map2) {
        const commonZoom = Math.min(map1.getZoom(), map2.getZoom());
        map1.setZoom(commonZoom);
        map2.setZoom(commonZoom);
    }
}
