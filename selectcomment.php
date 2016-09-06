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
$id = mysql_real_escape_string($request->id);

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
$link->close();
echo($outp);

?>
