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

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$link = new mysqli("us-cdbr-azure-west-b.cleardb.com", "be826d4ad86399", "8670b078", "dbpalhub");

$uname = $_GET['person'];
$sql = "SELECT A.id,A.tanggal,A.photo1,A.deskripsi,A.pengirim,A.location,A.lat,A.lng,A.like,B.dp from timelines A ,users B where A.pengirim ='$uname'  AND B.email = '$uname' ORDER BY A.id DESC";
$result = mysqli_query($link,$sql);
$data = mysqli_fetch_array($result, MYSQL_ASSOC); //Data user difetch dalam bentuk array lalu diubah jadi JSON biar bisa diolah per objek/fieldnya
echo json_encode($data);
exit();
?>
