<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Pendaftaran User</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



  <!-- Bootstrap core CSS -->
  <link href="asset/css/bootstrap.min.css" rel="stylesheet">

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
  <link href="asset/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin">
    <form action="register.php" method="post">
      <!--<img class="mb-4" src="asset/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
      <h1 class="h3 mb-3 fw-normal">Pendaftaran User</h1>
      <div class="form-floating">
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
        <label for="email">Alamat Email</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        <label for="username">Username</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
        <label for="nama">Nama Lengkap</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Ulangi Password">
        <label for="repassword">Ulangi Password</label>
      </div>

      <input class="w-100 btn btn-lg btn-primary" type="submit" name="register" value="Register"></input>

    </form>

  </main>


</body>

</html>
<?php
if (isset($_POST['register'])) {
  include 'config/koneksi.php';
  $email = $_POST['email'];
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $password = $_POST['password'];
  $repassword = $_POST['repassword'];
  if ($password <> $repassword) {
    $pesan = "Password berbeda";
  } else {
    $sanitized_email = mysqli_real_escape_string($mysqli, $email);
    $sanitized_username = mysqli_real_escape_string($mysqli, $username);
    $sanitized_nama = mysqli_real_escape_string($mysqli, $nama);
    $sanitized_password = mysqli_real_escape_string($mysqli, $password);

    $sql = "INSERT INTO user (username,email,nama_lengkap,level_user,password,status)
   values ('" . $sanitized_username . "',
          '" . $sanitized_email . "',
          '" . $sanitized_nama . "',2,
          '" . md5($sanitized_password) . "','0')";

    $result = mysqli_query($mysqli, $sql);
    if ($result) {
      $pesan = "Register Berhasil";
      echo "<script>alert('" . $pesan . "')</script>";
      //header("Location:index.php");
      echo "<script>window.location.href='index.php'</script>";
    } else {
      $pesan = mysqli_error($mysqli);
      echo "<script>alert('" . $pesan . "')</script>";
    }
  }
} else {
}
?>
