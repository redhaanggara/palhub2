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
    
// Create connection
$mysqli = new mysqli('us-cdbr-azure-west-b.cleardb.com','be826d4ad86399','8670b078','dbpalhub');
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$caption = $request->desc;
if (isset($caption)) {
   $sql = "INSERT INTO timelines (id,tanggal,photo1,deskripsi,pengirim,location,lat,lng,like) VALUES (null,null,'null','$caption','null','null',0,0,0)";
   mysqli_query($mysqli,$sql);
   echo json_encode(true);
   echo "ya";
}
else{
        echo json_encode(false);
        echo "empty";
}
?>
