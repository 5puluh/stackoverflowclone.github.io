<?php
session_start();
include "config/koneksi.php";
$sqlinsert= "INSERT INTO comment (id_artikel,comment,username,created_at)
values ('" . mysqli_real_escape_string($mysqli, $_GET['id']) . "',
       '" .  mysqli_real_escape_string($mysqli, $_GET['isi']). "',
       '".$_SESSION['username']."',
       '" . date('Y-m-d H:i:s'). "')";

$result = mysqli_query($mysqli, $sqlinsert);
if($result){
  $sql = "UPDATE artikel set artikel.comment=artikel.comment+1 where id=".$_GET['id'];
  $result2 = mysqli_query($mysqli, $sql);
  if ($result2) {
    echo "<script>alert('Berhasil comment artikel');window.history.back()-1</script>";
  } else {
    echo "<script>alert('Gagal comment artikel)</script>";
  }
}else{
  echo "<script>alert('Gagal comment artikel)</script>";
}

?>
