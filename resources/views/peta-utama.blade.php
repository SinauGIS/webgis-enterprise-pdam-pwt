<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDAM Tirta Satria</title>

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

  <script>
    var center = [-7.4279302, 109.2408501];

    var map = L.map('map').setView(center, 11);

    // bbox map
    var bounds = map.getBounds();
    var minll = bounds.getSouthWest();
    var maxll = bounds.getNorthEast();
    var bbox = minll.lng + ',' + minll.lat + ',' + maxll.lng + ',' + maxll.lat;
    console.log(bbox);

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

    /* Geoserver JSONP URL */
    var owsrootUrl = 'http://103.25.210.59:8080/geoserver/pdam/ows';
    var owsTutorialUrl = 'http://103.25.210.59:8080/geoserver/Tutorial/ows';

    /* Layer GeoServer WFS */
    // Layer Pelanggan
    map.createPane("pane_pelanggan");
    map.getPane("pane_pelanggan").style.zIndex = 500;
    var pelanggan = L.geoJson(null, {
      pane: "pane_pelanggan",
      onEachFeature: function(feature, layer) {
        var popup_content = "<h3>" + feature.properties.nama + "</h3>" +
          "<table class='table table-sm table-striped table-bordered'>" +
          "<tr><th>Alamat</th><td>" + feature.properties.alamat + "</td></tr>" +
          "<tr><th>Kecamatan</th><td>" + feature.properties.kecamatan + "</td></tr>" +
          "<tr><th>Desa</th><td>" + feature.properties.desa + "</td></tr>" +
          "<tr><th>RT/RW</th><td>" + feature.properties.rt + " / " + feature.properties.rw + "</td></tr>" +
          "<tr><th>Tarif</th><td>" + feature.properties.nama_tarif + " (" + feature.properties.kode_tarif +
          ")</td></tr>" +
          "<tr><th>Status</th><td>" + feature.properties.status + "</td></tr>" +
          "</table>";
        layer.on({
          click: function(e) { //Fungsi ketika obyek diklik
            pelanggan.bindPopup(popup_content);
          },
          mouseover: function(e) { //Fungsi ketika obyek dihover
            pelanggan.bindTooltip(feature.properties.nama + " (" + feature.properties.nama_tarif + ")", {
              sticky: true,
              direction: 'top'
            });
          }
        });
      }
    });

    var pelangganParameters = {
      service: 'WFS',
      version: '1.0.0',
      request: 'GetFeature',
      typeName: 'pdam:stagging_cust',
      outputFormat: 'text/javascript',
      format_options: 'callback:getJson',
      srsName: 'EPSG:4326',
      // cql_filter: "kode_dma='01021'",
      maxFeatures: 100,
      bbox: bbox
    };
    var parametersPelanggan = L.Util.extend(pelangganParameters);
    var pelangganURL = owsrootUrl + L.Util.getParamString(parametersPelanggan);

    $.ajax({
      url: pelangganURL,
      dataType: 'jsonp',
      jsonpCallback: 'getJson',
      success: function(data) {
        pelanggan.addData(data);
        map.addLayer(pelanggan);
      }
    });

    // Layer Pipa
    map.createPane("pane_pipa");
    map.getPane("pane_pipa").style.zIndex = 400;
    var pipa = L.geoJson(null, {
      pane: "pane_pipa",
      onEachFeature: function(feature, layer) {
        var popup_content = "<h3>Pipa</h3>" +
          "<table class='table table-sm table-striped table-bordered'>" +
          "<tr><th>Panjang</th><td>" + feature.properties.pjg_meter + " m</td></tr>" +
          "<tr><th>Diameter</th><td>" + feature.properties.diameter + " m<sup>3</sup></td></tr>" +
          "<tr><th>Keterangan</th><td>" + feature.properties.keterangan + "</td></tr>" +
          "</table>";
        layer.on({
          click: function(e) { //Fungsi ketika obyek diklik
            pipa.bindPopup(popup_content);
          },
          mouseover: function(e) { //Fungsi ketika obyek dihover
            pipa.bindTooltip(feature.properties.pjg_meter + " m", {
              sticky: true,
              direction: 'top'
            });
          }
        });
      }
    });

    var pipaParameters = {
      service: 'WFS',
      version: '1.0.0',
      request: 'GetFeature',
      typeName: 'Tutorial:pipa',
      outputFormat: 'text/javascript',
      format_options: 'callback:getJsonPipa',
      srsName: 'EPSG:4326',
      maxFeatures: 1000,
      bbox: bbox
    };
    var parameterspipa = L.Util.extend(pipaParameters);
    var pipaURL = owsTutorialUrl + L.Util.getParamString(parameterspipa);

    $.ajax({
      url: pipaURL,
      dataType: 'jsonp',
      jsonpCallback: 'getJsonPipa',
      success: function(data) {
        pipa.addData(data);
        map.addLayer(pipa);
      }
    });

    // Layer DMA
		var symbolDma = {"BANYUMAS": "green", "PURWOKERTO 1": "orange", "PURWOKERTO 2": "lime", "AJIBARANG": "#FADA7A", "WANGON": "magenta"};
    map.createPane("pane_dma");
    map.getPane("pane_dma").style.zIndex = 300;
    var dma = L.geoJson(null, {
      pane: "pane_dma",
			style: function(feature) {
				return {
					color: "gray",
					weight: 2,
					opacity: 1,
					fillColor: symbolDma[feature.properties.cabang],
					fillOpacity: 0.5
				};
			},
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
            dma.bindPopup(popup_content);
          },
          mouseover: function(e) { //Fungsi ketika obyek dihover
            dma.bindTooltip(feature.properties.nama_dma + " (" + feature.properties.kode_dma + ")", {
              sticky: true,
              direction: 'top'
            });
          }
        });
      }
    });

    /* DMA */
    var dmaParameters = {
      service: 'WFS',
      version: '1.0.0',
      request: 'GetFeature',
      typeName: 'pdam:pelanggan_per_dma',
      outputFormat: 'text/javascript',
      format_options: 'callback:getJsonDma',
      srsName: 'EPSG:4326',
    };
    var parametersDma = L.Util.extend(dmaParameters);
    var dmaURL = owsrootUrl + L.Util.getParamString(parametersDma);

    $.ajax({
      url: dmaURL,
      dataType: 'jsonp',
      jsonpCallback: 'getJsonDma',
      success: function(data) {
        dma.addData(data);
        map.addLayer(dma);

        // Zoom to layer
        map.fitBounds(dma.getBounds());
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
      "Pelanggan PDAM": pelanggan,
			"Pipa": pipa,
      "DMA": dma,
    };

    var controllayer = L.control.layers(baseMaps, overlayMaps, {
      collapsed: false
    });
    controllayer.addTo(map);

		// Fungsi Update Layer berdasarkan bbox peta
    function updateLayer() {
      // bbox
      var bounds = map.getBounds();
      var minll = bounds.getSouthWest();
      var maxll = bounds.getNorthEast();
      var bbox = minll.lng + ',' + minll.lat + ',' + maxll.lng + ',' + maxll.lat;
      console.log(bbox);

      // URL
      var pelangganURL = owsrootUrl + L.Util.getParamString(L.Util.extend(pelangganParameters, {
        bbox: bbox
      }));
			$.ajax({
				url: pelangganURL,
				dataType: 'jsonp',
				jsonpCallback: 'getJson',
				success: function(data) {
					pelanggan.clearLayers();
					pelanggan.addData(data);
					map.addLayer(pelanggan);
				}
			});

			var pipaURL = owsTutorialUrl + L.Util.getParamString(L.Util.extend(pipaParameters, {
				bbox: bbox
			}));
			$.ajax({
				url: pipaURL,
				dataType: 'jsonp',
				jsonpCallback: 'getJsonPipa',
				success: function(data) {
					pipa.clearLayers();
					pipa.addData(data);
					map.addLayer(pipa);
				}
			});
    }

		// Event ketika peta digeser
    map.on('moveend', function() {
      updateLayer();
    });

		// Event ketika peta di-zoom
    map.on('zoomend', function() {
      updateLayer();
    });
  </script>
</body>

</html>
