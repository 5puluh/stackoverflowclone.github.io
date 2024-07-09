<!doctype html>
<html lang="en">
<?php
include "config/koneksi.php";
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">

  <title>Aplikasi Sosial Media</title>

  <link href="asset/css/bootstrap.min.css" rel="stylesheet">
  <link href="asset/css/comment.css" rel="stylesheet">
  <link href="asset/fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="asset/fontawesome/css/brands.css" rel="stylesheet">
  <link href="asset/fontawesome/css/solid.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="asset/css/offcanvas.css" rel="stylesheet">
</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Sosial Media</a>
      <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Kategori</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown01">
              <?php
              $sql = "SELECT * from kategori";
              $result = mysqli_query($mysqli, $sql);
              while ($data = mysqli_fetch_array($result)) {
                echo "<li><a class='dropdown-item' href='?kategori=" . $data['id'] . "'>" . $data['kategori'] . "</a></li>";
              }
              ?>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?menu=tambah">Buat Artikel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?menu=profil">Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="nav-scroller bg-body shadow-sm">
    <nav class="nav nav-underline" aria-label="Secondary navigation">
      <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
      <a class="nav-link" href="index.php?menu=tambah">Buat Artikel</a>
    </nav>
  </div>

  <main class="container">
    <div class="row d-flex justify-content-center">
        
        <div class="col-md-12">
            
            <div class="card p-3 py-4">
            <?php
                $sql="SELECT * from user where username='".$_GET['username']."'";
                $result = mysqli_query($mysqli, $sql);
                $data = mysqli_fetch_array($result)
                ?>
                <div class="text-center">
                    <img src="asset/brand/user.svg" width="100" class="rounded-circle">
                </div>
                <div class="text-center mt-3">
                    <span class="bg-secondary p-1 px-4 rounded text-white"></span>
                    <h5 class="mt-2 mb-0"><?php echo $data['nama_lengkap'] ?></h5>
                    <span><?php echo $data['email'] ?></span>
                    <div class="buttons">          
                        <button class="btn btn-outline-primary px-4">Message</button>
                        <button class="btn btn-primary px-4 ms-3">Contact</button>
                    </div>               
                </div>            
            </div>         
        </div>  
    </div>  

    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <h6 class="border-bottom pb-2 mb-0">Article</h6>
      <div class="panel panel-default widget">
        <div class="panel-body">
          <ul class="list-group">
            <?php
            
            $sql = "SELECT artikel.*,
            (artikel.comment*0.7 + artikel.like *0.3) as peringkat,
            kategori.kategori as nama_kategori,
            user.nama_lengkap
            from artikel 
            left join kategori on kategori.id=artikel.kategori
            left join user on user.username=artikel.username 
            where artikel.username ='".$_GET['username']."' order by peringkat desc";
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
                            </button>              
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
            Where `user`.username='".$_GET['username']."'
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
                                  By: <a href="#">' . $data['nama_lengkap'] . '</a> on ' . date('d F Y', strtotime($data['created_at'])) . '
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
?>
