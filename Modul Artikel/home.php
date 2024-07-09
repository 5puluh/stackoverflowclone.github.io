<!doctype html>
<html lang="en">
<?php
include "config/koneksi.php";
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">

  <title>Aplikasi Sosial Media</title>

  <link href="asset/css/bootstrap.min.css" rel="stylesheet">
  <link href="asset/css/comment.css" rel="stylesheet">
  <link href="asset/css/font-awesome.min.css" rel="stylesheet">
  <link href="asset/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="asset/fontawesome/css/brands.css" rel="stylesheet">
  <link href="asset/fontawesome/css/solid.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="asset/css/offcanvas.css" rel="stylesheet">
</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Sosial Media</a>
      <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Kategori</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown01">
              <?php
              $sql = "SELECT * from kategori";
              $result = mysqli_query($mysqli, $sql);
              while ($data = mysqli_fetch_array($result)) {
                echo "<li><a class='dropdown-item' href='?kategori=" . $data['id'] . "'>" . $data['kategori'] . "</a></li>";
              }
              ?>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="nav-scroller bg-body shadow-sm">
    <nav class="nav nav-underline" aria-label="Secondary navigation">
      <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
      <a class="nav-link" href="login.php">Login</a>
    </nav>
  </div>

  <main class="container">
    <?php
    if (empty($_GET['menu']) || !isset($_GET['menu'])) {
      $warna = array('', '#007bff', '#e83e8c', '#6f42c1');
    ?>
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Top Article</h6>
        <div class="panel panel-default widget">
          <div class="panel-body">
            <ul class="list-group">
              <?php
              if (isset($_GET['kategori']) || !empty($_GET['kategori'])) {
                $kondisi = "where artikel.kategori='" . $_GET['kategori'] . "'";
              } else {
                $kondisi = "";
              }
              $sql = "SELECT artikel.*,
              (artikel.comment*0.7 + artikel.like *0.3) as peringkat,
              kategori.kategori as nama_kategori,
              user.nama_lengkap,
              user.foto
              from artikel 
              left join kategori on kategori.id=artikel.kategori
              left join user on user.username=artikel.username " . $kondisi .
                "order by peringkat desc";
              $result = mysqli_query($mysqli, $sql);
              while ($data = mysqli_fetch_array($result)) {
                $jenis = $data['kategori'];
                if(!empty($data['foto'])){
                  $foto="images/".$data['foto'];
                }else{
                  $foto="asset/brand/user.svg";
                }
                echo '<li class="list-group-item">
                  <div class="row">
                      <div class="col-xs-2 col-md-1">
                          <img src="'.$foto.'" width="40px" class="img-circle img-responsive" alt="" /></div>
                      <div class="col-xs-10 col-md-11">
                          <div>
                              <a href="?kategori=' . $data['kategori'] . '">' . $data['nama_kategori'] . '</a>
                              <div class="mic-info">
                                  By: <a href="user.php?username='.$data['username'].'">' . $data['nama_lengkap'] . '</a> on ' . date('d F Y', strtotime($data['created_at'])) . '
                              </div>
                          </div>
                          <div class="comment-text">
                             ' . $data['ringkasan'] . '
                          </div>
                          <div class="action">
                              <button type="button" class="btn btn-primary btn-xs" title="Comment">
                              ' . $data['comment'] . ' <span class="fa fa-message"></span>
                              </button>
                              <button type="button" class="btn btn-success btn-xs" title="Approved">
                              ' . $data['like'] . ' <span class="fa fa-thumbs-up"></span>
                              </button>            
                          </div>
                      </div>
                      
                  </div>
                  
              </li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    <?php } ?>
  </main>


  <script src="asset/js/bootstrap.bundle.min.js"></script>
  <script src="asset/js/offcanvas.js"></script>
</body>

</html>
