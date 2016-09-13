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
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error());
}

$postdata = file_get_contents("php://input");
if (isset($postdata)) {
   $request = json_decode($postdata);
   $caption = $request->deskripsi;
   $sql = "INSERT INTO timelines (photo1,deskripsi,pengirim,location,lat,lng,like) VALUES ('null',$caption','null','null',0.02,0.02,0)";
   $result= mysqli_query($conn,$sql);
        if ($result){
                echo json_encode(true);
                echo "ja";
          }
        else{
                  echo json_encode(false);
                  echo "failed";
        }
}
else{
        echo json_encode(false);
                  echo "empty";
}
?>
