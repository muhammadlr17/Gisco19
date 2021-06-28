<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="asset/img/fav.png" rel="shortcut icon" type="image/png">

  <title>GISCO-19 | IT PENS PSDKU Sumenep</title>

  <!-- CSS -->
  <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="asset/css/page.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link href="asset/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">

</head>
<style>
    * {
      box-sizing: border-box;
    }
    
    body {
      margin: 0;
      font-family: Arial;
    }
    
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

    .header {
      text-align: center;
      padding: 32px;
    }
    
    .row {
      display: -ms-flexbox; /* IE10 */
      display: flex;
      -ms-flex-wrap: wrap; /* IE10 */
      flex-wrap: wrap;
      padding: 0 4px;
    }
    
    /* Create four equal columns that sits next to each other */
    .column {
      -ms-flex: 25%; /* IE10 */
      flex: 25%;
      max-width: 25%;
      padding: 0 4px;
    }
    
    .column img {
      margin-top: 8px;
      vertical-align: middle;
      width: 100%;
    }
    
    /* Responsive layout - makes a two column-layout instead of four columns */
    @media screen and (max-width: 800px) {
      .column {
        -ms-flex: 50%;
        flex: 50%;
        max-width: 50%;
      }
    }
    
    /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
      .column {
        -ms-flex: 100%;
        flex: 100%;
        max-width: 100%;
      }
    }
    </style>
<body>

  <!-- Nav -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top shadow">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="asset/img/logo.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="map-idn-polygon.php">Vector with Polygon</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="map-idn-point.php">Raster with Point</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data-idn.php">Data</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <div class="container-fluid">
    <div class="row row-map">
      <div class="col-sm">
        <div id="map"></div>
      </div>
    </div>
      
  
  <script>
    /* Map */
    var map = L.map('map').setView([-2.4058653,117.5021489],5);
    
    /* Basemap */
    var basemap = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/satellite-streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
            });
    basemap.addTo(map);

    /*Custom Marker by Lutfi*/

    var LeafIcon = L.Icon.extend({
        options: {
            shadowUrl: 'asset/img/marker/380-3808746_virus-png-icon-virus-icon.png',
            iconSize:     [38, 38],
            shadowSize:   [30, 34],
            iconAnchor:   [20, 38],
            shadowAnchor: [4, 20],
            popupAnchor:  [-3, -76]
        }
    });

    var greenIcon = new LeafIcon({iconUrl: 'asset/img/marker/green.png'}),
        yellowIcon = new LeafIcon({iconUrl: 'asset/img/marker/yellow.png'}),
        lighOrangeIcon = new LeafIcon({iconUrl: 'asset/img/marker/lightorange.png'}),
        orangeIcon = new LeafIcon({iconUrl: 'asset/img/marker/orange.png'}),
        redIcon = new LeafIcon({iconUrl: 'asset/img/marker/red.png'});

    /* GeoJSON*/

    var noKasus = L.geoJson(null, {
      pointToLayer: function (feature, latlng) {
        if (feature.properties) {
          return L.marker(latlng, {
            icon: greenIcon,
            riseOnHover: true
          });
        }
      },
      onEachFeature: function (feature, layer) {
        if (feature.properties) {
          var content = "<div class='card'> <img class='card-img-top' src='asset/img/headercard.png' alt=''>" +
          "<div class='card-header text-center p-1'><strong>" + feature.properties.PROV + "</strong></div>" +
          "<div class='card-body p-0'>" +
            "<table class='table table-responsive-sm m-0'>" +
              "<tr class='text-warning'><th><i class='fas fa-virus'></i> Positif</th><th>" + feature.properties.Kasus_Positif + "</th></tr>" +
              "<tr class='text-success'><th><i class='fas fa-virus'></i> Sembuh</th><th>" + feature.properties.Kasus_Sembuh + "</th></tr>" +
              "<tr class='text-danger'><th><i class='fas fa-virus'></i> Meninggal</th><th>" + feature.properties.Kasus_Meninggal + "</th></tr>" +
            "</table>" +
          "</div>" +
          "</div>"; 
          layer.on({
            click: function (e) {
              noKasus.bindPopup(content);
            },
            mouseover: function (e) {
              noKasus.bindTooltip("Prov. " + feature.properties.PROV);
            }
          });
        }
      },
      filter: function(feature, layer) {
        return (feature.properties.Kasus_Positif = 0);
      }
    });

    var kasusrendah = L.geoJson(null, {
      pointToLayer: function (feature, latlng) {
        if (feature.properties) {
          return L.marker(latlng, {
            icon: yellowIcon,
            riseOnHover: true
          });
        }
      },
      onEachFeature: function (feature, layer) {
        if (feature.properties) {
          var content = "<div class='card'> <img class='card-img-top' src='asset/img/headercard.png' alt=''>" +
          "<div class='card-header text-center p-1'><strong>" + feature.properties.PROV + "</strong></div>" +
          "<div class='card-body p-0'>" +
            "<table class='table table-responsive-sm m-0'>" +
              "<tr class='text-warning'><th><i class='fas fa-virus'></i> Positif</th><th>" + feature.properties.Kasus_Positif + "</th></tr>" +
              "<tr class='text-success'><th><i class='fas fa-virus'></i> Sembuh</th><th>" + feature.properties.Kasus_Sembuh + "</th></tr>" +
              "<tr class='text-danger'><th><i class='fas fa-virus'></i> Meninggal</th><th>" + feature.properties.Kasus_Meninggal + "</th></tr>" +
            "</table>" +
          "</div>" +
          "</div>"; 
          layer.on({
            click: function (e) {
              kasusrendah.bindPopup(content);
            },
            mouseover: function (e) {
              kasusrendah.bindTooltip("Prov. " + feature.properties.PROV);
            }
          });
        }
      },
      filter: function(feature, layer) {
        return (feature.properties.Kasus_Positif > 0 && feature.properties.Kasus_Positif <= 100);
      }
    });

    var kasusagakrendah = L.geoJson(null, {
      pointToLayer: function (feature, latlng) {
        if (feature.properties) {
          return L.marker(latlng, {
            icon: lighOrangeIcon,
            riseOnHover: true
          });
        }
      },
      onEachFeature: function (feature, layer) {
        if (feature.properties) {
          var content = "<div class='card'> <img class='card-img-top' src='asset/img/headercard.png' alt=''>" +
          "<div class='card-header text-center p-1'><strong>" + feature.properties.PROV + "</strong></div>" +
          "<div class='card-body p-0'>" +
            "<table class='table table-responsive-sm m-0'>" +
              "<tr class='text-warning'><th><i class='fas fa-virus'></i> Positif</th><th>" + feature.properties.Kasus_Positif + "</th></tr>" +
              "<tr class='text-success'><th><i class='fas fa-virus'></i> Sembuh</th><th>" + feature.properties.Kasus_Sembuh + "</th></tr>" +
              "<tr class='text-danger'><th><i class='fas fa-virus'></i> Meninggal</th><th>" + feature.properties.Kasus_Meninggal + "</th></tr>" +
            "</table>" +
          "</div>" +
          "</div>"; 
          layer.on({
            click: function (e) {
              kasusagakrendah.bindPopup(content);
            },
            mouseover: function (e) {
              kasusagakrendah.bindTooltip("Prov. " + feature.properties.PROV);
            }
          });
        }
      },
      filter: function(feature, layer) {
        return (feature.properties.Kasus_Positif > 100 && feature.properties.Kasus_Positif <= 1000);
      }
    });

    var kasussedang = L.geoJson(null, {
      pointToLayer: function (feature, latlng) {
        if (feature.properties) {
          return L.marker(latlng, {
            icon: orangeIcon,
            riseOnHover: true
          });
        }
      },
      onEachFeature: function (feature, layer) {
        if (feature.properties) {
          var content = "<div class='card'> <img class='card-img-top' src='asset/img/headercard.png' alt=''>" +
          "<div class='card-header text-center p-1'><strong>" + feature.properties.PROV + "</strong></div>" +
          "<div class='card-body p-0'>" +
            "<table class='table table-responsive-sm m-0'>" +
              "<tr class='text-warning'><th><i class='fas fa-virus'></i> Positif</th><th>" + feature.properties.Kasus_Positif + "</th></tr>" +
              "<tr class='text-success'><th><i class='fas fa-virus'></i> Sembuh</th><th>" + feature.properties.Kasus_Sembuh + "</th></tr>" +
              "<tr class='text-danger'><th><i class='fas fa-virus'></i> Meninggal</th><th>" + feature.properties.Kasus_Meninggal + "</th></tr>" +
            "</table>" +
          "</div>" +
          "</div>"; 
          layer.on({
            click: function (e) {
              kasussedang.bindPopup(content);
            },
            mouseover: function (e) {
              kasussedang.bindTooltip("Prov. " + feature.properties.PROV);
            }
          });
        }
      },
      filter: function(feature, layer) {
        return (feature.properties.Kasus_Positif > 1000 && feature.properties.Kasus_Positif <= 5000);
      }
    });

    var kasustinggi = L.geoJson(null, {
      pointToLayer: function (feature, latlng) {
        if (feature.properties) {
          return L.marker(latlng, {
            icon: redIcon,
            riseOnHover: true
          });
        }
      },
      onEachFeature: function (feature, layer) {
        if (feature.properties) {
          var content = "<div class='card'> <img class='card-img-top' src='asset/img/headercard.png' alt=''>" +
          "<div class='card-header text-center p-1'><strong>" + feature.properties.PROV + "</strong></div>" +
          "<div class='card-body p-0'>" +
            "<table class='table table-responsive-sm m-0'>" +
              "<tr class='text-warning'><th><i class='fas fa-virus'></i> Positif</th><th>" + feature.properties.Kasus_Positif + "</th></tr>" +
              "<tr class='text-success'><th><i class='fas fa-virus'></i> Sembuh</th><th>" + feature.properties.Kasus_Sembuh + "</th></tr>" +
              "<tr class='text-danger'><th><i class='fas fa-virus'></i> Meninggal</th><th>" + feature.properties.Kasus_Meninggal + "</th></tr>" +
            "</table>" +
          "</div>" +
          "</div>"; 
          layer.on({
            click: function (e) {
              kasustinggi.bindPopup(content);
            },
            mouseover: function (e) {
              kasustinggi.bindTooltip("Prov. " + feature.properties.PROV);
            }
          });
        }
      },
      filter: function(feature, layer) {
        return (feature.properties.Kasus_Positif > 5000);
      }
    });

    $.getJSON("union-point-geojson.php", function (data) {
      kasusrendah.addData(data);
      kasusagakrendah.addData(data);
      kasussedang.addData(data);
      kasustinggi.addData(data);
      var groupLayer = L.featureGroup([kasusrendah, kasusagakrendah, kasussedang, kasustinggi]);
      groupLayer.addTo(map);
      map.fitBounds(groupLayer.getBounds());
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
  </div>

  </div>

  <!-- Footer -->
  <footer class="py-2 bg-danger">
    <div class="container">
      <p class="m-0 text-center text-light">Copyright &copy; IT PENS PSDKU Sumenep</p>
    </div>
  </footer>

   <!-- Bootstrap core JavaScript -->
   <script src="asset/jquery/jquery.min.js"></script>
   <script src="asset/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
