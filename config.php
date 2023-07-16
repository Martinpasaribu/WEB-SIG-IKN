
<p style="margin: -35px  0px 33px 0px ;     background: #16222A;background: -webkit-linear-gradient(59deg, #6f887b, #16222A); background: linear-gradient(59deg, #6f887b, #6f887b, #16222A); ">

<?php
$config["server"] = "127.0.0.1";
$config["username"] = "root";
$config["password"] = "";
$config["database_name"] = "kb_raya";

$servername = "127.0.0.1";
$nama = "root";
$password = "";
$database = "kb_raya";
// Create connection
$conn = mysqli_connect($servername, $nama, $password,$database);
$sql = "SELECT username FROM login";

$nama = mysqli_query($conn,$sql) ;
$auah = mysqli_fetch_array($nama);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


?>
</p>