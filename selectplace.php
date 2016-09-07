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

$conn = new mysqli("be826d4ad86399", "be826d4ad86399", "8670b078", "dbpalhub");
$result = $conn->query("SELECT * FROM markers order by name");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'                       . $rs["id"]                        . '",';

    $outp .= '"name":"'                       . $rs["name"]                        . '",';

    $outp .= '"imageprofile":"'                       . $rs["imageprofile"]                       . '",';

    $outp .= '"deskripsi":"'                       . $rs["deskripsi"]                       . '",';

    $outp .= '"contact":"'                       . $rs["contact"]                       . '",';

    $outp .= '"address":"'                       . $rs["address"]                       . '",';

    $outp .= '"lat":"'                       . $rs["lat"]                       . '",';

    $outp .= '"lng":"'                       . $rs["lng"]                       . '",';

    $outp .= '"type":"'                       . $rs["type"]                       . '"}';

}
$outp ='{"records":['.$outp.']}';
echo($outp);
$conn->close();
?>
