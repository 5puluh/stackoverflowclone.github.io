<?php
session_start();
include "header.php";
?>
<link href="asset/css/dataTables.bootstrap4.min.css" rel="stylesheet">

  <main class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">List User</h6>
        <div class="panel panel-default widget">
          <div class="panel-body">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
          <?php
            $sql = "SELECT * from user";
            $result = mysqli_query($mysqli, $sql);
            while ($data = mysqli_fetch_array($result)) {
              if(empty($data['status']) || $data['status']=='0'){
                echo "<tr>";
              }else{
                echo "<tr class='table-danger'>";
              }
             
              echo "<td><a href='user.php?username=".$data['username']."'>".$data['username']."</a></td>";
              echo "<td>".$data['nama_lengkap']."</td>";
              if((empty($data['status']) || $data['status']=='0')&& $data['level_user']!='1'){
                echo "<td><a href='banned.php?b=b&username=".$data['username']."' class='btn btn-warning btn-sm'>Ban</a> ";
                echo "<a href='hapus_user.php?username=".$data['username']."' class='btn btn-danger btn-sm'>Hapus</a>";
                echo"</td>";
              }else if( $data['status']=='1' && $data['level_user']!='1'){
                echo "<td>Baned ";
                echo "<a href='banned.php?b=u&username=".$data['username']."' class='btn btn-success btn-sm'>Unbaned</a>";
                echo "</td>";
              }else{
                echo "<td>Admin</td>";
              }
              echo "</tr>";
            }
          ?>
        </tbody>
        
    </table>
          </div>
        </div>
      </div>
  </main>
  <script src="asset/js/jquery-3.5.1.js"></script>
  <script src="asset/js/jquery.dataTables.min.js"></script>
  <script src="asset/js/dataTables.bootstrap4.min.js"></script>
  
  <script src="asset/js/bootstrap.bundle.min.js"></script>
  <script src="asset/js/offcanvas.js"></script>
  <script>
    $(document).ready(function () {
    $('#example').DataTable();
});
  </script>
</body>

</html>
