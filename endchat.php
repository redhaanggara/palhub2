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




$servername = "us-cdbr-azure-west-b.cleardb.com";
$username = "be826d4ad86399";
$password = "8670b078";
$dbname = "dbpalhub";

// Create connection
$link = mysql_connect($servername, $username, $password);
// Check connection
if (!$link) {
    die("Connection failed: " . mysql_connect_error());
}

mysql_select_db($dbname, $link);
$postdata = file_get_contents('php://input');
$request = json_decode($postdata);

$pengirim = mysql_real_escape_string($request->pengirim);
$penerima = mysql_real_escape_string($request->penerima);

$sql = "DELETE FROM chat
WHERE pengirim = '$pengirim' AND penerima='$penerima'";
          
mysql_query($sql);
mysql_close($link);
?>

