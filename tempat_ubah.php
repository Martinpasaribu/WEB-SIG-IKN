

<?php
 $row = $db->get_row("SELECT * FROM tb_tempat WHERE id_tempat='$_GET[ID]'"); 
session_start();
ob_start();

include 'config.php'; 

if(!isset($_SESSION['session_username'])){
    header("location:index.php?m=login");
    exit();
    
}
?>
<div class="page-header">
    <h1>Ubah Data Tanaman</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include 'aksi.php'?>
        <form method="post" action="?m=tempat_ubah&ID=<?=$row->id_tempat?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Tempat <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_tempat" value="<?=$row->nama_tempat?>" required>
            </div>
            <div class="form-group">
                <label>Gambar <span class="text-danger">*</span></label>
                <input class="form-control" type="file" name="gambar" />
                <p class="help-block">Kosongkan jika tidak mengubah gambar</p>
                <img class="thumbnail" src="assets/images/tempat/small_<?=$row->gambar?>" height="60" />
            </div>
            <div class="form-group">
                <label>Latitude <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="lat" name="lat" value="<?=$row->lat?>"  required>
            </div>
            <div class="form-group">
                <label>Longitude <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="lng" name="lng" value="<?=$row->lng?>"  required>
            </div>
            <div class="form-group">
                <label>Lokasi <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="lokasi" value="<?=$row->lokasi?>"  required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="mce" name="keterangan" ><?=$row->keterangan?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=tempat"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>  
        </form>
    </div>
    <div class="col-md-6">
        <div id="map" style="height: 400px;"></div>
    </div>
</div>
<script>
var defaultCenter = {
    lat : -5.368473425089913, 
    lng :  105.31152589806345
};
function initMap() {

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16.5,
    center: defaultCenter 
  });

  var marker = new google.maps.Marker({
    position: defaultCenter,
    map: map,
    title: 'Click to zoom',
    draggable:true
  });
  
  
    marker.addListener('drag', handleEvent);
    marker.addListener('dragend', handleEvent);
    
    var infowindow = new google.maps.InfoWindow({
        content: '<h4>Drag untuk pindah lokasi</h4>'
    });
    
    infowindow.open(map, marker);
}

function handleEvent(event) {
    document.getElementById('lat').value = event.latLng.lat();
    document.getElementById('lng').value = event.latLng.lng();
}

$(function(){
    initMap();
})
</script>