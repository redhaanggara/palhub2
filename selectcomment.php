<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$link = new mysqli("us-cdbr-azure-west-b.cleardb.com", "be826d4ad86399", "8670b078", "dbpalhub");
$id = $_GET['idx'];

$result = $link->query("SELECT A.time, A.comment, A.id, A.pengirim, B.dp FROM comment A, users B WHERE A.id = '$id' AND A.pengirim = B.email");


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"time":"'                       . $rs["time"]                        . '",';

    $outp .= '"comment":"'                       . $rs["comment"]                        . '",';

    $outp .= '"id":"'                       . $rs["id"]                        . '",';

    $outp .= '"pengirim":"'                       . $rs["pengirim"]                       . '",';

    $outp .= '"dp":"'                       . $rs["dp"]                       . '"}';

}

$outp ='{"records":['.$outp.']}';
echo($outp);

?>
