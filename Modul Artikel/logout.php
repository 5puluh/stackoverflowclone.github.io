<?php
session_start();
session_destroy();
echo "<script>
if (confirm('Terimkasih. Anda telah logout') == true) {
  window.location.href='index.php';
} else {
  window.location.href='index.php';
}
</script>";
?>
