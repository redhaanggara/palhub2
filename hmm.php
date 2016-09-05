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



$postData = file_get_contents('php://input');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jokedb";

// Create connection
$link = mysql_connect($servername, $username, $password);
// Check connection
if (!$link) {
    die("Connection failed: " . mysql_connect_error());
}

mysql_select_db($dbname, $link);
$conn = new mysqli("localhost", "root", "", "jokedb");
$result = $conn->query("SELECT dp from users where email='redha'");
$red=$result;

 $sql = "INSERT INTO timelines (nama,photo,photo1,photo2,deskripsi,pengirim,like,dp) VALUES
        ('mahumud','yono','test','test','marcella','daryanani',null,'$red')";
          
mysql_query($sql);
mysql_close($link);
?>
