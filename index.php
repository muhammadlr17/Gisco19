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
  <link href="asset/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">

</head>
<style>
    * {
      box-sizing: border-box;
    }
    
    body {
      margin: 0;
      font-family: Arial;
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
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="map-idn-polygon.php">Vector with Polygon</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="map-idn-point.php">Raster with Point</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data-idn.php">Data</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">

    <div class="row">
      <div class="col-lg-13 mx-auto" >
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="asset/img/slide1.png" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="asset/img/slide2.png" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="asset/img/slide3.png" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div> 
      </div>
    </div>

    <div class="pricing-header px-3 py-3 pt-md-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Kasus Covid-19 Dunia</h1>
    </div>
    <div class="row">
  <?php
        $dataPositifDunia = file_get_contents("https://api.kawalcorona.com/positif");
        $dataSembuhDunia = file_get_contents("https://api.kawalcorona.com/sembuh");
        $dataMeninggalDunia = file_get_contents("https://api.kawalcorona.com/meninggal");
        
        $kasusPositifDunia = json_decode($dataPositifDunia);
        $kasusSembuhDunia = json_decode($dataSembuhDunia);
        $kasusMeninggalDunia = json_decode($dataMeninggalDunia);
    ?>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 text-center shadow">
        <img class="card-img-top" src="asset/img/world-positif.png" alt="">
        <div class="card-body">
          <h5 class="card-title">
            Total Positif
          </h5>
          <h3 class="text-warning"><b><?php echo $kasusPositifDunia->value; ?></b></h3>
          <p class="card-text">Orang</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Sumber : <a href="http://api.kawalcorona.com/positif">kawalcorona.com</a></small>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 text-center shadow">
       <img class="card-img-top" src="asset/img/world-sembuh.png" alt="">
        <div class="card-body">
          <h5 class="card-title">
            Total Sembuh
          </h5>
          <h3 class="text-success"><b><?php echo $kasusSembuhDunia->value; ?></b></h3>
          <p class="card-text">Orang</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Sumber : <a href="http://api.kawalcorona.com/sembuh">kawalcorona.com</a></small>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 text-center shadow">
        <img class="card-img-top" src="asset/img/world-meninggal.png" alt="">
        <div class="card-body">
          <h5 class="card-title">
            Total Meninggal
          </h5>
          <h3 class="text-danger"><b><?php echo $kasusMeninggalDunia->value; ?></b></h3>
          <p class="card-text">Orang</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Sumber : <a href="http://api.kawalcorona.com/meninggal">kawalcorona.com</a></small>
        </div>
      </div>
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
