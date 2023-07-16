

<link href="assets/css/solar-bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <!-- <link href="assets/css/style.css" rel="stylesheet"/> -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>  
    <script src="assets/tinymce/tinymce.min.js"></script> 
    <link href="assets/css/style.css" rel="stylesheet"/>



  

<header class="header" >
  <h1>  Berita  (Kebun Raya ITERA)</h1>

  <h3  style="text-align:center"> Disini Kami Menyajikan Informasi Mengenai  Kebun Raya ITERA</h3>
</header>
<div class="news">

<?php
include 'functions.php';

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
<div class="row">
    <div class="col-sm-8">
        <div class="thumbnail" style="background-color: #002b36;border: 12px solid #000000;border-radius: 24px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?m=news2">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data["nama_kategori"];?></a></li>
                    <li style="color:aqua;" class="breadcrumb-item active" aria-current="page"><?php echo $data["judul_artikel"];?></li>
                </ol>
            </nav>
            <img src="admin/artikel/gambar/<?php echo $data['gambar'];?>" width="100%" alt="Cinque Terre">
            <br>
            <div class="caption">
            <h4  > <span class="glyphicon glyphicon-calendar"></span> &nbsp Tanggal dipublish : <?php echo $data['tanggal']?></h4>
                <h4 style="color:aliceblue; text-align:justify">
                <?php
                echo strip_tags(html_entity_decode($data["isi_artikel"],ENT_QUOTES,"ISO-8859-1"));
                 ?>
                
                </h4>
            </div>
            <?php
                  if (isset($_GET['komentar'])) {
                    //Mengecek nilai variabel add yang telah di enskripsi dengan method md5()
                    if ($_GET['komentar']=='berhasil'){
                        echo"<div class='alert alert-success'>Komentar terposting</div>";
                    }else {
                        echo"<div class='alert alert-danger'>Komentar gagal</div>";
                    }   
                }
            ?>
            <div class="row" >
                <h3 style="text-align: center"> Komentar Terkini </h3>
                <?php
                    include 'config.php';
                    $sql="select * from komentar where id_artikel=$id_artikel and status_komentar=0 order by id_komentar desc";
                    $hasil=mysqli_query($conn,$sql);
                    while ($komentar = mysqli_fetch_array($hasil)):
                ?>
                <div class="col-sm-12">
                    <div class="caption">
                        <h5 style="color:forestgreen"><?php echo $komentar['nama'];?></h5>
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
    <div class="col-sm-4" style="background-color: #002b36;border: 12px solid #000000;border-radius: 20px;">
        <div class="row">
            <?php
                include 'config.php';
                $sql="select * from artikel where status=1 order by id_artikel desc";
                $hasil=mysqli_query($conn,$sql);
                while ($data = mysqli_fetch_array($hasil)):
            ?>
            <div class="col-sm-12" style="margin-top:20px">
                <div class="caption">
                    <h5 ><a style="color:aqua"class="text-dark" href="artikel.php?halaman=artikel&id=<?php echo $data['id_artikel'];?>"><?php echo $data['judul_artikel'];?></a></h5>
                    <div class="row">
                        <div class="col-xl-3">
                            <img src="admin/artikel/gambar/<?php echo $data['gambar'];?>" width="100%" alt="Cinque Terre">
                        </div>
                </br>
                        <div class="col-sm-9">
                            <p style="color:aliceblue; text-align:justify">
                            <?php
                                $ambil=$data["isi_artikel"];
                                $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                            
                                echo substr($panjang, 0, 80);
                            ?>
                            </p>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="row">
            <div class="col-sm-12" >
                <!-- <img src="admin/artikel/gambar/iklan.png" width="100%"alt="Cinque Terre"> -->
            </div>
        </div>
    </div>  
</div>
</div>
