<?php

include '../../config.php';

    $id_komentar=$_POST["id_komentar"];
        $gambar=$_POST["gambar"];

        $sql="delete from komentar where id_komentar=$id_komentar";
        $hapus_komentar=mysqli_query($conn,$sql);

    ?>