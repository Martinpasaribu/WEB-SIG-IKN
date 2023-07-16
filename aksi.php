<?php
require_once'functions.php';

 
// session_start();
// ob_start();

// if(!isset($_SESSION['session_username'])){
//     header("location:index.php?m=login");
//     exit();
    
// }


session_start();

//atur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "kb_raya";
$koneksi    = mysqli_connect($host_db,$user_db,$pass_db,$nama_db);
//atur variabel
$err        = "";
$username   = "";
$ingataku   = "";

if($mod=='tempat_ubah'){
    $nama_tempat = $_POST['nama_tempat'];
    $gambar = $_FILES['gambar'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $lokasi = $_POST['lokasi'];
    $keterangan = esc_field($_POST['keterangan']);
    
    if($nama_tempat=='' || $lat=='' || $lng=='' || $lokasi=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{           
        if($gambar['name']!=''){
            hapus_gambar($_GET['ID']);
                            
            $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);
            $img = new SimpleImage($gambar['tmp_name']);
            if($img->get_width()>800)
                $img->fit_to_width(800);
            if($img->get_height()>600);
                $img->fit_to_height(600);
            $img->save('assets/images/tempat/' . $file_name);            
            $img->thumbnail(180, 120);
            $img->save('assets/images/tempat/small_' . $file_name);
            
            $sql_gambar = ", gambar='$file_name'";
        }
        $db->query("UPDATE tb_tempat SET nama_tempat='$nama_tempat' $sql_gambar , lat='$lat', lng='$lng', lokasi='$lokasi', keterangan='$keterangan' WHERE id_tempat='$_GET[ID]'");
        redirect_js("index.php?m=tempat");
    }    
} 


 if($mod=='fasilitas_ubah'){
    $nama_fasilitas = $_POST['nama_fasilitas'];
    $gambar = $_FILES['gambar'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $lokasi = $_POST['lokasi'];
    $keterangan = esc_field($_POST['keterangan']);
    
    if($nama_fasilitas=='' || $lat=='' || $lng=='' || $lokasi=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{           
        if($gambar['name']!=''){
            hapus_gambar($_GET['ID']);
                            
            $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);
            $img = new SimpleImage($gambar['tmp_name']);
            if($img->get_width()>800)
                $img->fit_to_width(800);
            if($img->get_height()>600);
                $img->fit_to_height(600);
            $img->save('assets/images/tempat/' . $file_name);            
            $img->thumbnail(180, 120);
            $img->save('assets/images/tempat/small_' . $file_name);
            
            $sql_gambar = ", gambar='$file_name'";
        }
        $db->query("UPDATE tb_fasilitas SET nama_fasilitas='$nama_fasilitas' $sql_gambar , lat='$lat', lng='$lng', lokasi='$lokasi', keterangan='$keterangan' WHERE id_fasilitas='$_GET[ID]'");
        redirect_js("index.php?m=fasilitas");
    }    
} 

if($mod=='tempat_tambah'){
    $nama_tempat = $_POST['nama_tempat'];
    $gambar = $_FILES['gambar'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $lokasi = $_POST['lokasi'];
    $keterangan = esc_field($_POST['keterangan']);
    
    if($nama_tempat=='' || $gambar['name']=='' || $lat=='' || $lng=='' || $lokasi=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);
        $img = new SimpleImage($gambar['tmp_name']);
        if($img->get_width()>800)
            $img->fit_to_width(800);
        if($img->get_height()>600);
            $img->fit_to_height(600);
        $img->save('assets/images/tempat/' . $file_name);            
        $img->thumbnail(180, 120);
        $img->save('assets/images/tempat/small_' . $file_name);
        
        $db->query("INSERT INTO tb_tempat (nama_tempat, gambar, lat, lng, lokasi, keterangan) 
                VALUES ('$nama_tempat', '$file_name', '$lat', '$lng', '$lokasi', '$keterangan')");                       
        header("location:tempat.php");
    }         
}

 if ($mod=='fasilitas_tambah'){
    $nama_fasilitas = $_POST['nama_fasilitas'];
    $gambar = $_FILES['gambar'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $lokasi = $_POST['lokasi'];
    $keterangan = esc_field($_POST['keterangan']);
    
    if($nama_fasilitas=='' || $gambar['name']=='' || $lat=='' || $lng=='' || $lokasi=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);
        $img = new SimpleImage($gambar['tmp_name']);
        if($img->get_width()>800)
            $img->fit_to_width(800);
        if($img->get_height()>600);
            $img->fit_to_height(600);
        $img->save('assets/images/tempat/' . $file_name);            
        $img->thumbnail(180, 120);
        $img->save('assets/images/tempat/small_' . $file_name);
        
        $db->query("INSERT INTO tb_fasilitas (nama_fasilitas, gambar, lat, lng, lokasi, keterangan) 
                VALUES ('$nama_fasilitas', '$file_name', '$lat', '$lng', '$lokasi', '$keterangan')");                       
        redirect_js("admin.php?m=fasilitas");
    }        

}


if ($act=='tempat_hapus'){
    hapus_gambar($_GET['ID']);
    $db->query("DELETE FROM tb_tempat WHERE id_tempat='$_GET[ID]'");
    redirect_js("admin.php?m=tempat");
} 
 if ($act=='fasilitas_hapus'){
    hapus_gambar($_GET['ID']);
    $db->query("DELETE FROM tb_fasilitas WHERE id_fasilitas='$_GET[ID]'");
    header("location:admin.php?m=fasilitas");
}

if(isset($_COOKIE['cookie_username'])){
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_password = $_COOKIE['cookie_password'];

    $sql1 = "select * from login where username = '$cookie_username'";
    $q1   = mysqli_query($koneksi,$sql1);
    $r1   = mysqli_fetch_array($q1);
    if($r1['password'] == $cookie_password){
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['session_password'] = $cookie_password;
    }
}

if($act=='logout'){
    unset($_SESSION['session_username']);
    header("location:index.php?m=login");}

if(isset($_SESSION['session_username'])){
    header("location:admin.php");
    exit();
}


if(isset($_POST['login'])){
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $ingataku   = $_POST['ingataku'];

    if($username == '' or $password == ''){
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    }else{
        $sql1 = "select * from login where username = '$username'";
        $q1   = mysqli_query($koneksi,$sql1);
        $r1   = mysqli_fetch_array($q1);

        if($r1['username'] == ''){
            $err .= "<li>Username <b>$username</b> tidak tersedia.</li>";
        }elseif($r1['password'] != md5($password)){
            $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
        }       
        
        if(empty($err)){
            $_SESSION['session_username'] = $username; //server
            $_SESSION['session_password'] = md5($password);

            // if($ingataku == 1){
            //     $cookie_name = "cookie_username";
            //     $cookie_value = $username;
            //     $cookie_time = time() + (60 * 60 * 24 * 30);
            //     setcookie($cookie_name,$cookie_value,$cookie_time,"/");

            //     $cookie_name = "cookie_password";
            //     $cookie_value = md5($password);
            //     $cookie_time = time() + (60 * 60 * 24 * 30);
            //     setcookie($cookie_name,$cookie_value,$cookie_time,"/");
            // }
            header("location:admin.php");
        }
    }
}



    // /** LOGIN */ 
    // if ($mod=='login'){
    //     $user = esc_field($_POST['user']);
    //     $pass = esc_field($_POST['pass']);
        
    //     $row = $db->get_row("SELECT * FROM tb_user WHERE user='$user' AND pass='$pass'");
    //     if($row){
    //         $_SESSION['login'] = $row->user;

    //         redirect_js("admin.php");
    //         // header("location:admin.php");


    //     } else{
    //         // print_msg("Salah kombinasi username dan password.");
    //     }          
    // }
    
    //  if ($mod=='password'){
    //     $pass1 = $_POST['pass1'];
    //     $pass2 = $_POST['pass2'];
    //     $pass3 = $_POST['pass3'];
        
    //     // $row = $db->get_row("SELECT * FROM login WHERE username='$_SESSION[session_username]' AND password='$pass1'");        
        
    //     $sql1 = "SELECT * FROM login WHERE username='$_SESSION[session_username]' AND password='$pass1'";
    //     $q1   = mysqli_query($koneksi,$sql1);
    //     $r1   = mysqli_fetch_array($q1);

    //     if($pass1=='' || $pass2=='' || $pass3=='')
    //         print_msg('Field bertanda * harus diisi.');
    //     elseif(!$r1 )
    //         print_msg('Password lama salah.');
    //     elseif( $pass2 != $pass3 )
    //         print_msg('Password baru dan konfirmasi password baru tidak sama.');
    //     else{        
    //         $db->query("UPDATE login SET password='$pass2' WHERE username='$_SESSION[session_username]'");                    
    //         print_msg('Password berhasil diubah.', 'success');
    //     }
    // } 


    // if($act=='logout'){
    //     unset($_SESSION['login']);
    //     // header("location:index.php?m=login");
    // }
           
    /** PAGE */
    elseif($mod=='page_ubah'){
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
                        
        if($judul=='' || $isi=='' )
            print_msg("Field yang bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_page SET judul='$judul', isi='$isi' WHERE nama_page='$_GET[nama]'");                   
            print_msg("Data tersimpan", 'success');
        }
    } 
    
    // /** PURA */    
    // if($mod=='tempat_tambah'){
    //     $nama_tempat = $_POST['nama_tempat'];
    //     $gambar = $_FILES['gambar'];
    //     $lat = $_POST['lat'];
    //     $lng = $_POST['lng'];
    //     $lokasi = $_POST['lokasi'];
    //     $keterangan = esc_field($_POST['keterangan']);
        
    //     if($nama_tempat=='' || $gambar['name']=='' || $lat=='' || $lng=='' || $lokasi=='')
    //         print_msg("Field bertanda * tidak boleh kosong!");
    //     else{
    //         $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);
    //         $img = new SimpleImage($gambar['tmp_name']);
    //         if($img->get_width()>800)
    //             $img->fit_to_width(800);
    //         if($img->get_height()>600);
    //             $img->fit_to_height(600);
    //         $img->save('assets/images/tempat/' . $file_name);            
    //         $img->thumbnail(180, 120);
    //         $img->save('assets/images/tempat/small_' . $file_name);
            
    //         $db->query("INSERT INTO tb_tempat (nama_tempat, gambar, lat, lng, lokasi, keterangan) 
    //                 VALUES ('$nama_tempat', '$file_name', '$lat', '$lng', '$lokasi', '$keterangan')");                       
    //         redirect_js("admin.php?m=tempat");
    //     }         
    // }
            /** PURA */    
   
 

 
    
    /** GAMBAR */    
    if($mod=='galeri_tambah'){
        $id_tempat = $_POST['id_tempat'];
        $gambar = $_FILES['gambar'];
        $nama_galeri = $_POST['nama_galeri'];
        $ket_galeri = $_POST['ket_galeri'];
        
        if($id_tempat=='' || $gambar[name]=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{            
            $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);
            
            $img = new SimpleImage($gambar['tmp_name']);
            if($img->get_width()>800)
                $img->fit_to_width(800);
            if($img->get_height()>600);
                $img->fit_to_height(600);
            $img->save('assets/images/galeri/' . $file_name);
            $img->thumbnail(180, 120);
            $img->save('assets/images/galeri/small_' . $file_name);
            
            $db->query("INSERT INTO tb_galeri (id_tempat, gambar, nama_galeri, ket_galeri) 
                    VALUES('$id_tempat', '$file_name', '$nama_galeri', '$ket_galeri')");                       
            redirect_js("index.php?m=galeri");
        }                    
    } else if($mod=='galeri_ubah'){
        $id_tempat = $_POST['id_tempat'];
        $gambar = $_FILES['gambar'];
        $nama_galeri = $_POST['nama_galeri'];
        $ket_galeri = $_POST['ket_galeri'];
        
        if($id_tempat=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{  
            if($gambar[tmp_name]!=''){
                hapus_galeri($_GET['ID']);
                $file_name = rand(1000, 9999) . parse_file_name($gambar['name']);
                $img = new SimpleImage($gambar['tmp_name']);
                if($img->get_width()>800)
                    $img->fit_to_width(800);
                if($img->get_height()>600);
                    $img->fit_to_height(600);
                $img->save('assets/images/galeri/' . $file_name);
                $img->thumbnail(180, 120);
                $img->save('assets/images/galeri/small_' . $file_name);
                $sql_gambar = ", gambar='$file_name'";
            }
            $db->query("UPDATE tb_galeri SET id_tempat='$id_tempat', nama_galeri='$nama_galeri' $sql_gambar, ket_galeri='$ket_galeri' WHERE id_galeri='$_GET[ID]'");
            redirect_js("index.php?m=galeri");
        }    
    } else if ($act=='galeri_hapus'){
        hapus_galeri($_GET['ID']);
        $db->query("DELETE FROM tb_galeri WHERE id_galeri='$_GET[ID]'");
        header("location:index.php?m=galeri");
    }                        
