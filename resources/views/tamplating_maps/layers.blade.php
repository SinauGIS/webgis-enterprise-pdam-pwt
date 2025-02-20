<script>
  // layer
  var wfsgeoserver = L.geoJson(null, {
    style: function(feature) { //Fungsi style polyline
      return {
        color: "gray", //Warna garis tepi polygon
        weight: 1, //Tebal garis tepi polygon
        opacity: 1, //Transparansi garis tepi polygon
        fillColor: "red", //Warna fill polygon
        fillOpacity: 0.7 //Transparansi polygon
      };
    },
    onEachFeature: function(feature, layer) {
      var content = "<table>" +
        "<tr><th>Kecamatan</th><td>" + feature.properties.kecamatan + "</td></tr>" +
        "<tr><th>Luas</th><td>" + feature.properties.luas_km + " Km<sup><small>2</small></sup></td></tr>" +
        "</table>";

      layer.on({
        click: function(e) { //Fungsi ketika obyek diklik
          wfsgeoserver.bindPopup(content);
        },
        mouseover: function(e) { //Fungsi mouse berada di atas obyek untuk highlight
          var layer = e.target; //variabel layer
          layer.setStyle({ //Highlight style
            color: "gray", //Warna garis tepi polygon
            weight: 2, //Tebal garis tepi polygon
            opacity: 1, //Transparansi garis tepi polygon
            fillColor: "cyan", //Warna tengah polygon
            fillOpacity: 0.7 //Transparansi polygon
          });
          wfsgeoserver.bindTooltip(feature.properties.kecamatan, {
            sticky: true
          });
        },
        mouseout: function(e) { //Fungsi mouse keluar dari obyek
          wfsgeoserver.resetStyle(e.target); //Mengembalikan style garis ke style awal
          map.closePopup(); //Menutup popup
        }
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
      maps.addLayer(wfsgeoserver);

      // Zoom to layer
      maps.fitBounds(wfsgeoserver.getBounds());
    }
  });
</script>
