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

// Create connection
$mysqli=new mysqli("us-cdbr-azure-west-b.cleardb.com","be826d4ad86399","8670b078", "dbpalhub");
$postData = file_get_contents('php://input');

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
//-file
$sql = "INSERT INTO timelines (photo1,deskripsi,pengirim,location,lat,lng) VALUES
        ('$namafile1','$deskripsi','$uname','$lokasi','$x','$y')";
if (mysqli_query($mysqli,$sql)){
        move_uploaded_file($targetfile1,"$uploadPath1");
        echo json_encode(true);
        echo "ja";
        exit();
}
else{
      echo json_encode(false);
      echo "ja";
}}
else{
      echo json_encode(false);
      echo "ja";
}
?>


