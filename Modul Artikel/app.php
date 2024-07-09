<?php
include "header.php";
?>
  <main class="container">
    <?php
    if (empty($_GET['menu']) || !isset($_GET['menu'])) {
      $warna = array('', '#007bff', '#e83e8c', '#6f42c1');
    ?>
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Top Article</h6>
        <div class="panel panel-default widget">
          <div class="panel-body">
            <ul class="list-group">
              <?php
              if (isset($_GET['kategori']) || !empty($_GET['kategori'])) {
                $kondisi = "where artikel.kategori='" . $_GET['kategori'] . "'";
              } else {
                $kondisi = "";
              }
              $sql = "SELECT artikel.*,
              (artikel.comment*0.7 + artikel.like *0.3) as peringkat,
              kategori.kategori as nama_kategori,
              user.nama_lengkap,
              user.foto
              from artikel 
              left join kategori on kategori.id=artikel.kategori
              left join user on user.username=artikel.username " . $kondisi.
              "order by peringkat desc";
              $result = mysqli_query($mysqli, $sql);
              while ($data = mysqli_fetch_array($result)) {
                $jenis = $data['kategori'];
                if(!empty($data['foto'])){
                  $foto="images/".$data['foto'];
                }else{
                  $foto="asset/brand/user.svg";
                }
                echo '<li class="list-group-item">
                  <div class="row">
                      <div class="col-xs-2 col-md-1">
                          <img src="'.$foto.'" width="40px" class="img-circle img-responsive" alt="" /></div>
                      <div class="col-xs-10 col-md-11">
                          <div>
                              <a href="?kategori=' . $data['kategori'] . '">' . $data['nama_kategori'] . '</a>
                              <div class="mic-info">
                                  By: <a href="user.php?username='.$data['username'].'">' . $data['nama_lengkap'] . '</a> on ' . date('d F Y', strtotime($data['created_at'])) . '
                              </div>
                          </div>
                          <div class="comment-text">
                             ' . $data['ringkasan'] . '
                          </div>
                          <div class="action">
                              <button type="button" onclick="showComment('.$data['id'].')" class="btn btn-primary btn-xs" title="Comment">
                              '.$data['comment'].' <span class="fa fa-message"></span>
                              </button>
                              <button type="button" onClick="Like(' . $data['id'] . ')" class="btn btn-success btn-xs" title="Approved">
                              '.$data['like'].' <span class="fa fa-thumbs-up"></span>
                              </button>
                              <button type="button" onClick="ShowDetail(' . $data['id'] . ')" class="btn btn-warning btn-xs" title="Approved">
                              <span class="fa fa-search"> </span> show
                              </button>';
                if ($_SESSION['level'] == '1') {
                  echo '<button type="button" onClick="Hapus(' . $data['id'] . ')" class="btn btn-danger btn-xs" title="Delete">
                                  <span class="fa fa-trash"></span>
                              </button>';
                }

                echo '              
                          </div>
                          <div id="showComment'.$data['id'].'" style="display:none">
                            <textarea id="comment'.$data['id'].'" class="form-control"></textarea>
                            <button onClick="simpanComment('.$data['id'].')" class="btn btn-primary">comment</button>
                          </div>
                      </div>
                      
                  </div>
                  
              </li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    <?php }
    if (isset($_GET['menu']) && ($_GET['menu'] == 'tambah')) { ?>
      <form action="index.php" method="post">
        <div class="mb-3 mt-3">
          <input type="hidden" name="jenis" value="add" />
          <label for="kategori" class="form-label">Kategori:</label>
          <select name="kategori" id="kategori" class="form-control">
            <option value="">Pilih Kategori</option>
            <?php
            $sql = "SELECT * from kategori";
            $result = mysqli_query($mysqli, $sql);
            while ($data = mysqli_fetch_array($result)) {
              echo " <option value='" . $data['id'] . "'>" . $data['kategori'] . "</option>";
            }
            ?>
          </select>

        </div>
        <div class="mb-3">
          <label for="ringkasan" class="form-label">Ringkasan Artikel: <span id="char_count">250/250</span></label>
          <textarea name="ringkasan" id="ringkasan" class="form-control" rows="3" cols="60"> </textarea>


        </div>
        <div class="mb-3">
          <label for="isi" class="form-label">Isi Artikel:</label>
          <textarea class="form-control" name="isi" id="isi" rows="10" cols="60"></textarea>
        </div>

        <input type="submit" class="btn btn-primary" name="submit" value="Submit"></input>
      </form>
    <?php } 
    if (isset($_GET['menu']) && ($_GET['menu'] == 'detail')) { ?>
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Artikel</h6>
        <div class="panel panel-default widget">
          <div class="panel-body">
            <ul class="list-group">
              <?php
              $sql = "SELECT artikel.*,
              (artikel.comment*0.7 + artikel.like *0.3) as peringkat,
              kategori.kategori as nama_kategori,
              user.nama_lengkap,
              user.foto
              from artikel 
              left join kategori on kategori.id=artikel.kategori
              left join user on user.username=artikel.username 
              where artikel.id='".$_GET['id']."'
              order by peringkat desc";
              $result = mysqli_query($mysqli, $sql);
              while ($data = mysqli_fetch_array($result)) {
                $jenis = $data['kategori'];
                if(!empty($data['foto'])){
                  $foto="images/".$data['foto'];
                }else{
                  $foto="asset/brand/user.svg";
                }
                echo '<li class="list-group-item">
                  <div class="row">
                      <div class="col-xs-2 col-md-1">
                      <img src="'.$foto.'" width="40px" class="img-circle img-responsive" alt="" /></div>
                      <div class="col-xs-10 col-md-11">
                          <div>
                              <a href="?kategori=' . $data['kategori'] . '">' . $data['nama_kategori'] . '</a>
                              <div class="mic-info">
                                  By: <a href="user.php?username='.$data['username'].'">' . $data['nama_lengkap'] . '</a> on ' . date('d F Y', strtotime($data['created_at'])) . '
                              </div>
                          </div>
                          <div class="comment-text">
                            Ringkasan: <br>' . $data['ringkasan'] . '
                            <hr>
                            Isi : <br>' . $data['isi'] . '
                          </div>

                          <div class="action">
                              <button type="button" onClick="Like(' . $data['id'] . ')" class="btn btn-success btn-xs" title="Approved">
                              '.$data['like'].' <span class="fa fa-thumbs-up"></span>
                              </button>                                  
                          </div>
                          <div id="showComment'.$data['id'].'" style="display:none">
                            <textarea id="comment'.$data['id'].'" class="form-control"></textarea>
                            <button onClick="simpanComment('.$data['id'].')" class="btn btn-primary">comment</button>
                            </div>
                      </div>
                      
                  </div>
                  
              </li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Komentar</h6>
        <div class="panel panel-default widget">
          <div class="panel-body">
            <ul class="list-group">
              <?php
              $sql = "SELECT
              komen.*, 
              artikel.kategori, 
              (komen.jml_comment*0.7 + komen.jml_like *0.3) AS peringkat, 
              `user`.nama_lengkap, 
              kategori.kategori AS nama_kategori
            FROM
              `comment` AS komen
              LEFT JOIN
              artikel
              ON 
                artikel.id = komen.id_artikel
              LEFT JOIN
              kategori
              ON 
                kategori.id = artikel.kategori
              LEFT JOIN
              `user`
              ON 
                `user`.username = komen.username
            Where komen.id_artikel='".$_GET['id']."'
            ORDER BY
              peringkat DESC";
              $result = mysqli_query($mysqli, $sql);
              while ($data = mysqli_fetch_array($result)) {
                $jenis = $data['kategori'];
                echo '<li class="list-group-item">
                  <div class="row">
                      <div class="col-xs-2 col-md-1">
                          <img src="asset/brand/user.svg" class="img-circle img-responsive" alt="" /></div>
                      <div class="col-xs-10 col-md-11">
                          <div>
                              <a href="?kategori=' . $data['kategori'] . '">' . $data['nama_kategori'] . '</a>
                              <div class="mic-info">
                                  By: <a href="user.php?username='.$data['username'].'">' . $data['nama_lengkap'] . '</a> on ' . date('d F Y', strtotime($data['created_at'])) . '
                              </div>
                          </div>
                          <div class="comment-text">
                             ' . $data['comment'] . '
                          </div>
                          <div class="action">
                              <button type="button" onclick="showComment('.$data['id'].')" class="btn btn-primary btn-xs" title="Comment">
                              '.$data['jml_comment'].' <span class="fa fa-message"></span>
                              </button>
                              <button type="button" onClick="Like(' . $data['id'] . ')" class="btn btn-success btn-xs" title="Approved">
                              '.$data['jml_like'].' <span class="fa fa-thumbs-up"></span>
                              </button> ';
                              if ($_SESSION['level'] == '1') {
                                echo '<button type="button" onClick="HapusKomentar(\'' . $data['id'] . '\',\'' .$data['id_artikel']. '\')" class="btn btn-danger btn-xs" title="Delete">
                                                <span class="fa fa-trash"></span>
                                            </button>';
                              }
                            echo'        
                          </div>
                          <div id="showComment'.$data['id'].'" style="display:none">
                            <textarea id="comment'.$data['id'].'" class="form-control"></textarea>
                            <button onClick="simpanComment('.$data['id'].')" class="btn btn-primary">comment</button>
                          </div>
                      </div>
                      
                  </div>
                  
              </li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    <?php } 
     if (isset($_GET['menu']) && ($_GET['menu'] == 'profil')) { ?>
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Profil User</h6>
        <div class="panel panel-default widget">
          <div class="panel-body">
            <?php
              $sql = "SELECT * from user where username='".$_SESSION['username']."'";
              $result = mysqli_query($mysqli, $sql);
              $data = mysqli_fetch_array($result);
            ?>
           <table class="table">
            <tr><td>Nama </td><td>: <?php echo $data['nama_lengkap']?></td></tr>
            <tr><td>Email</td><td>: <?php echo $data['email']?></td></tr>
            <tr><td>Foto</td><td>: <img class="rounded-circle img-thumbnail" src="<?php if($data['foto']=='') echo "asset/brand/user.svg"; else echo "images/".$data['foto']; ?>" alt="" width="20%"><br>
            </td></tr>
            <tr><td>Aksi</td><td>
             <button class="btn btn-primary" onclick="GantiFoto()">Ganti Foto</button>
             <button class="btn btn-success" onclick="GantiPassword()">Ganti Password</button></td></tr>
           </table>
            <div class="card" id="Foto" style="display:none">            
              <div class="card-body text-success">
                  <form method="post" action="app.php?menu=profil" enctype="multipart/form-data" class="form-inline">
                    <div class="form-group">
                      <label for="exampleFormControlFile1">Pilih Foto</label>
                      <input type="hidden" class="form-control-file" name="username" value="<?php echo $data['username'] ?>">
                      <input type="file" class="form-control-file" name="file_image">
                    </div>
                    <button class="btn btn-primary" type="submit" name="upload" >Upload Foto</button>
                  </form>
              </div>
            </div>
            <div class="card" id="GantiPassword" style="display:none">            
              <div class="card-body text-success">
                  <form method="post" action="app.php?menu=profil" enctype="multipart/form-data" class="form-inline">
                    <div class="form-group">
                      <label for="password">Password Baru</label>
                      <input type="hidden" class="form-
                      
                      control" name="username" value="<?php echo $data['username'] ?>">
                      <input type="password" class="form-control" name="password">
                    </div>
                    <button class="btn btn-primary" type="submit" name="ganti_password" >Simpan</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }?>
  </main>

  <script src="asset/js/bootstrap.bundle.min.js"></script>
  <script src="asset/js/offcanvas.js"></script>
  <script>
    
    let textArea = document.getElementById("ringkasan");
    let characterCounter = document.getElementById("char_count");
    const maxNumOfChars = 250;
    const countCharacters = () => {
      let numOfEnteredChars = textArea.value.length+1;
      let counter = maxNumOfChars - numOfEnteredChars;
      characterCounter.textContent = counter + "/250";
        if (counter < 0) {
          characterCounter.style.color = "red";
        } else if (counter < 200) {
          characterCounter.style.color = "orange";
        } else {
          characterCounter.style.color = "black";
        }
    };
    textArea.addEventListener("input", countCharacters);
    

    function Hapus(id) {
      let text;
      if (confirm("Yakin akan menghapus artikel ini?") == true) {
        text = "You pressed OK!";
        window.location.href = "hapus.php?id=" + id;
      } else {
        text = "You canceled!";
      }
    }
    function Like(id) {
      window.location.href = "like.php?id=" + id;
    }
    function ShowDetail(id) {
      window.location.href = "app.php?menu=detail&id=" + id;
    }
    function GantiFoto(id) {
     divFoto=document.getElementById('Foto');
     divFoto.style.display="block"
     divFoto=document.getElementById('GantiPassword');
     divFoto.style.display="none"
    }
    function GantiPassword() {
    divFoto=document.getElementById('Foto');
     divFoto.style.display="none"
     divFoto=document.getElementById('GantiPassword');
     divFoto.style.display="block"
    }
    function HapusKomentar(id,idartikel){
      //alert(id+idartikel)
      let text;
      if (confirm("Yakin akan menghapus artikel ini?") == true) {
        text = "You pressed OK!";
        window.location.href = "hapuskomentar.php?id=" + id+"&idartikel="+idartikel;
      } else {
        text = "You canceled!";
      }
    }
    function showComment(id){
      var x="showComment"+id
      var divcomment = document.getElementById(x);
      if (divcomment.style.display === "none") {
        divcomment.style.display = "block";
      } else {
        divcomment.style.display = "none";
      }
    }
    function simpanComment(id){
      var x="comment"+id
      var comment= document.getElementById(x);
      //alert(comment.value)
      window.location.href = "comment.php?id=" + id+"&isi="+comment.value;
    } 
  </script>
</body>

</html>
<?php

if (isset($_POST['submit'])) {
  if (
    $_POST['kategori'] == "" || $_SESSION['username'] == "" || $_POST['isi'] == ""
    || $_POST['ringkasan'] == ''
  ) {
    echo "<script>alert('semua isian harus terisi');window.history.back()-1</script>";
  } else {
    $sql = "INSERT INTO artikel (kategori,username,isi,ringkasan,created_at)
    values ('" . mysqli_real_escape_string($mysqli,$_POST['kategori']) . "',
           '" . mysqli_real_escape_string($mysqli,$_SESSION['username']) . "',
           '" . mysqli_real_escape_string($mysqli,$_POST['isi']) . "',
           '" . mysqli_real_escape_string($mysqli,$_POST['ringkasan']) . "',
           '" . date('Y-m-d H:i:s') . "')";

    $result = mysqli_query($mysqli, $sql);
    if ($result) {
      $pesan = "Berhasil tambah artikel";
      echo "<script>alert('" . $pesan . "')
       window.location.href = 'index.php';</script>";
    } else {
      $pesan = mysqli_error($mysqli);
      echo "<script>alert('" . $pesan . "');</script>";
    }
  }
}
if(isset($_POST["ganti_password"])){
  $sql = "UPDATE user set password='".md5(mysqli_real_escape_string($mysqli,$_POST['password']))."'
          WHERE username = '".mysqli_real_escape_string($mysqli,$_POST['username']) ."'";

    $result = mysqli_query($mysqli, $sql);
    if ($result) {
      $pesan = "Berhasil update password. Silahkan Login ulang";
      echo "<script>alert('" . $pesan . "')
       window.location.href = 'logout.php';</script>";
    } else {
      $pesan = mysqli_error($mysqli);
      echo "<script>alert('" . $pesan . "');</script>";
    }
}
if(isset($_POST["upload"])){
	if($_FILES["file_image"]["name"] !=''){
		$allowed_ext = array("jpg", "png"); // extension file yang di ijinkan
		$ext = end(explode('.', $_FILES["file_image"]["name"])); // upload file ext
		if(in_array($ext, $allowed_ext)){
			if($_FILES["file_image"]["size"]<2000000){
			$name = md5(rand()) . '.' . $ext; // rename nama file gambar
			$path = "images/". $name; // image upload path
			move_uploaded_file($_FILES["file_image"]["tmp_name"], $path);
      $username=$_POST['username'];
      $sql = "UPDATE user set foto='".$name."' WHERE username='$username' ";
      $result = mysqli_query($mysqli, $sql);
      //echo $sql;
      if($result)echo "<script> window.location.href='index.php?menu=profil'</script>";
      //else die;
			//header("location:art.php?file-name=".$name.""); // nama file yang baru lihat pada url
			}else{
				echo '<script>alert("Ukuran Gambar Terlalu Besar")</script>';
			}
		
		}else{
			echo '<script>alert("Tidak Sesuai Image File")</script>';
		}
	}else{
		echo '<script>alert("Silahkan pilih file gambar")</script>';
	}
}
 
?>
