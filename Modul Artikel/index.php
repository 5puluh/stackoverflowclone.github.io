<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);  
include "config/koneksi.php";
if(isset($_SESSION['username']) && ($_SESSION['username']!=='') ){
  include "app.php";
  //var_dump($_SESSION['username']);
}
else{
  include "home.php";
  //var_dump($_SESSION['username']);
}
?>
