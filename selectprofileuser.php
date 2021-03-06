<?php

session_start();
$usernow = $_SESSION['usernow'];

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

$conn = new mysqli("us-cdbr-azure-west-b.cleardb.com", "us-cdbr-azure-west-b.cleardb.com", "8670b078", "dbpalhub");
$result = $conn->query("SELECT * from user where user = '$usernow' ");

$outp = "";

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"name":"'                       . $rs["name"]                        . '",';
    $outp .= '"bio":"'                       . $rs["bio"]                       . '",';
    $outp .= '"email":"'                       . $rs["email"]                       . '",';
    $outp .= '"phone":"'                       . $rs["phone"]                       . '",';
    $outp .= '"join":"'                       . $rs["join"]                       . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();
echo($outp);
?>
