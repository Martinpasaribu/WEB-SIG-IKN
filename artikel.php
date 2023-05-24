<?php

include 'functions.php';
// if(empty($_SESSION['user']))
//     header("location:index.php");
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="stylesheet" href="css/leaflet.css"><link rel="stylesheet" href="css/L.Control.Locate.min.css">
        <link rel="stylesheet" href="css/qgis2web.css"><link rel="stylesheet" href="css/fontawesome-all.min.css">
        <link rel="stylesheet" href="css/MarkerCluster.css">
        <link rel="stylesheet" href="css/MarkerCluster.Default.css">
        <link rel="stylesheet" href="css/leaflet-search.css">
        <link rel="stylesheet" href="css/filter.css">
<link rel="stylesheet" href="css/nouislider.min.css">
        <link rel="stylesheet" href="css/leaflet-control-geocoder.Geocoder.css">
        <link rel="stylesheet" href="css/leaflet-measure.css">
        <style>
        #map {
            width: 1177px;
            height: 856px;
        }
        </style>
        <title></title>

         <link href="../assets/css/solar-bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/css/general.css" rel="stylesheet"/>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>  
    <script src="../assets/tinymce/tinymce.min.js"></script> 
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
    </head>
<nav class="navbar navbar-default navbar-static-top" style="  background: #16222A;background: -webkit-linear-gradient(59deg, #6f887b, #16222A); background: linear-gradient(59deg, #6f887b, #6f887b, #16222A); ">
       <header class="header bg-primary>
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>  
        </button>
       
        <a class="navbar-brand" href="index.php" style=" font-size: 39px; padding: 37px 53px 17px 296px;height: 95px;"   >Sistem Informasi Geografis <br/>  <br/> IKN Nusantara</a>
        <img src="../IKN.png" style="width:99px;height:96px;border-radius: 66px; margin: 21px 6px  0px -624px">  
        </div> 	
      <div id="navbar" class="navbar-collapse collapse" style="padding: 45px  2px 33px 0px ;">
        <ul class="nav navbar-nav" style="padding-left: 1110px">
    
          <li><a style="background-color: #fff;color:black;border-radius: 10px;padding: 9px 30px 9px 17px;margin: 5px 83px 5px 140px" href="../index.php"><span class="glyphicon glyphicon-home"></span><b> Kembali </b></a></li>
                
        </ul>          
      </div>
    </div>
  </nav>

  <div class="page-header">
<br/><br/>
    <h1 align="center"> <b> Berita  (IKN Nusantara)</b></h1>
</div>
<h3 align="justify" style="margin:2px 2px 2px 127px"> Disini Kami Menyajikan Informasi Mengenai  <b>IKN Nusantara</b></h3>

<br/>
<br>
<br>
<?php
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    include 'config.php';
    $id_artikel=input($_GET['id']);
    $query = mysqli_query ($conn,"select * from artikel a inner join kategori k on k.id_kategori=a.id_kategori where id_artikel='".$id_artikel."' limit 1");
    $data = mysqli_fetch_assoc($query); 
?>
<div class="row"  style="    padding: 36px 426px 15px 100px;">
    <div class="col-sm-8">
        <div class="thumbnail">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data["nama_kategori"];?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $data["judul_artikel"];?></li>
                </ol>
            </nav>
            <img src="admin/artikel/gambar/<?php echo $data['gambar'];?>" width="100%" alt="Cinque Terre">
            <div class="caption">
                <?php
                echo strip_tags(html_entity_decode($data["isi_artikel"],ENT_QUOTES,"ISO-8859-1"));
                 ?>
                <hr>
            </div>
            <?php
                  if (isset($_GET['komentar'])) {
                    //Mengecek nilai variabel add yang telah di enskripsi dengan method md5()
                    if ($_GET['komentar']=='berhasil'){
                        echo"<div class='alert alert-success'>Komentar telah terkirim, menunggu persetujuan dari admin</div>";
                    }else {
                        echo"<div class='alert alert-danger'>Komentar gagal</div>";
                    }   
                }
            ?>
            <div class="row" >
                <h3 style="text-align: center"> Komentar Terkini </h3>
                <?php
                    include 'config.php';
                    $sql="select * from komentar where id_artikel=$id_artikel and status_komentar=1 order by id_komentar desc";
                    $hasil=mysqli_query($conn,$sql);
                    while ($komentar = mysqli_fetch_array($hasil)):
                ?>
                <div class="col-sm-12">
                    <div class="caption">
                        <h5><?php echo $komentar['nama'];?></h5>
                        <div class="row">
                            <div class="col-sm-1">
                                <img src="admin/artikel/gambar/admin.png" width="100%" alt="Cinque Terre">
                            </div>
                            <div class="col-sm-11">
                                <?php echo $komentar['isi_komentar']; ?>
                            </div> 
                        </div>
                        <br><br>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

            <div class="comment">
                <form method="post" action="simpan-komentar.php">
                    <label><h2>Tinggalkan Komentar</h2></label>
                    <div class="form-group">
                        <input type="hidden" name="id_artikel" value="<?php echo $data['id_artikel'];?>" class="form-control">
                        <input type="hidden" name="status" value="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Komentar:</label>
                        <textarea class="form-control" name="komentar" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit"  name="form_komentar" class="btn btn-info" value="Kirim Komentar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="row">
            <?php
                include 'config.php';
                $sql="select * from artikel where status=1 order by id_artikel desc";
                $hasil=mysqli_query($conn,$sql);
                while ($data = mysqli_fetch_array($hasil)):
            ?>
            <div class="col-sm-12">
                <div class="caption">
                    <h5><a class="text-dark" href="index.php?halaman=artikel&id=<?php echo $data['id_artikel'];?>"><?php echo $data['judul_artikel'];?></a></h5>
                    <div class="row">
                        <div class="col-xl-3">
                            <img src="admin/artikel/gambar/<?php echo $data['gambar'];?>" width="100%" alt="Cinque Terre">
                        </div>
                        <div class="col-sm-9">
                            <?php
                                $ambil=$data["isi_artikel"];
                                $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                            
                                echo substr($panjang, 0, 80);
                            ?>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <img src="admin/artikel/gambar/iklan.png" width="100%"alt="Cinque Terre">
            </div>
        </div>
    </div>  
</div>

 <footer class="footer bg-primary"  style="  background: #16222A;background: -webkit-linear-gradient(59deg, #6f887b, #16222A); background: linear-gradient(59deg, #6f887b, #6f887b, #16222A);     margin: 45px 23px -430px 1px;   height: 260px;">
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
</html>