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
  <script>
    // init map
    var map = L.map('map').setView([-7.4279302, 109.2408501], 12);

    // bbox map
    var bounds = map.getBounds();
    var minll = bounds.getSouthWest();
    var maxll = bounds.getNorthEast();
    var bbox = minll.lng + ',' + minll.lat + ',' + maxll.lng + ',' + maxll.lat;
    console.log(bbox);

    var zoom = map.getZoom();
    console.log(zoom);

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
    Google_Roadmap.addTo(map);

    // GeoJSON pelanggan
    var pelanggan = L.geoJSON(null, {
      // Style

      // onEachFeature
      onEachFeature: function(feature, layer) {
        // variable popup content
        var popup_content = "Nama: " + feature.properties.nama + "<br>" +
          "Alamat: " + feature.properties.alamat + "<br>" +
          "Koordinat: " + feature.geometry.coordinates[1] + ", " + feature.geometry.coordinates[0];

        layer.on({
          click: function(e) {
            pelanggan.bindPopup(popup_content);
          },
          mouseover: function(e) {
            pelanggan.bindTooltip(feature.properties.nama);
          },
        });
      },
    });
    $.getJSON("{{ route('api.pelanggans') }}?bbox=" + bbox, function(data) {
      pelanggan.addData(data); // Menambahkan data ke dalam pelanggan variable
      map.addLayer(pelanggan); // Menambahkan GeoJSON pelanggan ke dalam peta
    });

    // GeoJSON dma
		var symbolDma = {"BANYUMAS": "green", "PURWOKERTO 1": "orange", "PURWOKERTO 2": "lime", "AJIBARANG": "#FADA7A", "WANGON": "magenta"};
    var dma = L.geoJSON(null, {
      // Style
			style: function(feature) {
				return {
					color: "gray",
					weight: 2,
					opacity: 1,
					fillColor: symbolDma[feature.properties.cabang],
					fillOpacity: 0.3
				};
			},
      // onEachFeature
      onEachFeature: function(feature, layer) {
        // variable popup content
        var popup_content = "<h6>" + feature.properties.nama_dma + "</h6>" +
          "Kode: " + feature.properties.kode_dma + "<br>" +
          "Cabang: " + feature.properties.cabang + "<br>" +
          "Jumlah Pelanggan: " + feature.properties.pelanggan.toLocaleString() + "<br>" +
          "Jumlah Tagihan: Rp " + feature.properties.tagihan.toLocaleString() + ",-<br>" +
          "Sumber Air: " + feature.properties.sumber_air;
    

        layer.on({
          click: function(e) {
            dma.bindPopup(popup_content);
          },
          mouseover: function(e) {
            dma.bindTooltip(feature.properties.nama_dma, {
							sticky: true
						});
          },
        });
      },
    });
    $.getJSON("{{ route('api.dmas') }}", function(data) {
      dma.addData(data); // Menambahkan data ke dalam dma variable
      map.addLayer(dma); // Menambahkan GeoJSON dma ke dalam peta
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
      "Pelanggan": pelanggan,
			"DMA": dma,
    };

    var controllayer = L.control.layers(baseMaps, overlayMaps, {
      collapsed: false
    });
    controllayer.addTo(map);

    // update layer pelanggan
    function updateLayerPelanggan() {
      var bounds = map.getBounds();
      var minll = bounds.getSouthWest();
      var maxll = bounds.getNorthEast();
      var bbox = minll.lng + ',' + minll.lat + ',' + maxll.lng + ',' + maxll.lat;
      console.log(bbox);

      var zoom = map.getZoom();
      console.log(zoom);

      $.getJSON("{{ route('api.pelanggans') }}?bbox=" + bbox, function(data) {
        pelanggan.clearLayers();
        pelanggan.addData(data);
      });
    }

    // event map moveend
    map.on('moveend', function() {
      updateLayerPelanggan();
    });

    // event map zoomend
    map.on('zoomend', function() {
      updateLayerPelanggan();
    });
  </script>
</body>

</html>
