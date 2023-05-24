<?php

include 'functions.php';
// if(empty($_SESSION['user']))
//     header("location:index.php");
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>    
    <meta name="description" content="Source Code Sistem Informasi Geografis / Geographic Information System (GIS) berbasis web dengan PHP dan MySQL. Studi kasus: Lokasi Barbershop di Lubuklinggau."/>
    <meta name="keywords" content="Sistem, Informasi, geografis, gis, Tugas, Source Code, PHP, MySQL, CSS, JavaScript, Bootstrap, jQuery"/>
    <meta name="author" content="sarjanakomedi.com"/>
    <link rel="icon" href="favicon.ico"/>
    <link rel="canonical" href="https://sarjanakomedi.com/" />

    <title>Berita Terbaru </title>
    <link href="assets/css/solar-bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>  
    <script src="assets/tinymce/tinymce.min.js"></script> 
    <script>
        tinymce.init({
        selector: "textarea.mce",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            menubar : false,
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXD8UintJ5MRGgperWdwiFhFKPjvZ7FD8"></script>
    <script>
        var default_lat = <?=get_option('default_lat')?>; 
        var default_lng = <?=get_option('default_lng')?>;
        var default_zoom = <?=get_option('default_zoom')?>;
    </script>
    <script src="assets/js/script.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top">
      <header class="header bg-primary>
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">s</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?">Berita IKN</a>
        </div> 	
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php if($_SESSION['login']):?>
            <li><a href="?m=tempat"><span class="glyphicon glyphicon-home"></span><b> Tempat</b></a></li>
            <li><a href="?m=galeri"><span class="glyphicon glyphicon-picture"></span><b> Galeri</b></a></li>            
            <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span><b> Password</b></a></li>
            <li><a href="?m=au"><span class="glyphicon glyphicon-news"></span><b> Berita</b></a></li>
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span><b> Logout</b></a></li>
            <?php else:?>            
            <li><a href="?m=tempat_list"><span class="glyphicon glyphicon-map-marker"></span><b> Peta Persebaran</b></a></li>
            <li><a href="?m=login"><span class="glyphicon glyphicon-user"></span> Login</a></li>
            <?php endif?>                   
          </ul>          
        </div>
      </div>
    </nav>


    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <?php
        include 'config.php';
        $ambil_kategori = mysqli_query ($conn,"select * from profil limit 1");
        $row = mysqli_fetch_assoc($ambil_kategori); 
        $nama_website = $row['nama_website'];
        $copy_right = $row['nama_website'];
    ?>
    <a class="navbar-brand" href="index.php?halaman=home"><?php echo $nama_website;?></a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
        <?php
         
            include 'config.php';
            $sql="select * from kategori";
            $hasil=mysqli_query($conn,$sql);
            while ($data = mysqli_fetch_array($hasil)):
        ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori'];?></a>
            </li>
            <?php endwhile; ?>
        </ul>
       
    </div>
   
</nav>
<div class="jumbotron text-center">

<?php
    $judul="Selamat Datang";   
    include 'config.php';
    if (isset($_GET['id'])) {
        $sql="select * from artikel where status=1 and id_artikel=".$_GET['id']."";
        $hasil=mysqli_query($conn,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['judul_artikel'];  
    }else if (isset($_GET['kategori'])){
        $sql="select * from kategori where id_kategori=".$_GET['kategori']."";
        $hasil=mysqli_query($conn,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['nama_kategori'];  
    }

    

?>
    <h1><?php echo $judul;?></h1>

</div>

<div class="container">
<?php 
    if(isset($_GET['halaman'])){
        $halaman = $_GET['halaman'];
        switch ($halaman) {
            case 'home':
                include "home.php";
                break;
            case 'artikel':
                include "artikel.php";
                break;
            case 'login':
                include "login.php";
                break;
            default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
    }else {
        include "home.php";
    }
?>
</div>
    <a class="navbar-brand" href="index.php?halaman=news2"></a>
    
    <footer class="footer bg-primary"  style="  background: #16222A;background: -webkit-linear-gradient(59deg, #6f887b, #16222A); background: linear-gradient(59deg, #6f887b, #6f887b, #16222A);     margin: 45px 23px -158px 1px;   height: 240px;">
		<div class="footer-middle">
		<div class="container" style="color:#fff">
		  <div class="row">
			<div class="col-md-3 col-sm-6">
			  <!--Column1-->
			  <div class="footer-pad">
				<h4>Helpdesk</h4>
				<ul class="list-unstyled"  >
				  <li ><a href="#"></a></li>
				  <li ><a href="#" style="color:#fff" >Payment Center</a></li>
				  <li><a href="#" style="color:#fff">Contact Directory</a></li>
				  <li><a href="#" style="color:#fff">Forms</a></li>
				  <li><a href="#" style="color:#fff">News and Updates</a></li>
				  <li><a href="#" style="color:#fff">FAQs</a></li>
				</ul>
			  </div>
			</div>
			<div class="col-md-3 col-sm-6">
			  <!--Column1-->
			  <div class="footer-pad">
				<h4>Beranda</h4>
				<ul class="list-unstyled">
				  <li><a href="#" style="color:#fff" >Sekilas IKN</a></li>
				  <li><a href="#" style="color:#fff">Struktur Organisasi</a></li>
				  <li><a href="#" style="color:#fff">Kontak Kami</a></li>
				  <li><a href="#" style="color:#fff">Karier</a></li>
				  <li><a href="#" style="color:#fff">Gallery</a></li>
				</ul>
			  </div>
			</div>
			<div class="col-md-3 col-sm-6">
			  <!--Column1-->
			  <div class="footer-pad">
				<h4>Tentang</h4>
				<ul class="list-unstyled">
				  <li><a href="#" style="color:#fff">Beranda</a></li>
				  <li><a href="#" style="color:#fff">Tentang IKN NUSANTARA</a></li>
				  <li><a href="#" style="color:#fff">Peta Sebaran</a></li>
				  <li><a href="#" style="color:#fff">Peta Kawasan</a></li>
				  <li><a href="#" style="color:#fff">Mayor and City Council</a></li>
				  <li>
					<a href="#"></a>
				  </li>
				</ul>
			  </div>
			</div>
			<div class="col-md-3">
			  <h4>Kontak Kami</h4>
				  <ul class="social-network social-circle">
				   <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
				   <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
				   <li><a href="#" class="icoInstagram" title="Instagram"><i class="fa fa-instagram"></i></a></li>
				   <li><a href="#" class="icoYoutube" title="Youtube"><i class="fa fa-youtube"></i></a></li>
				</ul>       
		  </div>
		  </div>
		<div class="row">
		  <div class="col-md-12 copy">
			<p class="text-center">&copy; Copyright 2023 - IKN NUSANTARA.  All rights reserved.</p>
		  </div>
		</div>
	
		</div>
		</div>
	  </footer>
</body>
</html>
