<?php

session_start();
ob_start();
include 'functions.php';
include 'config.php'; 

if(!isset($_SESSION['session_username'])){
    header("location:index.php?m=login");
    exit();
    
}
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

    <title>Sistem Informasi Geografis Kebun Raya ITERA</title>
    <link href="assets/css/solar-bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <!-- <link href="assets/css/style.css" rel="stylesheet"/> -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>  
    <script src="assets/tinymce/tinymce.min.js"></script> 
    <link href="assets/css/style.css" rel="stylesheet"/>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5s8H1Xoj_p0pvENCFFZPUKLp3p8agntY"></script>
    <script>
        var default_lat = <?=get_option('default_lat')?>; 
        var default_lng = <?=get_option('default_lng')?>;
        var default_zoom = <?=get_option('default_zoom')?>;
    </script>
    <script src="assets/js/script.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top" style="  background: #16222A;background: -webkit-linear-gradient(59deg, #6f887b, #16222A); background: linear-gradient(59deg, #6f887b, #6f887b, #16222A); ">
     
    



  
      <div class="container" >
        <header class="header">

        <div class="grid-container">

  
  <div class="item2"></div>
  <div class="item3">Sistem Informasi Geografis Kebun Raya ITERA </div>  
  <div class="item4"> </div>
  <div class="item5">
  <div id="navbar" class="navbar-collapse collapse" >
    
  <div class="nav1">
          <ul class="nav navbar-nav">
            
            <?php if($_SESSION['session_username']):?>
              <div class="dropdown">
  <button class="dropbtn">Tempat</button>
  <div class="dropdown-content">
            <li><a href="?m=tempat"><span class="glyphicon glyphicon-home"></span><b> Tempat</b></a></li>
            <li><a href="?m=fasilitas"><span class="glyphicon glyphicon-home"></span><b> Fasilitas</b></a></li>
  </div>
  </div>

            <li><a href="?m=galeri"><span class="glyphicon glyphicon-picture"></span><b> Galeri</b></a></li>            
            <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span><b> Password</b></a></li>
            <li><a href="au.php"><span class="glyphicon glyphicon-list-alt"></span><b> Berita</b></a></li>
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span><b> Logout</b></a></li>
            <?php else:?>     



            
            
            <?php endif ?>                   
          </ul>          
          </div>
        </div>
  </div>
  </div> 
      <div class="tombolku">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      </div>
    </header>
    </div>
    </nav>


    <div class="container" style='padding-top: 122px;'>
    <div class="adm">
    <?php
        if(file_exists($mod.'.php'))
            include $mod.'.php';
        else
            include 'admin2.php';
            
    ?>
    </div>
    </div>

</body>
  <footer>
<div class="foot">
			  <!--Column1-->
			  <div class="bawah1">
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
			  <!--Column1-->
			  <div class="bawah2">
				<h4>Beranda</h4>
				<ul class="list-unstyled">
				  <li><a href="#" style="color:#fff" >Sekilas IKN</a></li>
				  <li><a href="#" style="color:#fff">Struktur Organisasi</a></li>
				  <li><a href="#" style="color:#fff">Kontak Kami</a></li>
				  <li><a href="#" style="color:#fff">Karier</a></li>
				  <li><a href="#" style="color:#fff">Gallery</a></li>
				</ul>
			  </div>
			
	
			  <!--Column1-->
			  <div class="bawah3">
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
		
			<div class="bawah4">
			  <h4>Kontak Kami</h4>
				  <ul class="social-network social-circle">
				   <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
				   <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
				   <li><a href="#" class="icoInstagram" title="Instagram"><i class="fa fa-instagram"></i></a></li>
				   <li><a href="#" class="icoYoutube" title="Youtube"><i class="fa fa-youtube"></i></a></li>
				</ul>       
		  </div>

    <div class="bawah5">
		<div class="ro">
			<p class="text-center">&copy; Copyright 2023 - IKN NUSANTARA.  All rights reserved.</p>
      <p > -----------------------------------------------------------------------------------</p>
		  
	 </div>
	
	</div>
    </footer>


    </html>
