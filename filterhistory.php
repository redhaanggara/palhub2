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


$link = new mysqli("us-cdbr-azure-west-b.cleardb.com", "be826d4ad86399", "8670b078", "dbpalhub");

$postdata = file_get_contents('php://input');
$request = json_decode($postdata);
$uname = mysql_real_escape_string($request->uname);

$result = $link->query("SELECT A.id,A.tanggal,A.photo1,A.deskripsi,A.pengirim,A.location,A.lat,A.lng,A.like,B.dp from timelines A ,users B where A.pengirim ='$uname'  AND B.email = '$uname' ORDER BY A.id DESC");


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'                       . $rs["id"]                        . '",';

    $outp .= '"tanggal":"'                       . $rs["tanggal"]                        . '",';

    $outp .= '"photo1":"'                       . $rs["photo1"]                       . '",';

    $outp .= '"deskripsi":"'                       . $rs["deskripsi"]                       . '",';

    $outp .= '"pengirim":"'                       . $rs["pengirim"]                       . '",';

    $outp .= '"location":"'                       . $rs["location"]                       . '",';

    $outp .= '"lat":"'                       . $rs["lat"]                       . '",';

    $outp .= '"lng":"'                       . $rs["lng"]                       . '",';

    $outp .= '"like":"'                       . $rs["like"]                       . '",';

    $outp .= '"dp":"'                       . $rs["dp"]                       . '"}';
}
$outp ='{"records":['.$outp.']}';
echo json_encode($outp);
exit();
?>
