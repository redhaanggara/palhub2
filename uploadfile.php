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

$servername = "us-cdbr-azure-west-b.cleardb.com";
$username = "be826d4ad86399";
$password = "8670b078";
$dbname = "dbpalhub";

// Create connection
$link = mysql_connect($servername, $username, $password);
// Check connection
if (!$link) {
    die("Connection failed: " . mysql_connect_error());
}

mysql_select_db($dbname, $link);
$deskripsi = $_POST['deskripsi'];
$uname = $_POST['uname'];
$lokasi = $_POST['lokasi'];
$x=$_POST['lat'];
$y=$_POST['lng'];
print_r($_FILES);

if(!empty($_FILES)){

  //file1
  $targetfile1 = $_FILES['file1']['tmp_name'];
  $namafile1 = $_FILES['file1']['name'];
  $uploadPath1= "timeline/$namafile1";


  $sql = "INSERT INTO timelines (photo1,deskripsi,pengirim,location,lat,lng) VALUES
        ('$namafile1','$deskripsi','$uname','$lokasi','$x','$y')";
        
if (mysql_query($sql))
{
move_uploaded_file($targetfile1,"$uploadPath1");

echo json_encode(true);
echo "ja";
mysql_close($link);
}

else{
  echo json_encode(false);
  echo "ja";
}
}

else{
  echo json_encode(false);
  echo "ja";
}


?>


