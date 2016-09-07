<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept");

$link = new mysqli("localhost", "root", "", "jokedb");

$uname = $_GET['person'];

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
$link->close();
echo($outp);
?>
