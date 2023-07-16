<div class="page-header">
    <h1><b></b></h1>
</div>
<h3 > Berita Terkini <b>Kebun Raya ITERA</b>, Silahkan melihat berita yang tersedia</h3>
<br>
<br>
<div class="buat">
<div class="row">


<?php
         
    include 'config.php';
    // include 'functions.php';    
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
        <div class="col-sm-14" style="background-color: #002b36;border: 12px solid #000000;border-radius: 20px;">
            <div class="thumbnail" >
                <a href="index.php?halaman=artikel&id=<?php echo $data['id_artikel'];?>"><img src="admin/artikel/gambar/<?php echo $data['gambar'];?>"  height="700px" width="1900px" alt="Cinque Terre"></a>
                <div class="caption">
                    <h3 style="color:aqua"><?php echo $data['judul_artikel'];?></h3>
                    <p style="color:aliceblue; text-align:justify">
                    <?php 
                    $ambil=$data["isi_artikel"];
                    $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                    echo substr($panjang, 0, 200);?>
                    </p>
                    <p><a href="artikel.php?m=artikel&id=<?php echo $data['id_artikel'];?>" class="btn btn-light btn-block" role="button">Selengkapnya</a></p>
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
</div>