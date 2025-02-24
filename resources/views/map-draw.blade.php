<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>
  <link href="https://unsorry.net/assets-date/images/favicon.png" rel="shortcut icon" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"
    integrity="sha512-gc3xjCmIy673V6MyOAZhIW93xhM9ei1I+gLbmFjUHIjocENRsLX/QUE1htk5q1XV2D/iie/VQ8DXI6Vu8bexvQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    #map {
      margin-top: 56px;
      height: calc(100vh - 56px);
      width: 100%;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><i class="fa-solid fa-earth-asia"></i> {{ $title }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#infoModal"><i
                class="fa-solid fa-circle-info"></i> Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-primary" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i>
              Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="map"></div>

  <!-- Modal Create Point -->
  <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="createpointModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createpointModalLabel"><i class="fa-solid fa-location-dot"></i> Create Point
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('pelanggan.store') }}" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Fill in the nama"
                required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Fill in the alamat"></textarea>
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select name="status" id="status" class="form-select">
								@foreach ($statuspelanggan as $sp)
									<option value="{{ $sp->id }}">{{ $sp->status }}</option>
								@endforeach
							</select>
            </div>
            <div class="mb-3">
              <label for="geom_point" class="form-label">Geometry WKT</label>
              <textarea class="form-control" id="geom_point" name="geom_point" rows="2" readonly></textarea>
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Image</label>
              <input type="file" class="form-control" id="image" name="image"
                onchange="document.getElementById('image-preview-point').src = window.URL.createObjectURL(this.files[0])">
            </div>
            <div class="mb-3">
              <img id="image-preview-point" class="img-thumbnail" alt="" width="400">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
              class="fa-solid fa-circle-xmark"></i> Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Info -->
  <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="infoModalLabel"><i class="fa-solid fa-circle-info"></i> Info</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5 class="mb-3">Leaflet CRUD PostgreSQL Laravel</h5>
          <p class="mb-0">Stack:</p>
          <ul>
            <li>PHP Framework Laravel</li>
            <li>PostgreSQL - PostGIS</li>
          </ul>
          <p class="mb-0">Library:</p>
          <ul>
            <li>Leaflet JS</li>
            <li>Leaflet Draw</li>
            <li>ESRI Terraformer WKT Parser</li>
            <li>Bootstrap 5</li>
            <li>Font Awesome 6</li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
              class="fa-solid fa-circle-xmark"></i> Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"
    integrity="sha512-ozq8xQKq6urvuU6jNgkfqAmT7jKN2XumbrX1JiB3TnF7tI48DPI4Gy1GXKD/V3EExgAs1V+pRO7vwtS1LHg0Gw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://unpkg.com/@terraformer/wkt"></script>
  <script>
    // init map
    var map = L.map('map').setView([-7.4279302, 109.2408501], 12);

    // Tile Layer Basemap
    var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: '© OpenStreetMap contributors',
    });

    var Esri_WorldImagery = L.tileLayer(
      'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles © Esri — Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
      });

    var rupabumiindonesia = L.tileLayer(
      'https://geoservices.big.go.id/rbi/rest/services/BASEMAP/Rupabumi_Indonesia/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Badan Informasi Geospasial'
      });

    var Google_Roadmap = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ["mt0", "mt1", "mt2", "mt3"],
      attribution: 'Google'
    });

    var Google_Satellite = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ["mt0", "mt1", "mt2", "mt3"],
      attribution: 'Google'
    });

    // Menambahkan basemap ke dalam peta
    Esri_WorldImagery.addTo(map);

    /* Digitize Function with Leaflet Draw */
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
      draw: {
        position: 'topleft',
        polyline: true,
        polygon: true,
        rectangle: true,
        circle: false,
        marker: true,
        circlemarker: false
      },
      edit: false
    });

    map.addControl(drawControl);

    // Draw created event
    map.on('draw:created', function(e) {
      var type = e.layerType,
        layer = e.layer;

      console.log(type);

      // Convert to GeoJSON
      var drawnJSONObject = layer.toGeoJSON();

      // Convert Geometry GeoJSON to WKT
      var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

      if (type === 'polyline') {
        console.log(objectGeometry);
      } else if (type === 'polygon' || type === 'rectangle') {
        console.log(objectGeometry);
      } else if (type === 'marker') {
        $('#geom_point').val(objectGeometry);
        $('#createpointModal').modal('show');

        // modal dismiss reload
        $('#createpointModal').on('hidden.bs.modal', function() {
          location.reload();
        });
      } else {
        console.log('__undefined__');
      }

      // Layer drawn items add to map
      drawnItems.addLayer(layer);
    });

    /* Layer GeoServer WFS */
    var wfsgeoserver = L.geoJson(null, {
      onEachFeature: function(feature, layer) {
        var popup_content = "<h3>" + feature.properties.nama_dma + "</h3>" +
          "<table class='table table-sm table-striped table-bordered'>" +
          "<tr><th>Cabang</th><td>" + feature.properties.cabang + "</td></tr>" +
          "<tr><th>Jumlah Pelanggan</th><td>" + feature.properties.jml_pelanggan + "</td></tr>" +
          "<tr><th>Pemakaian</th><td>" + feature.properties.pemakaian + " m<sup>3</sup></td></tr>" +
          "<tr><th>Jumlah Tagihan</th><td>Rp " + feature.properties.tagihan + "</td></tr>" +
          "</table>";

        layer.on({
          click: function(e) { //Fungsi ketika obyek diklik
            wfsgeoserver.bindPopup(popup_content);
          },
        });
      }
    });

    /* Geoserver JSONP */
    var owsrootUrl = 'http://103.25.210.59:8080/geoserver/pdam/ows';
    var defaultParameters = {
      service: 'WFS',
      version: '1.0.0',
      request: 'GetFeature',
      typeName: 'pdam:pelanggan_per_dma',
      outputFormat: 'text/javascript',
      format_options: 'callback:getJson',
      srsName: 'EPSG:4326',
    };
    var parameters = L.Util.extend(defaultParameters);
    var URL = owsrootUrl + L.Util.getParamString(parameters);

    $.ajax({
      url: URL,
      dataType: 'jsonp',
      jsonpCallback: 'getJson',
      success: function(data) {
        wfsgeoserver.addData(data);
        map.addLayer(wfsgeoserver);

        // Zoom to layer
        map.fitBounds(wfsgeoserver.getBounds());
      }
    });

    // Control Layer
    var baseMaps = {
      "OpenStreetMap": osm,
      "Esri World Imagery": Esri_WorldImagery,
      "Rupa Bumi Indonesia": rupabumiindonesia,
      "Google Roadmap": Google_Roadmap,
      "Google Satellite": Google_Satellite,
    };

    var overlayMaps = {
      // "DMA WMS": dma_wms,
    };

    var controllayer = L.control.layers(baseMaps, overlayMaps, {
      collapsed: false
    });
    controllayer.addTo(map);
  </script>
</body>

</html>
