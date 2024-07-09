<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Halaman Login</title>

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
    <form action="login.php" method="post">
      <h1 class="h3 mb-3 fw-normal">Halaman Login</h1>
      <div class="form-floating">
        <input type="text" class="form-control" id="username" name="username" placeholder="input username">
        <label for="username">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
      </div>
      <input class="w-100 btn btn-lg btn-primary" type="submit" name="login" value="Login"></input>

    </form>
    <br>

    <span>Jika belum memiliki akun, silahkan <a href="register.php">Register</a> </span>
  </main>


</body>

</html>
<?php
if (isset($_POST['login'])) {
  
  //echo "<script>alert('" . $_POST['email'] . "')</script>";
  include 'config/koneksi.php';
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sanitized_username = mysqli_real_escape_string($mysqli, $username);

  $sanitized_password = mysqli_real_escape_string($mysqli, $password);

  $sql = "SELECT * FROM user WHERE username = '"
    . $sanitized_username . "' AND password = '"
    . md5($sanitized_password) . "' ";

  $result = mysqli_query($mysqli, $sql)
    or die(mysqli_error($mysqli));

  $num = mysqli_fetch_array($result);

  if ($num > 0) {
    if($num['status']=='1'){
      echo "<script>alert('Username anda di baned')</script>";
      echo "<script>window.location.href='login.php'</script>";
    }else{
      echo "<script>alert('Login Sukses')</script>";
      $_SESSION['username'] = $num['username'];
      
      $_SESSION['level'] = $num['level_user'];
    }
   
    //header("Location:index.php");
    echo "<script>window.location.href='index.php'</script>";
  } else {
    echo "<script>alert('Password atau Username Salah')</script>";
  }
} else {
}
?>
