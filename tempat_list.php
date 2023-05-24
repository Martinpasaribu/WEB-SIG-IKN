<div class="page-header">
</br>
</br>
    <h1 align="center">Peta Sebaran TItik Pusat Kawasan Penting IKN </h1>

    <br>
    <br>

   <h3 algin="justify" >  Bebarapa Titik Kawasan Daerah Penting IKN Nusantara  </h3>

 
   </br>
<h4 algin="justify">
Cakupan wilayah Ibu Kota Negara terdiri dari wilayah darat dan laut. <b> Wilayah darat memiliki luas kurang lebih 256.142 hektar area (ha) </b>. Sementara  <b> wilayah perairan laut seluas kurang lebih 68.189 hektar (ha) </b>.
</br>
</br>
   <h4 algin="justify" >  Menurut Kementerian Pekerjaan Umum dan Perumahan Rakyat (PUPR), Pembagian Kawasan Inti:    </br>

</br>

BWP I (Pusat) Pusat Pemerintahan <br/>
BWP II (Barat) Pusat Ekonomi <br/>
BWP III (Selatan) Pusat Pemerintahan <br/>
BWP IV (Tenggara) Pusat Hiburan <br/>
BWP V (Timur) Pusat Pendidikan <br/>
BWP VI (Utara) Pusat Inovasi & Riset <br/><br/>

Wilayah darat IKN nantinya akan terbagi menjadi dua kawasan, yaitu kawasan IKN dengan luas kurang lebih <b> 56.180 hektar </b> yang akan menjadi <b> kawasan inti pusat IKN </b>. Sementara pembangunan <b>kawasan pengembangan </b> seluas kurang lebih <b> 199.962 hektar </b>.
<h4>
   </br>
   </br>

</div>
<div id="map" style="height: 700px;"></div>
<script>
function tampilDekat(){
    getCurLocation();
    
    map_dekat = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: {
            lat : -0.806431405612434, 
            lng :  116.81427609673601
        }
    });
       
    var data =  <?=json_encode($db->get_results("SELECT * FROM tb_tempat"))?>;
    $.each(data, function(k, v){
        var pos = {
            lat : parseFloat(v.lat),
            lng : parseFloat(v.lng)
        };
        var contentString = '<h3>'  + v.nama_tempat + '</h3>' + 
            '<p align="center"><a href="?m=tempat_detail&ID=' + v.id_tempat + '" class="link_detail btn btn-primary">Lihat Detail</a>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        var marker = new google.maps.Marker({
            position: pos,
            map: map_dekat,
            animation: google.maps.Animation.DROP
        });         
        marker.addListener('click', function() {
            infowindow.open(map_dekat, marker);
        });
    });    
}  

$(function(){
    tampilDekat();
})
</script>