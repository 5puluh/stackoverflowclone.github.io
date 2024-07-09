<?php
include "config/koneksi.php";
$sql = "UPDATE artikel set artikel.like=artikel.like+1 where id=".$_GET['id'];
$result = mysqli_query($mysqli, $sql);
if ($result) {
  echo "<script>alert('Berhasil like artikel');window.history.back()-1</script>";
} else {
  echo "<script>alert('Gagal like artikel)</script>";
}
?>
