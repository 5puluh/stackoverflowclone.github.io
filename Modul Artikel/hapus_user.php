<?php
include "config/koneksi.php";

  $sql = "DELETE from user where username ='".$_GET['username']."'";
  $result = mysqli_query($mysqli, $sql);
  $sql2 = "DELETE from artikel where username ='".$_GET['username']."'";
  $result2 = mysqli_query($mysqli, $sql2);
  $sql3 = "DELETE from comment where username ='".$_GET['username']."'";
  $result2 = mysqli_query($mysqli, $sql3);
  if($result){
    echo "<script>alert('Berhasil hapus user');window.history.back()-1</script>";
  }else{
    echo "<script>alert('Gagal hapus user');window.history.back()-1</script>";
  }

?>
