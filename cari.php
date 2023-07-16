<div class="page-header">
    <h1> Tanaman Di Kebun Raya ITERA</h1>
</div>


<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="cari" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />            
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>            

            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="nw">
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Tempat</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $pg = new Paging();        
        $limit = 5;
        $offset = $pg->get_offset($limit, $_GET['page']);
        $sql = "SELECT * 
            FROM tb_tempat p
            WHERE nama_tempat LIKE '%$q%' 
            ORDER BY id_tempat LIMIT $offset, $limit";
        $rows = $db->get_results($sql);
        $no = $offset;

        $jumrec = $db->get_var("SELECT COUNT(*) 
        FROM tb_tempat g INNER JOIN tb_tempat t ON t.id_tempat=g.id_tempat 
        ");

        foreach($rows as $row):?>
        <tr>
            <td><?=++$no?></td>
            <td><img class="thumbnail" height="60" src="assets/images/tempat/small_<?=$row->gambar?>" /></td>
            <td><?=$row->nama_tempat?></td>
            <td><?=$row->lat?></td>
            <td><?=$row->lng?></td>
            <td><?=$row->lokasi?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=cari&ID=<?=$row->id_tempat?>"><span class="glyphicon glyphicon-edit"></span></a>
                
                <script>
                    f
                    //    <? $row = $db->get_row("SELECT * FROM tb_tempat WHERE id_tempat='$_GET[ID]'"); ?>

                        var data =  <?=json_encode($db->get_results("SELECT * FROM tb_tempat"))?>;
                        $.each(data, function(k, v){
            
                            var contentString = '<h3>'  + v.nama_tempat + '</h3>' +'<img src="' + v.gambar + '" hight:20px; >' +
                                '<p align="center"><a href="?m=tempat_detail&ID=' + v.id_tempat + '" class="link_detail btn btn-primary">Lihat Detail</a>';
                        
                        });    
                    
                </script>
                
                <a class="btn btn-xs btn-success" href="index.php?m=tempat_detail&ID=<?=$row->id_tempat?>" onclick="return confirm('Lihat detail data?')"><span class="glyphicon glyphicon-file"></span></a>
            </td>
        </tr>
        <?php endforeach;    ?>
        </table>
    </div>

    <div class="panel-footer">
        <ul class="pagination"><?=$pg->show("m=cari&q=$_GET[q]&page=", $jumrec, $limit, $_GET['page'])?></ul>
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
        
        var data =  <?=json_encode($db->get_results("SELECT * FROM tb_tempat WHERE id_tempat='$_GET[ID]'"))?>;
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