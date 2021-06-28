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
  <link href="asset/datatables/dataTables.bootstrap4.css" rel="stylesheet">

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
    <link href="asset\css\card.css" rel="stylesheet">
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
          <li class="nav-item">
            <a class="nav-link" href="map-idn-point.php">Raster with Point</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="data-idn.php">Data</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Data Covid-19 Indonesia</h1>
  <p class="lead">Live Data Berdasarkan Provinsi</p>
</div>

<div class="container">
  <div class="row">
  <?php
        $dataIndonesia = file_get_contents("https://api.kawalcorona.com/indonesia/");
        $kasusIndonesia = json_decode($dataIndonesia);

        foreach($kasusIndonesia as $item){
    ?>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 text-center shadow">
       <img class="card-img-top" src="asset/img/positif.png" alt="">
        <div class="card-body">
          <h5 class="card-title">
            Positif
          </h5>
          <h3 class="text-warning"><b><?php echo $item->positif; ?></b></h3>
          <p class="card-text">Orang</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Sumber : <a href="http://api.kawalcorona.com/indonesia">kawalcorona.com</a></small>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 text-center shadow">
        <img class="card-img-top" src="asset/img/sembuh.png" alt="">
        <div class="card-body">
          <h5 class="card-title">
            Sembuh
          </h5>
          <h3 class="text-success"><b><?php echo $item->sembuh; ?></b></h3>
          <p class="card-text">Orang</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Sumber : <a href="http://api.kawalcorona.com/indonesia">kawalcorona.com</a></small>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 text-center shadow">
        <img class="card-img-top" src="asset/img/meninggal.png" alt="">
        <div class="card-body">
          <h5 class="card-title">
            Meninggal
          </h5>
          <h3 class="text-danger"><b><?php echo $item->meninggal; ?></b></h3>
          <p class="card-text">Orang</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Sumber : <a href="http://api.kawalcorona.com/indonesia">kawalcorona.com</a></small>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <br>
  <div class="card shadow mb-4">
  <div class="card-header text-center">
    Data Covid-19 per Provinsi
  </div>
  <div class="card-body">
  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Provinsi</th>
      <th scope="col">Kasus Positif</th>
      <th scope="col">Kasus Sembuh</th>
      <th scope="col">Kasus Meninggal</th>
    </tr>
  </thead>
  <tbody>
  <?php
        $no = 1;
        $dataIndonesia = file_get_contents("https://api.kawalcorona.com/indonesia/provinsi");
        $kasusIndonesia = json_decode($dataIndonesia);

        foreach($kasusIndonesia as $item){
    ?>
    <tr>
      <th scope="row"><?php echo $no++?></th>
      <td><?php echo $item->attributes->Provinsi ?> </td>
      <td><?php echo $item->attributes->Kasus_Posi ?></td>
      <td><?php echo $item->attributes->Kasus_Semb ?></td>
      <td><?php echo $item->attributes->Kasus_Meni ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
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
   <script src="asset/datatables/jquery.dataTables.js"></script>
   <script src="asset/datatables/dataTables.bootstrap4.js"></script>
   <script src="asset/js/demo/datatables-demo.js"></script>

</body>

</html>