<?php
/*
    Author: Son Nguyen && Vivien Chow
    Description: This file delete student.
    Last Working Date: April-07-2016
    File: delete_student.php
*/

//http://stackoverflow.com/questions/18382740/cors-not-working-php
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

$postData = file_get_contents("php://input");
$dataObject = json_decode($postData);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jokedb";

// Create connection
$link = mysql_connect($servername, $username, $password);
// Check connection
if (!$link)
 {
    die("Connection failed: " . mysql_connect_error());
}

mysql_select_db($dbname, $link);

// Escape user inputs for security
$id = mysql_real_escape_string($dataObject->id);

$sql = "DELETE from mahasiswa
        WHERE id = $id ";

mysql_query($sql);
mysql_close($link);
?>
