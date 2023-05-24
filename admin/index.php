
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Adminstrartor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <?php
        include '../config.php';
        $ambil_kategori = mysqli_query ($conn,"select * from profil limit 1");
        $row = mysqli_fetch_assoc($ambil_kategori); 
        $nama_website = $row['nama_website'];
        $copy_right = $row['nama_website'];
    ?>
    <a class="navbar-brand" href="../admin.php"><?php echo $nama_website; ?> </a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
   
</nav>
<div class="jumbotron text-center">
<?php 
if(isset($_GET['halaman']) && !isset($_GET['kategori'])){
    $halaman = $_GET['halaman'];
   echo "<h1>".ucwords($halaman)."</h1>";
}

if(isset($_GET['halaman']) &&  isset($_GET['kategori'])){

    include '../config.php';
    $ambil_kategori = mysqli_query ($conn,"select * from kategori where id_kategori='".$_GET['kategori']."' limit 1");
    $row = mysqli_fetch_assoc($ambil_kategori); 
    $kategori = $row['nama_kategori'];
    $halaman = $_GET['halaman'];
   echo "<h1>".ucwords($halaman)." ".ucwords($kategori)."</h1>";
}
?>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <div class="list-group">
                <a href="index.php?halaman=kategori" class="list-group-item list-group-item-action">Artikel</a>
                <a href="index.php?halaman=komentar" class="list-group-item list-group-item-action">Komentar</a>
  
            </div>
        </div> 
        <div class="col-sm-10">
        <?php 
            if(isset($_GET['halaman'])){
                $halaman = $_GET['halaman'];
                switch ($halaman) {
                    case 'kategori':
                        include "artikel/kategori.php";
                        break;
                    case 'artikel':
                        include "artikel/index.php";
                        break;
                    case 'komentar':
                        include "../komentar/index.php";
                        break;
                    case 'admin':
                        include "admin/index.php";
                        break;
                    case 'profil':
                        include "profil/index.php";
                        break;
                    default:
                    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                    break;
                }
            }else {
                include "index.php";
            }
        ?>
        </div>
    </div>
    <br>
</div>
<div class="jumbotron text-center" style="margin-bottom:0">
    <p>Copyright <?php echo  $copy_right; ?> 2020</p>
</div>
</body>
</html>
