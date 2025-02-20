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

  <script>
    var center = [-7.4279302, 109.2408501];

    var map = L.map('map').setView(center, 11);

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

    /* Layer GeoServer WFS */
    map.createPane("pane_pelanggan_dma");
    map.getPane("pane_pelanggan_dma").style.zIndex = 401;
    var pelanggan_dma = L.geoJson(null, {
      pane: 'pane_pelanggan_dma',
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
            pelanggan_dma.bindPopup(popup_content);
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
        pelanggan_dma.addData(data);
        map.addLayer(pelanggan_dma);

        // Zoom to layer
        map.fitBounds(pelanggan_dma.getBounds());
      }
    });

    // var pelangganParameters = {
    // 	service: 'WFS',
    // 	version: '1.0.0',
    // 	request: 'GetFeature',
    // 	typeName: 'purwokerto:pelanggan_pdam',
    // 	outputFormat: 'text/javascript',
    // 	format_options: 'callback:getJson1',
    // 	srsName: 'EPSG:4326',
    // 	// cql_filter: "kode_dma='01021'",
    // 	maxFeatures: 100,
    // };
    // var pelanggan_parameters = L.Util.extend(pelangganParameters);
    // var pelangganURL = owsrootUrl + L.Util.getParamString(pelanggan_parameters);

    // $.ajax({
    // 	url: pelangganURL,
    // 	dataType: 'jsonp',
    // 	jsonpCallback: 'getJson1',
    // 	success: function (data) {
    // 		pelanggan.addData(data);
    // 		map.addLayer(pelanggan);
    // 	}
    // });

    /* Layer GeoServer WMS */
    map.createPane("pane_pelanggan");
    map.getPane("pane_pelanggan").style.zIndex = 450;
    var pelanggan = L.tileLayer.wms("http://103.25.210.59:8080/geoserver/pdam/wms", {
      layers: 'pdam:stagging_cust',
      format: 'image/png',
      version: '1.1.1',
      transparent: true,
      opacity: 0.8,
      attribution: 'WMS GeoServer',
      maxZoom: 20,
      pane: 'pane_pelanggan',
    });
    pelanggan.addTo(map);

    //GetFeatureInfo Layer
    vector = L.geoJSON();
    vector.addTo(map);

    map.on("click", GetFeatureInfo, pelanggan);

    function GetFeatureInfo(e) {
      let me = this,
        map = me._map,
        loc = e.latlng,
        // xy = e.containerPoint,
        xy = map.latLngToContainerPoint(loc, map.getZoom()),
        size = map.getSize(),
        bounds = map.getBounds(),
        url = me._url,
        crs = me.options.crs || map.options.crs, // me._crs
        sw = crs.project(bounds.getSouthWest()),
        ne = crs.project(bounds.getNorthEast()),
        params = me.wmsParams,
        obj = {
          service: "WMS", // WMS (default)
          version: params.version,
          request: "GetFeatureInfo",
          layers: params.layers,
          styles: params.styles,
          // bbox: bounds.toBBoxString(), // works only with EPSG4326, but not with EPSG3857
          bbox: sw.x + "," + sw.y + "," + ne.x + "," + ne.y, // works with both EPSG4326, EPSG3857
          width: size.x,
          height: size.y,
          query_layers: params.layers,
          info_format: "application/json",
          feature_count: 1 // 1 (default)
        };

      // console.log(obj);

      if (parseFloat(params.version) >= 1.3) {
        obj.crs = crs.code; // params.crs
        obj.i = xy.x;
        obj.j = xy.y;
      } else {
        obj.srs = crs.code; // params.srs
        obj.x = xy.x;
        obj.y = xy.y;
      }
      $.ajax({
        url: url + L.Util.getParamString(obj, url, true),
        success: function(data, status, xhr) {
          console.log(data);
          var features = data.features,
            html = "",
            popup;
          map.removeLayer(vector);
          if (features.length) {
            // vector = L.geoJSON(data, { // works with both EPSG4326, EPSG3857
            // works only with EPSG4326, but EPSG3857 doesn't highlights geometry, so we used proj4, proj4leaflet to convert geojson from EPSG3857 to EPSG4326

            vector = L.Proj.geoJson(data, {
              style: function(feature) {
                return {
                  // fillColor: "cyan",
                  // fillOpacity: 0.7,
                  color: "yellow",
                  // weight: 1,
                  opacity: 1,
                };
              },
              onEachFeature: function(feature, layer) {
                var infoPopup = "<table>" +
                  "<tr><th>Nama</th><td>" + feature.properties.nama + "</td></tr>" +
                  "<tr><th>Alamat</th><td>" + feature.properties.alamat + "</td></tr>" +
                  "<tr><th>Kecamatan</th><td>" + feature.properties.kecamatan + "</td></tr>" +
                  "</table>";
                layer.on({
                  mouseover: function(e) {
                    vector.bindTooltip(infoPopup, {
                      sticky: true,
                      direction: 'top'
                    });
                  },
                });
              }
            }).addTo(map); // works with both EPSG4326, EPSG3857

            //POPUP
            // for (let i in features) {
            // 	let feature = features[i],
            // 		attributes = feature.properties;
            // 	html += "<table>" +
            // 		"<tr><th>Nama</th><td>" + attributes.nama + "</td></tr>" +
            // 		"<tr><th>Alamat</th><td>" + attributes.alamat + "</td></tr>" +
            // 		"<tr><th>Kecamatan</th><td>" + attributes.kecamatan + "</td></tr>" +
            // 		"</table>";
            // }
            // popup = L.popup(null, me).setLatLng(loc).setContent(html).openOn(map);
            // me.on("popupclose", function () {
            // 	map.removeLayer(vector);
            // 	me.off("popupclose", function () { });
            // });

            //zoom to layer
            map.fitBounds(vector.getBounds());
          } else {
            console.log('No features found.');
          }
        },
        error: function(xhr, status, err) {
          map.removeLayer(vector);
          html = "Unable to complete the request.: " + err;
          L.popup().setLatLng(loc).setContent(html).openOn(map);
        }
      });
    }

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
      "Distrik Meter Area<br>&nbsp;<svg width='24' height='15'><rect x='2' y='2' width='20' height='12' stroke='gray' stroke-width='1' fill='#ffffb2' /></svg> < 2500<br>&nbsp;<svg width='24' height='15'><rect x='2' y='2' width='20' height='12' stroke='gray' stroke-width='1' fill='#fd8d3c' /></svg> 2500 - 5000<br>&nbsp;<svg width='24' height='15'><rect x='2' y='2' width='20' height='12' stroke='gray' stroke-width='1' fill='#bd0026' /></svg> > 5000": pelanggan_dma,
    };

    var controllayer = L.control.layers(baseMaps, overlayMaps, {
      collapsed: false
    });
    controllayer.addTo(map);
  </script>
</body>

</html>
