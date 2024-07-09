<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "sosialmedia";

$mysqli =  mysqli_connect($server,$username,$password ,$database);

//Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>
