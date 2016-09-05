<?php
//Untuk antisipasi error No Access Control Allowed antar host
 if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
//Isi sesuai database
$postData = file_get_contents('php://input');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jokedb";

// Create connection
$link = mysql_connect($servername, $username, $password);
// Check connection
if (!$link) {
    die("Connection failed: " . mysql_connect_error());
}

mysql_select_db($dbname, $link);

$email = $_POST['uname'];
$nama = $_POST['nama'];
$bio = $_POST['bio'];
$phone = $_POST['phone'];
print_r($_FILES);

if(!empty($_FILES)){
  $targetfile = $_FILES['file']['tmp_name'];
  $namafile = $_FILES['file']['name'];
  $uploadPath= "displaypictures/$namafile";

if (move_uploaded_file($targetfile,"$uploadPath")){
  echo ("name: ".$_FILES['file']['name']);
  $konek = mysqli_connect('localhost','root','','jokedb');
  $sql="UPDATE users set nama='$nama', dp= '$namafile',bio='$bio', phone='$phone' WHERE email = '$email'";    
  mysql_query($sql);
  mysql_close($link);
 }
else{
  echo "File gagal di upload";
 }
}

else{
  echo "file kosong";
}
?>
