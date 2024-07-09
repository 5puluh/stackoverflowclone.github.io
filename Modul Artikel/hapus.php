<?php
include "config/koneksi.php";
$sql2 = "DELETE from comment where id_artikel=".$_GET['id'];
$result2 = mysqli_query($mysqli, $sql2);
$sql = "DELETE from artikel where id=".$_GET['id'];
$result = mysqli_query($mysqli, $sql);
if ($result) {
  echo "<script>alert('Berhasil menghapus data');window.history.back()-1</script>";
} else {
  echo "<script>alert('Gagal menghapus data)</script>";
}
?>
