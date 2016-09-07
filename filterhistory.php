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


mysql_connect("us-cdbr-azure-west-b.cleardb.com","be826d4ad86399", "8670b078") or die('Could not connect');
mysql_select_db("dbpalhub");
$postdata = file_get_contents('php://input');
$request = json_decode($postdata);
$uname = mysql_real_escape_string($request->uname);

$sql= "SELECT A.id,A.tanggal,A.photo1,A.deskripsi,A.pengirim,A.location,A.lat,A.lng,A.like,B.dp from timelines A ,users B where A.pengirim ='$uname'  AND B.email = '$uname' ORDER BY A.id DESC";
$result = mysql_query($sql);
$outp = array();

while($row = mysql_fetch_row($result)) {
   $outp[] = $row;
}
echo json_encode($temp);
?>
