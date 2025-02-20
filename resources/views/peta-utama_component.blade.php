<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDAM Purwokerto</title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

  <style>
    html,
    body,
    #map {
      width: 100%;
      height: 100%;
      margin: 0px;
    }
  </style>
</head>

<body>
  <div id="map"></div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.6.2/proj4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4leaflet/1.0.2/proj4leaflet.min.js"></script>

  @include('tamplating_maps.maps')
  @include('tamplating_maps.basemaps')
  @include('tamplating_maps.layers')
  <script>
    // control_layer
    var baseMaps = {
      "Open Street Map": osm
    };
    var layers = {
      "Pelanggan Per DMA": wfsgeoserver
    };
    L.control.layers(baseMaps, layers).addTo(maps);
  </script>
</body>

</html>
