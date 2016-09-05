<?php


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


$postData = file_get_contents('php://input');
$dataObject = json_decode($postData);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xcxc";

// Create connection
$link = mysql_connect($servername, $username, $password);
// Check connection
if (!$link) {
    die("Connection failed: " . mysql_connect_error());
}

mysql_select_db($dbname, $link);

//nama
//$namapost = mysql_real_escape_string($dataObject->namapost);

//file
//$deskripsi = mysql_real_escape_string($dataObject->deskripsi);

if(!empty($_FILES)){

//photo1
$targetfile = $_FILES['file']['tmp_name'];
$namafileimg1 = $_FILES['file']['name'];
$uploadPath= "images/$namafile";

if (move_uploaded_file($targetfile,"$uploadPath")){
  echo ("name: ".$_FILES['file']['name']);
  
  // Masukkan informasi file ke database
  $konek = mysqli_connect('localhost','root','','xcxc');
  $nm = $_FILES['file']['name'];
  $sql = "INSERT INTO ggg (tanggalpost,photo) VALUES
        (null,$namafileimg1')";
          
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


//----------------------------------------------------------- ISI AGEK //

//photo2


//photo3

//file




?>