<div class="buat">
    <div class="kotak">
        <div class="page-header">

            <h1 ">Peta Sebaran TItik Fasilitas </h1>
            <h3 " >  Bebarapa Titik Fasilitas Di Kebun Raya ITERA </h3>

            <h4 >
            Kebun Raya ITERA juga sudah memiliki 11.315 tanaman penghijauan yang terdiri dari 109 jenis tanaman, serta 232 tanaman koleksi yang terdiri dari 49 famili, sumbangan Kebun Raya Bogor. Tanaman koleksi di Kebun Raya ITERA merupakan tanaman khas kebun raya, yakni tanaman yang memiliki identitas dan terdokumentasi, serta beberapa tanaman langka seperti teratai raksasa (Victoria amazonica), tanaman baobab (Adansonia digitata).</br>
            </4>   
        
            <h4 > --- </h4>

        </div>
    </div>
</div>
<div id="map" style="height: 700px;color:black"> </div>
<script>
    function tampilDekat(){
        getCurLocation();
        
        map_dekat = new google.maps.Map(document.getElementById('map'), {
            zoom: 16.5,
            center: {
                lat : -5.368473425089913, 
                lng :  105.31152589806345
            }
        });
        
        var data =  <?=json_encode($db->get_results("SELECT * FROM tb_fasilitas"))?>;
        $.each(data, function(k, v){
            var pos = {
                lat : parseFloat(v.lat),
                lng : parseFloat(v.lng)
            };
            var contentString = '<h3>'  + v.nama_fasilitas + '</h3>' + 
                '<p align="center"><a href="?m=tempat_detail_fasilitas&ID=' + v.id_fasilitas + '" class="link_detail btn btn-primary">Lihat Detail</a>';
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