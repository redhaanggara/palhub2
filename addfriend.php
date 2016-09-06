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
$username = "be826d4ad86399t";
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


$user = mysql_real_escape_string($request->user);
$friend = mysql_real_escape_string($request->friend);
$photo = mysql_real_escape_string($request->photo);

$as="SELECT dp FROM users WHERE email='$user'";

if($joker = mysql_query($as)){
while ($execute=mysql_fetch_assoc($joker)) {
    $dp=$execute['dp'];
}
}

$sql1="SELECT * FROM friend WHERE user='$user' AND friend='$friend'";
$result = mysql_query($sql1);
$count = mysql_num_rows($result); //Kalo data User yang dicari oleh query $sql ada ditabase, count akan bernilai 1
  
if($count > 0){
    $data = "false";
    echo $data;
    mysql_close($link);
}
else{
$sql2 = "INSERT INTO friend (user,friend,photo) VALUES
        ('$user','$friend','$photo')";
        mysql_query($sql2);

$sql3 = "INSERT INTO friend (user,friend,photo) VALUES
        ('$friend','$user','$dp')";
        mysql_query($sql3);

$data = "true"; //Data user difetch dalam bentuk array lalu diubah jadi JSON biar bisa diolah per objek/fieldnya
echo $data;
}
mysql_close($link);        
?>

