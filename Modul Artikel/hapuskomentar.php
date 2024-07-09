<?php
include "config/koneksi.php";
$sql = "DELETE from comment where id=".$_GET['id'];
$result = mysqli_query($mysqli, $sql);
$sql2 = "UPDATE artikel set comment = comment-1 where id=".$_GET['idartikel'];
$result2 = mysqli_query($mysqli, $sql2);
if ($result) {
  echo "<script>alert('Berhasil menghapus data');window.history.back()-1</script>";
} else {
  echo "<script>alert('Gagal menghapus data)</script>";
}
?>
