<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="asset/img/icon.png" rel="shortcut icon" type="image/png">
  <title>Persebaran Covid - IT PENS PSDKU Sumenep</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link href="asset/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
  <style type="text/css">
    html,
    body,
    .container-fluid,
    #map {
      height: 100vh;
      margin: 0px;
      padding: 0px;
    }

    .container-fluid {
      padding-top: 0;
    }

    .row-map {
      width: 100%;
      height: 85%;
      margin: 0px;
      padding: 0px;
    }

    .row-info {
      width: 100%;
      height: 15%;
      margin: 0px;
      padding: 0px;
    }

    .col-sm {
      padding: 0px;
    }

    .info {
      padding: 6px 8px;
      font: 14px/16px Arial, Helvetica, sans-serif;
      background: white;
      background: rgba(255, 255, 255, 0.8);
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      border-radius: 5px;
    }

    .info h5 {
      margin: 0 0 5px;
      color: #000;
    }
  </style>
  
</head>
<body>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

  <div class="container-fluid">
    <div class="row row-map">
      <div class="col-sm">
        <div id="map"></div>
      </div>
    </div>
      <?php
        $dataIndonesia = file_get_contents("https://api.kawalcorona.com/indonesia/");
        $kasusIndonesia = json_decode($dataIndonesia);

        foreach($kasusIndonesia as $item){
        }
      ?>
      
  
  <script>
    /* Map */
    var map = L.map('map').setView([-2.4058653,117.5021489],5);
    
    /* Basemap */
    var basemap = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/light-v10',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
            });
    basemap.addTo(map);

    /* GeoJSON*/

    var kasuscorona = L.geoJson(null, {
      style: function (feature) {
        if (feature.properties.Kasus_Positif <= 100) {
          return {
            opacity: 1,
            color: 'white',
            weight: 1.0,
            fillOpacity: 0.8,
            fillColor: '#fff700'
          }
        }
        else if (feature.properties.Kasus_Positif > 100 && feature.properties.Kasus_Positif <= 1000) {
          return {
            opacity: 1,
            color: 'white',
            weight: 1.0,
            fillOpacity: 0.8,
            fillColor: '#ffb700' 
          }
        }
        else if (feature.properties.Kasus_Positif > 1000 && feature.properties.Kasus_Positif <= 5000) {
          return {
            opacity: 1,
            color: 'white',
            weight: 1.0,
            fillOpacity: 0.8,
            fillColor: '#ff6200'
          }
        }
        else if (feature.properties.Kasus_Positif > 5000) {
          return {
            opacity: 1,
            color: 'white',
            weight: 1.0,
            fillOpacity: 0.8,
            fillColor: '#fc2403'
          }
        }
        else {
          return {
            opacity: 1,
            color: 'white',
            weight: 1.0,
            fillOpacity: 0.8,
            fillColor: 'rgb(37, 150, 210)'
          }
        }
      },
      onEachFeature: function (feature, layer) {
        var content =
          "<div class='card-header alert-success text-center p-1'><strong>Provinsi<br>" + feature.properties.PROV + "</strong></div>" +
          "<div class='card-body p-0'>" +
            "<table class='table table-responsive-sm m-0'>" +
              "<tr class='text-warning'><th><i class='fas fa-virus'></i> Positif</th><th>" + feature.properties.Kasus_Positif + "</th></tr>" +
              "<tr class='text-success'><th><i class='fas fa-virus'></i> Sembuh</th><th>" + feature.properties.Kasus_Sembuh + "</th></tr>" +
              "<tr class='text-danger'><th><i class='fas fa-virus'></i> Meninggal</th><th>" + feature.properties.Kasus_Meninggal + "</th></tr>" +
            "</table>" +
          "</div>";          
        layer.on({
          mouseover: function (e) {
            var layer = e.target;
            layer.setStyle({
              weight: 1,
              color: "white",
              opacity: 1,
              fillColor: "#14fc03",
              fillOpacity: 0.8,
            });
            kasuscorona.bindTooltip("Provinsi " + feature.properties.PROV);
          },
          mouseout: function (e) {
            kasuscorona.resetStyle(e.target);
            map.closePopup();
          },
          click: function (e) {
            kasuscorona.bindPopup(content);
          }
        });
      }
    });
    $.getJSON("parse-geojson.php", function (data) {
      kasuscorona.addData(data);
      map.addLayer(kasuscorona);
      map.fitBounds(kasuscorona.getBounds());
    });

    /* Legend */
    var legend = new L.Control({position: 'topright'});
    legend.onAdd = function (map) {
      this._div = L.DomUtil.create('div', 'info');
      this.update();
      return this._div;
    };
    legend.update = function () {
      this._div.innerHTML = '<h5>Ket. Warna</h5><svg width="32" height="20"><rect width="32" height="17" style="fill:#77ff00;stroke-width:0.1;stroke:rgb(0,0,0)" /></svg> Tidak ada kasus<br><svg width="32" height="20"><rect width="32" height="17" style="fill:#fff700;stroke-width:0.1;stroke:rgb(0,0,0)" /></svg> Positif < 100 <br><svg width="32" height="20"><rect width="32" height="17" style="fill:#ffb700;stroke-width:0.1;stroke:rgb(0,0,0)" /></svg> Positif 101 - 1000<br><svg width="32" height="20"><rect width="32" height="17" style="fill:#ff6200;stroke-width:0.1;stroke:rgb(0,0,0)" /></svg> Positif 1001 - 5000<br><svg width="32" height="20"><rect width="32" height="17" style="fill:#fc2403;stroke-width:0.1;stroke:rgb(0,0,0)" /></svg> Positif > 5000'
    };
    legend.addTo(map);
  </script>
</body>
</html>