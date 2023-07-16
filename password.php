


<div style="border:1px solid rgb(238,238,238); padding:10px; overflow:auto; width:1220px; height:325px;">
    <?php

    session_start();
    ob_start();

    if(!isset($_SESSION['session_username'])){
        header("location:index.php?m=login");
        exit();
        
    }

    include "config.php";
    // if (isset($_GET['username'])) {
    //     $username = $_GET['username'];
    // }
    // else {
    // die ("Error. No ID Selected! ");    
    // }
    //proses ganti password

    $sql = "SELECT username FROM login";
    $nama = mysqli_query($conn,$sql) ;
    $auah = mysqli_fetch_array($nama);



    if (isset($_POST['Ganti'])) {
    $username        = $_POST['username'];
    $password_lama    = $_POST['password_lama'];
    $password_baru    = $_POST['password_baru'];
    $konf_password    = $_POST['konf_password'];
    $oi =     md5 ($password_lama);  
    $baru =   md5 ($password_baru); 
    

    //cek old password
    $query = "SELECT * FROM login WHERE username='$username' AND password='$oi'";
    $sql = mysqli_query ( $conn, $query);
    $hasil = mysqli_num_rows ($sql);
    if (! $hasil >= 1) {
        print_msg('Password lama salah.');
    }
    //validasi data data kosong
    else if (empty($_POST['password_baru']) || empty($_POST['konf_password'])) {
            echo "<h3><font color=red>Ganti Password Gagal! Data Tidak Boleh Kosong.</font></h3>";    
    }
    //validasi input konfirm password
    else if (($_POST['password_baru']) != ($_POST['konf_password'])) {
            echo "<h3><font color=red><center>Ganti Password Gagal! Password dan Konfirm Password Harus Sama.</center></font></h3>";    
    }
    else {
    //update data

    $query = "UPDATE login SET password='$baru' WHERE username='$username'";
    $sql = mysqli_query ($conn, $query);
    //setelah berhasil update
    if ($sql) {
        echo "<h3><font color=#8BB2D9><center>Ganti Password Berhasil!</center></font></h3>";    
    } else {
        echo "<h3><font color=red><center>Ganti Password Gagal!</center></font></h3>";    
    }
    }
    }
?>
<form action="#" method="POST" name="form-ganti-password" enctype="multipart/form-data">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr height="56" align="center">
            <td><font size="2" color="FFA800"><b>Silahkan Ganti Password</b></font></td>
        </tr>
    </table>
    <table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr height="36">
            <td width="25%">Username</td>
            <td width="75%"><b><?=$auah['username']?><input type="hidden" name="username" id="username" value="<?=$auah['username']?>"></b></td>
        </tr>

        <tr height="36">
            <td>Password Lama</td>
            <td><input type="password" name="password_lama" id="password_lama" size="30" maxlength="20"></td>
        </tr>
        <tr height="36">
            <td>Password Baru</td>
            <td><input type="password" name="password_baru" id="password_baru" size="30" maxlength="20"></td>
        </tr>
        <tr height="36">
            <td>Konfirm Password Baru</td>
            <td><input type="password" name="konf_password" id="konf_password" size="30" maxlength="20"></td>
        </tr>
        <tr height="56">
            <td> </td>
            <td><input type="submit" name="Ganti" value="Ganti"></td>
        </tr>
    </table>
</form>

</div>