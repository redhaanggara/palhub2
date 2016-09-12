<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$mysqli= new mysqli("us-cdbr-azure-west-b.cleardb.com","be826d4ad86399","8670b078", "dbpalhub");

$deskripsi = $_POST['deskripsi'];
$uname = $_POST['uname'];
$lokasi = $_POST['lokasi'];
$x=$_POST['lat'];
$y=$_POST['lng'];
print_r($_FILES);

if(!empty($_FILES)){
//file1
$targetfile1 = $_FILES['file']['tmp_name'];
$namafile1 = $_FILES['file']['name'];
$uploadPath1= "xyz/$namafile1";
//-file
$result = $link->query("INSERT INTO timelines (photo1,deskripsi,pengirim,location,lat,lng) VALUES
        ('$namafile1','$deskripsi','$uname','$lokasi','$x','$y')");
if ($result){
        move_uploaded_file($targetfile1,"$uploadPath1");
        echo json_encode(true);
        echo "ja";
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
