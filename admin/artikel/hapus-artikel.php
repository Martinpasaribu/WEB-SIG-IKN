<?php
session_start();
    include '../../config.php';

    $id_artikel=$_POST["id_artikel"];
    $gambar=$_POST["gambar"];

    $sql="delete from artikel where id_artikel=$id_artikel";
    $hapus_artikel=mysqli_query($conn,$sql);

    //Menghapus gambar, gambar yang dihapus jika selain gambar default
    if ($gambar!='gambar_default.png'){
        unlink("gambar/".$gambar);
    }
 

?><?php
session_start();
    include '../../config.php';

    $id_artikel=$_POST["id_artikel"];
    $gambar=$_POST["gambar"];

    $sql="delete from artikel where id_artikel=$id_artikel";
    $hapus_artikel=mysqli_query($conn,$sql);

    //Menghapus gambar, gambar yang dihapus jika selain gambar default
    if ($gambar!='gambar_default.png'){
        unlink("gambar/".$gambar);
    }
 

?><?php
session_start();
    include '../../config.php';

    $id_artikel=$_POST["id_artikel"];
    $gambar=$_POST["gambar"];

    $sql="delete from artikel where id_artikel=$id_artikel";
    $hapus_artikel=mysqli_query($conn,$sql);

    //Menghapus gambar, gambar yang dihapus jika selain gambar default
    if ($gambar!='gambar_default.png'){
        unlink("gambar/".$gambar);
    }
 

?>