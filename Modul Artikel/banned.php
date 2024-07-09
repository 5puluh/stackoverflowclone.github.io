<?php
include "config/koneksi.php";
if($_GET['b']=='b'){
  $sql = "UPDATE user set user.status='1' where username ='".$_GET['username']."'";
  $result = mysqli_query($mysqli, $sql);
  if($result){
    echo "<script>alert('Berhasil dibanned');window.history.back()-1</script>";
  }else{
    echo "<script>alert('gagal banned');window.history.back()-1</script>";
  }
}else{
  $sql = "UPDATE user set user.status='0' where username ='".$_GET['username']."'";
  $result = mysqli_query($mysqli, $sql);
  if($result){
    echo "<script>alert('Berhasil diunbanned');window.history.back()-1</script>";
  }else{
    echo "<script>alert('gagal unbanned');window.history.back()-1</script>";
  }
}
?>
