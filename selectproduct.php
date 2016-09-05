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


$link = new mysqli("localhost", "root", "", "jokedb");

$postdata = file_get_contents('php://input');
$request = json_decode($postdata);
$pelapak = mysql_real_escape_string($request->pelapak);

$result = $link->query("SELECT * FROM productmarkers WHERE pelapak='$pelapak'");


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"no":"'                       . $rs["no"]                        . '",';

     $outp .= '"time":"'                       . $rs["time"]                       . '",';

    $outp .= '"pelapak":"'                       . $rs["pelapak"]                       . '",';

    $outp .= '"product":"'                       . $rs["product"]                       . '",';

    $outp .= '"deskripsi":"'                       . $rs["deskripsi"]                       . '",';

    $outp .= '"image":"'                       . $rs["image"]                       . '"}';

}
$outp ='{"records":['.$outp.']}';
$link->close();
echo($outp);

?>