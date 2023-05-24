<div class="page-header">
    <h1><b>Sistem Informasi Geografis (IKN Nusantara)</b></h1>
</div>
<h3 align="justify"> Berita Terkini <b>IKN Nusantara</b>, Silahkan Melihat Berita Yang Tersedia</h3>
<br>
<br>
<div class="row">
<?php
         
    include 'config.php';
    if (isset($_GET['kategori'])) {
        $sql="select * from artikel where status=1 and id_kategori=".$_GET['kategori']." order by id_artikel desc";
    }else {
        $sql="select * from artikel where status=1 order by id_artikel desc";
    }

    
    $hasil=mysqli_query($conn,$sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah>0){
        while ($data = mysqli_fetch_array($hasil)):
    ?>
        <div class="col-sm-3">
            <div class="thumbnail">
                <a href="index.php?halaman=artikel&id=<?php echo $data['id_artikel'];?>"><img src="admin/artikel/gambar/<?php echo $data['gambar'];?>"  height="200px" width="200px" alt="Cinque Terre"></a>
                <div class="caption">
                    <h3><?php echo $data['judul_artikel'];?></h3>
                    <p>
                    <?php 
                    $ambil=$data["isi_artikel"];
                    $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                    echo substr($panjang, 0, 200);?>
                    </p>
                    <p><a href="artikel.php?halaman=artikel&id=<?php echo $data['id_artikel'];?>" class="btn btn-light btn-block" role="button">Selengkapnya</a></p>
                </div>
            </div>
        </div>
        <?php 
        endwhile;
    }else {
        echo "<div class='alert alert-warning'> Tidak ada artikel pada kategori ini.</div>";
    };
     ?>
</div>