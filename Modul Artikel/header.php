<?php session_start();?>
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
      <a class="navbar-brand" href="index.php">Sosial Media</a>
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
            <a class="nav-link" href="index.php?menu=tambah">Buat Artikel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?menu=profil">Profil</a>
          </li>
          <?php if($_SESSION['level']=='1'){ ?>
          <li class="nav-item">
            <a class="nav-link" href="listuser.php">Daftar User</a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
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
      <a class="nav-link" href="index.php?menu=tambah">Buat Artikel</a>
    </nav>
  </div>
