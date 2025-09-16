@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<!-- Bootstrap 5 CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

<style>
    #map-tab1 {
        position: relative;
        height: 600px;
        width: 100%;
    }

    #map-tab2 {
        height: 600px;
        position: relative;
        width: 100%;
    }

    #map-tab3 {
        height: 600px;
        position: relative;
        width: 100%;
    }

    #map-tab4 {
        height: 600px;
        position: relative;
        width: 100%;
    }

    #map-tab5 {
        height: 600px;
        position: relative;
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

    .tile-info3 {
        background: rgba(255, 255, 255, 0.8);
        padding: 5px;
        border-radius: 3px;
        font-size: 12px;
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1000;
    }

    .tile-info4 {
        background: rgba(255, 255, 255, 0.8);
        padding: 5px;
        border-radius: 3px;
        font-size: 12px;
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1000;
    }

    .tile-info5 {
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

    .content {
        min-height: 800px !important
    }

    .map-content {
        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 999;
        transform: translate(-50%, -50%);
        display: none;
    }

    .closeReportBtn {
        position: absolute;
        top: 4px;
        right: 8px;
        cursor: pointer;
        font-weight: bold;
        color: #8b8787ff;
        font-size: 24px;
        line-height: 24px;
        padding: 2px 6px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 4px;
        z-index: 1001;
        user-select: none;
    }

    .closeReportBtn:hover {
        background: rgba(200, 200, 200, 0.9);
    }

    .showReportBtn {
        position: absolute;
        right: 10px;
        padding: 8px 16px;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        font-size: 14px;
        z-index: 1000;
        user-select: none;
        transition: background-color 0.3s ease;
    }

    .showReportBtn:hover {
        background-color: #f0f0f0;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
    }

    #external-toolbar {
        display: flex;
        flex-direction: row;   
        flex-wrap: nowrap;     
        gap: 10px;
    }

    #external-toolbar .leaflet-draw-toolbar {
        display: flex;
        flex-direction: row;  
        gap: 10px;
    }

    .leaflet-draw-toolbar.leaflet-bar {
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
    }

    #external-toolbar .leaflet-draw-toolbar a {
        width: auto !important;      
        height: auto !important;
        background: none !important; 
        border: 1px solid #ccc;
        padding: 5px 10px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        color: #000;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .deleteRoi{
        width: auto !important;      
        height: auto !important;
        background: none !important; 
        border: 1px solid #ccc;
        padding: 7px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        color: #000;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1px;
    }

    #external-toolbar .leaflet-draw-draw-rectangle::after {
        content: "Draw ROI";
    }

    #external-toolbar .leaflet-draw-edit-edit::after {
        content: "Edit ROI";
    }
    #external-toolbar .leaflet-draw-edit-edit {
        margin-top: -16px;  
    }

.leaflet-draw-actions.leaflet-draw-actions-bottom {
    margin-top: 40px; 
    margin-left: 10px;
    position: absolute;  
    top: 0px !important;
    display: block !important;
    left: 0px !important;
}


</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-body">
                    <h4> <strong>{{$getHEFile['study_name']}}</strong> </h4>
                    <!-- <p>Interactive viewer for histopathology slides</p> -->
                </div>
                <div class="card-body ">
                    <div class="row content">
                        <!-- LEFT SIDE: TABS + CONTENT -->
                        <div class="col-12">
                            <div class="container-fluid p-0 w-100 h-100">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs w-100" id="myTab" role="tablist">
                                    @if(isset($getHEFile['file_name']))
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" href="#tab1" aria-controls="tab1" aria-selected="true">H&E</a>
                                    </li>
                                    @endif
                                    @if(isset($getHERFile['file_name']))
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" href="#tab2" aria-controls="tab2" aria-selected="false">HER2</a>
                                    </li>
                                    @endif
                                    @if(isset($getKIFile['file_name']))
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" href="#tab3" aria-controls="tab3" aria-selected="false">Ki-67</a>
                                    </li>
                                    @endif
                                    @if(isset($getERFile['file_name']))
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button" role="tab" href="#tab4" aria-controls="tab4" aria-selected="false">ER</a>
                                    </li>
                                    @endif
                                    @if(isset($getPGRile['file_name']))
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="tab5-tab" data-bs-toggle="tab" data-bs-target="#tab5" type="button" role="tab" href="#tab5" aria-controls="tab5" aria-selected="false">PGR</a>
                                    </li>
                                    @endif
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content mt-3 w-100 h-100 ">
                                    <!-- tab 1 map 1 content start -->
                                    @if(isset($getHEFile['file_name']))
                                    <div class="tab-pane fade show active w-100 h-100" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                        <div class="row">
                                            <div class="col-3">
                                                <h2>{{$getHEFile['study_name']}}</h2>
                                            </div>
                                            <div class="col-2">
                                                <span id="enableMessage" class="text-danger"></span>
                                            </div>
                                            <div class="col-5">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <button class="text-white bg-primary btn btn-sm" onclick="findTumor('{{$jobId}}')">Find Tumor</button>
                                                    </div>
                                                    <div class="col-3">
                                                        <button class="text-white bg-primary btn btn-sm" onclick="reanalyze('{{$jobId}}')">Analyze stain</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                            <div style="display: flex; align-items: end; gap: 10px;">
                                                <div id="external-toolbar"></div>
                                                <button id="draw:deleted" class="deleteRoi">Delete ROI</button>
                                            </div>
                                            </div>
                                        </div>


                                        <!--
                                        <form id="layerForm1" class="mb-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="hidden" id="study_id" name="study_id" value="{{ $study_id }}">
                                                    <input type="text" name="name" placeholder="Layer Name" class="form-control mb-2" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
-->
                                        <div id="map-tab1" class="w-100 border" style="height:700px;max-height:700px !important">
                                            <div id="mapLoadingSpinner1" class="map-content">
                                                <img src="{{ asset('/assets/auth/loading-spinner.gif') }}" alt="Loading..." />
                                            </div>
                                            <div class="tile-info" id="tileInfo">
                                                Zoom: <span class="sharedZoomLevel">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- tab 1 map 1 content end -->
                                    <!-- tab 2 map 2 content start -->
                                    @if(isset($getHERFile['file_name']))
                                    <div class="tab-pane fade w-100 h-100" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                        <div class="header-container">
                                            <h2>{{$getHERFile['study_name']}}</h2>
                                            <button id="showReportBtn-tab2" class="showReportBtn" onclick="handleTabReport('tab2', recordKey)">Show Report</button>
                                        </div>
                                        <!-- <form id="layerForm2" class="mb-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="name2" placeholder="Layer Name" class="form-control mb-2" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form> -->
                                        <div id="map-tab2" class="w-100 h-100 border" style="height:700px;max-height:700px !important">
                                            <div id="mapLoadingSpinner2" class="map-content">
                                                <img src="{{ asset('/assets/auth/loading-spinner.gif') }}" alt="Loading..." />
                                            </div>
                                            <div class="tile-info2" id="tileInfo2">
                                                Zoom: <span class="sharedZoomLevel">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- tab 2 map 2 content end -->
                                    <!-- tab 3 map 3 content start -->
                                    @if(isset($getKIFile['file_name']))
                                    <div class="tab-pane fade w-100 h-100" style="height:700px;max-height:700px !important" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                        <div class="header-container">
                                            <h2>{{$getKIFile['study_name']}}</h2>
                                            <button id="showReportBtn-tab3" class="showReportBtn" onclick="handleTabReport('tab3', recordKey)">Show Report</button>
                                        </div>
                                        <div id="map-tab3" class="w-100 h-100 border">
                                            <div id="mapLoadingSpinner3" class="map-content">
                                                <img src="{{ asset('/assets/auth/loading-spinner.gif') }}" alt="Loading..." />
                                            </div>
                                            <div class="tile-info3" id="tileInfo3">
                                                Zoom: <span class="sharedZoomLevel">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- tab 3 map 3 content end -->
                                    <!-- tab 4 map 4 content start -->
                                    @if(isset($getERFile['file_name']))
                                    <div class="tab-pane fade w-100 h-100" style="height:700px;max-height:700px !important" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                        <div class="header-container">
                                            <h2>{{$getERFile['study_name']}}</h2>
                                            <button id="showReportBtn-tab4" class="showReportBtn" onclick="handleTabReport('tab4', recordKey)">Show Report</button>
                                        </div>
                                        <div id="map-tab4" class="w-100 h-100 border">
                                            <div id="mapLoadingSpinner4" class="map-content">
                                                <img src="{{ asset('/assets/auth/loading-spinner.gif') }}" alt="Loading..." />
                                            </div>
                                            <div class="tile-info4" id="tileInfo4">
                                                Zoom: <span class="sharedZoomLevel">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- tab 4 map 4 content end -->
                                    <!-- tab 5 map 5 content start -->
                                    @if(isset($getPGRile['file_name']))
                                    <div class="tab-pane fade w-100 h-100" style="height:700px;max-height:700px !important" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                                        <div class="header-container">
                                            <h2>{{$getPGRile['study_name']}}</h2>
                                            <button id="showReportBtn-tab5" class="showReportBtn" onclick="handleTabReport('tab5', recordKey)">Show Report</button>
                                        </div>
                                        <div id="map-tab5" class="w-100 h-100 border">
                                            <div id="mapLoadingSpinner5" class="map-content">
                                                <img src="{{ asset('/assets/auth/loading-spinner.gif') }}" alt="Loading..." />
                                            </div>
                                            <div class="tile-info5" id="tileInfo5">
                                                Zoom: <span class="sharedZoomLevel">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- tab 5 map 5 content end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="{{asset('/js/leaflet.js')}}"></script> -->
<script>
    const mapStates = {
        map1: {
            initialized: false
        },
        map2: {
            initialized: false
        },
        map3: {
            initialized: false
        },
        map4: {
            initialized: false
        },
        map5: {
            initialized: false
        }
    };

    const maps = {};
    const drawnGroups = {}; // per mapKey
    let latestLayer = null;
    let syncingZoom = false;
    let syncingMove = false;

    let storedLat = -134.5 ;
    let storedLng = 253.20666726856587;
    const maxZoom = 5;
    let sharedZoomLevel = 1;
    recordKey = ''
    let map;
    let drawnItems;
    const file_jobs_id = @json($jobId);
    let reportRecords = (@json($fileToRegions)?.[0]?.region) || '';
    const overlaysByTab = {};

    $(document).ready(function() {
        $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function(e) {
            const tabId = $(e.target).attr('href').replace('#', '');
            const mapKey = `map${tabId.replace('tab', '')}`;

            if (!mapStates[mapKey].initialized) {
                if (maps[mapKey]) {
                    maps[mapKey].remove();
                    delete maps[mapKey];
                }
                initMap(mapKey, tabId);
            mapStates[mapKey].initialized = true;
            }

            setTimeout(() => {
                if (maps[mapKey]) maps[mapKey].invalidateSize();
            }, 100);
        });

        $('a[data-bs-toggle="tab"].active').trigger("shown.bs.tab");
    });

    function initMap(mapKey, tabId) {
        const mapContainerId = `map-${tabId}`;
        const resultUrl = getResultUrl(mapKey);
        if (!resultUrl) return;

        const baseUrl = resultUrl.substring(0, resultUrl.indexOf("{z}"));
        
        map = L.map(mapContainerId, {
            crs: L.CRS.Simple,
            attributionControl: false,
            scrollWheelZoom: false,
            doubleClickZoom: false,
            minZoom:1,
            maxZoom: maxZoom
        }).setView([storedLat, storedLng], sharedZoomLevel);

        maps[mapKey] = map;

        // --- Tile Layer ---
        const tileLayer = new(L.TileLayer.extend({
            createTile: function(coords, done) {
                const tile = document.createElement("img");
                tile.src = this.getTileUrl(coords);
                tile.onload = () => done(null, tile);
                tile.onerror = () => {
                    tile.style.display = 'none'; // Hide broken tiles
                    done(null, tile);
                };
                return tile;
            }
        }))(resultUrl, {
            tileSize: 256,
            minZoom: 1,
            maxZoom: maxZoom,
            noWrap: true,
            updateWhenIdle: true
        });

        tileLayer.addTo(map);

        // --- Synchronization Events ---
        map.on("zoomend", () => syncZoom(mapKey));
        map.on("moveend", () => syncMove(mapKey));

        // --- Drawing Tools ---
        drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);
        drawnGroups[mapKey] = drawnItems;

        @if(!empty($getHEFile['file_name']))
        if (mapKey === 'map1') {
            const drawControl = new L.Control.Draw({
                draw: {
                    polygon: false,
                    polyline: false,
                    rectangle: {
                        shapeOptions: {
                            color: 'blue',
                            weight: 2,
                            opacity: 0.7,
                            fill: false
                        }
                    },
                    circle: false,
                    marker: false,
                    circlemarker: false
                },
                edit: {
                    featureGroup: drawnItems,
                    edit: true,
                    remove: false 

                }
            });
            map.addControl(drawControl);
        }
        @endif

        // --- Load Existing Layers ---
        const studyId = "{{ $study_id ?? '' }}";
        $.get("{{ route('map.load') }}", {
            study_id: studyId
        }, function(data) {
            data.forEach((layer) => {
                const geoLayer = L.geoJSON(JSON.parse(layer.geojson), {
                    style: {
                        color: "#ff0000",
                        weight: 2,
                        opacity: 0.8,
                        fillOpacity: 0.3
                    }
                });
                geoLayer.addTo(drawnItems);
                geoLayer.bindPopup(`<strong>${layer.name}</strong>`);
            });
        }).fail(() => console.warn("Could not load existing layers"));

        // --- Save Layer Form ---
        const formSelector = `#layerForm${mapKey.replace('map', '')}`;
        $(formSelector).on("submit", function(e) {
            e.preventDefault();
            if (!latestLayer) return alert("Draw something first!");

            const geojson = latestLayer.toGeoJSON();
            const name = $(this).find('input[name="name"]').val();

            $.ajax({
                url: "{{ route('map.store') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    geojson: JSON.stringify(geojson),
                    study_id: studyId
                },
                success: function() {
                    alert("Layer Saved!");
                    $(formSelector)[0].reset();
                    drawnItems.clearLayers();
                    latestLayer = null;
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("Save failed");
                }
            });
        });

        drawSavedRegionOnMap(mapKey);
        handleTabReport(tabId, recordKey);
        handleRegionActions(studyId);
        
        var toolbar = document.querySelector('.leaflet-draw');
        document.getElementById('external-toolbar').appendChild(toolbar);
        toggleToolbarButtons();
    }

    function syncZoom(sourceKey) {
        if (syncingZoom) return;
        syncingZoom = true;

        const sourceZoom = maps[sourceKey].getZoom();
   Object.entries(maps).forEach(([key, map]) => {
            if (key !== sourceKey && map) map.setZoom(sourceZoom);
        });

        sharedZoomLevel = sourceZoom-1;
        syncingZoom = false;
        updateZoomDisplay(sharedZoomLevel);

    }

    function syncMove(sourceKey) {
        if (syncingMove) return;
        syncingMove = true;

        const center = maps[sourceKey].getCenter();
        Object.entries(maps).forEach(([key, map]) => {
            if (key !== sourceKey && map) map.setView(center, map.getZoom());
        });
        storedLat = center.lat;
        storedLng = center.lng;
        syncingMove = false;
    }

    function getResultUrl(mapKey) {
        switch (mapKey) {
            case 'map1':
                recordKey = '';
                setOnlyOneInitialized(mapKey);
                return "{{ $getHEFile['result_url'] ?? '' }}";
            case 'map2':
                recordKey = "her2";
                setOnlyOneInitialized(mapKey);
                return "{{ $getHERFile['result_url'] ?? '' }}";
            case 'map3':
                recordKey = "ki67";
                setOnlyOneInitialized(mapKey);
                return "{{ $getKIFile['result_url'] ?? '' }}";
            case 'map4':
                recordKey = "er";
                setOnlyOneInitialized(mapKey);
                return "{{ $getERFile['result_url'] ?? '' }}";
            case 'map5':
                recordKey = "pgr";
                setOnlyOneInitialized(mapKey);
                return "{{ $getPGRile['result_url'] ?? '' }}";
            default:
                return '';
        }

    }

    function getTextWidth(text, font = "12px Arial") {
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");
        context.font = font;
        return context.measureText(text).width;
    }

    function handleTabReport(tabId, recordKey) {
        if (!recordKey) return;
        const reportRecords = @json($reportRecords);
        if (reportRecords.length === 0) return;
        const reportText = reportRecords[0][recordKey];
        if (!reportText) return;

        const lineHeight = 17,
            paddingX = 45,
            paddingY = 20;
        const lines = reportText.split(/(?=Estimated)/).map(line => line.trim());
        const textWidths = lines.map(line => getTextWidth(line, "12px Arial"));
        const maxTextWidth = Math.max(...textWidths);

        const width = maxTextWidth + paddingX;
        const height = lines.length * lineHeight + paddingY;

        const svgLines = lines.map((line, i) => {
            const y = 10 + lineHeight + i * lineHeight;
            return `<text x="10" y="${y}" font-size="12" fill="black">${line}</text>`;
        }).join('\n');

        const svgHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="${width}" height="${height}">
            <rect width="100%" height="100%" fill="white"/>
            ${svgLines}
            </svg>
        `;

        const btn = document.getElementById(`showReportBtn-${tabId}`);
        if (btn) btn.style.display = "none";

        if (overlaysByTab[tabId]?.control) {
            overlaysByTab[tabId].map.removeControl(overlaysByTab[tabId].control);
        }
        if (overlaysByTab[tabId]?.layer) {
            overlaysByTab[tabId].map.removeLayer(overlaysByTab[tabId].layer);
        }

        const svgControl = L.control({
            position: 'topright'
        });
        svgControl.onAdd = function() {
            const container = L.DomUtil.create('div', 'custom-svg-container');
            container.innerHTML = `<span id="closeReportBtn-${tabId}" class="closeReportBtn">&times;</span>${svgHTML}`;
            Object.assign(container.style, {
                backgroundColor: 'white',
                margin: '10px',
                boxShadow: '0 2px 5px rgba(0,0,0,0.2)',
                position: 'absolute',
                top: '32px',
                right: '0px',
                cursor: 'move',
                zIndex: 1000
            });

            makeDraggable(container);

            setTimeout(() => {
                document.getElementById(`closeReportBtn-${tabId}`).onclick = function() {
                    map.removeControl(svgControl);
                    btn.style.display = "inline-block";
                    overlaysByTab[tabId].control = null;
                };
            }, 0);
            return container;
        };

        svgControl.addTo(map);
        overlaysByTab[tabId] = {
            map,
            control: svgControl,
            layer: null
        };

        if (!overlaysByTab[tabId].clickHandlerAdded) {
            map.on('click', function(e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;
                const offset = 0.002;

                const newBounds = L.latLngBounds(
                    [
                        [lat + offset, lng - offset],
                        [lat - offset, lng + offset]
                    ]
                );

                if (overlaysByTab[tabId].layer) {
                    map.removeLayer(overlaysByTab[tabId].layer);
                }

                const svgElement = new DOMParser().parseFromString(svgHTML, 'image/svg+xml').documentElement;
                overlaysByTab[tabId].layer = L.svgOverlay(svgElement, newBounds, {
                    opacity: 0.9,
                    interactive: true
                }).addTo(map);
            });
            overlaysByTab[tabId].clickHandlerAdded = true;
        }
    }

    function makeDraggable(el) {
        let startX, startY, startTop, startLeft;

        L.DomEvent.disableClickPropagation(el);
        L.DomEvent.disableScrollPropagation(el);

        el.addEventListener('mousedown', (e) => {
            e.preventDefault();
            e.stopPropagation();

            startX = e.clientX;
            startY = e.clientY;
            startTop = el.offsetTop;
            startLeft = el.offsetLeft;

            const onMouseMove = (e) => {
                const dx = e.clientX - startX;
                const dy = e.clientY - startY;
                el.style.top = `${startTop + dy}px`;
                el.style.left = `${startLeft + dx}px`;
                el.style.right = 'auto';
            };

            const onMouseUp = () => {
                document.removeEventListener('mousemove', onMouseMove);
                document.removeEventListener('mouseup', onMouseUp);
            };

            document.addEventListener('mousemove', onMouseMove);
            document.addEventListener('mouseup', onMouseUp);
        });
    }

    function drawSavedRegionOnMap(study_id) {
    if (reportRecords) {
        const [x, y, w, h] = reportRecords.replace(/[()]/g, "").split(",").map(Number);
            const nwLatLng = map.unproject([x, y], maxZoom);
            const seLatLng = map.unproject([x + w, y + h], maxZoom);
        const rect = L.rectangle([nwLatLng, seLatLng], {
            color: 'blue',
            weight: 2,
            fill: false
        });
        drawnItems.addLayer(rect);
    }
}

    function handleRegionActions(study_id) {
        const file_jobs_id = @json($jobId);

function saveRegionToStorage(layer) {
    const bounds = layer.getBounds();
    const nw = bounds.getNorthWest();
    const se = bounds.getSouthEast();

            const nwPoint = map.project(nw, maxZoom);
            const sePoint = map.project(se, maxZoom);

    let x = Math.round(nwPoint.x);
    let y = Math.round(nwPoint.y);
    let w = Math.round(sePoint.x - nwPoint.x);
    let h = Math.round(sePoint.y - nwPoint.y);
    return reportRecords = `(${x},${y},${w},${h})`;
}

        function sendRegionData(method, url, regionData) {
            fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(regionData)
                })
                .then(response => response.json())
                .catch(error => console.error(`${method} error:`, error));
        }

        map.on('draw:created', function(event) {
            if (drawnItems.getLayers().length > 0) {
                Toastify({
                    text: "Only one shape is allowed. Please delete the existing shape first.",
                    duration: 2000,
                    gravity: "top",
                    position: "center",
                    style: {
                        background: "#f44336"
                    },
                    close: true
                }).showToast();
                return;
            }
            const layer = event.layer;
                layer.setStyle({
                color: 'blue',  
                weight: 2,       
                fill: false      
            });
            drawnItems.addLayer(layer);
            toggleToolbarButtons();

            if (event.layerType === 'rectangle') {
                reportRecords = saveRegionToStorage(layer);
                const timestamp = new Date().toISOString();
                sendRegionData('POST', 'http://3.128.20.153:5000/store-coordinates', {
                    file_jobs_id,
                    study_id,
                    region: reportRecords,
                    created_at: timestamp,
                    updated_at: timestamp
                });
            }
        });

        map.on('draw:edited', function(e) {
            e.layers.eachLayer(function(layer) {
                if (layer instanceof L.Rectangle) {
                    reportRecords = saveRegionToStorage(layer);
                    sendRegionData('PUT', 'http://3.128.20.153:5000/update-coordinates', {
                        file_jobs_id,
                        study_id,
                        region: reportRecords,
                        updated_at: new Date().toISOString()
                    });
                }
            });
            toggleToolbarButtons();
        });

        document.getElementById("draw:deleted").onclick = function () {
            drawnItems.eachLayer(function (layer) {
                if (layer instanceof L.Rectangle) {
                    reportRecords = saveRegionToStorage(layer);
                    sendRegionData('DELETE', 'http://3.128.20.153:5000/delete-coordinates', {
                        file_jobs_id,
                        study_id,
                        region: reportRecords,
                    });
                }
            });
                drawnItems.clearLayers();
            reportRecords = '';
            toggleToolbarButtons();
        };
    }

    function updateZoomDisplay(zoomLevel) {
                document.querySelectorAll('.sharedZoomLevel').forEach(el => {
            el.textContent = zoomLevel;
        });
    }

    function setOnlyOneInitialized(targetKey) {
        Object.keys(mapStates).forEach(key => {
            mapStates[key].initialized = (key === targetKey);
        });
    }

    // function findTumor(jobId) {
    //     // alert(jobId);
    //     $.ajax({
    //         type: 'POST',
    //         url: '{{ route("find-tumor") }}',
    //         data: {
    //             jobId: jobId
    //         },
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(response) {

    //             // ✅ All files uploaded
    //             setTimeout(() => {
    //                 window.location.href = '/view';
    //             }, 1000); // Small delay to show "upload complete"

    //         },
    //         error: function(xhr) {
    //             // alert('Please check the form for errors.');

    //         }
    //     });
    // }

    function findTumor(jobId) {
        Swal.fire({
            title: 'Please confirm.',
            text: "This action will restart the analysis. Please confirm you wish to proceed?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("find-tumor") }}',
                    data: {
                        jobId: jobId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        // ✅ All files uploaded
                        setTimeout(() => {
                            window.location.href = '/view';
                        }, 1000); // Small delay to show "upload complete"

                    },
                    error: function(xhr) {
                        // alert('Please check the form for errors.');

                    }
                });
            }
            // Else: user clicked cancel, so do nothing
        });
    }

    function reanalyze(jobId) {
        Swal.fire({
            title: 'Please confirm.',
            text: "This action will restart the analysis. Please confirm you wish to proceed?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("re-analyze") }}',
                    data: {
                        jobId: jobId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response == 1) {
                            // ✅ All files uploaded
                            setTimeout(() => {
                                window.location.href = '/view';
                            }, 1000); // Small delay to show "upload complete"
                        }
                        if (response == 2) {
                            $("#enableMessage").text("Please define region for analysis");
                            setTimeout(() => {
                                $("#enableMessage").text("");
                            }, 5000); // Clear after 5 seconds
                        }


                    },
                    error: function(xhr) {
                        // alert('Please check the form for errors.');

                    }
                });
            }
            // Else: user clicked cancel, so do nothing
        });
    }

    function toggleToolbarButtons() {
        var hasShapes = drawnItems.getLayers().length > 0;
        document.querySelector('.leaflet-draw-draw-rectangle').style.display = hasShapes ? 'none' : 'inline-flex';
        document.querySelector('.leaflet-draw-edit-edit').style.display = hasShapes ? 'inline-flex' : 'none';
        document.getElementById('draw:deleted').style.display = hasShapes ? 'inline-flex' : 'none';
    }
</script>
@endsection