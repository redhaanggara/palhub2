<?php
//Untuk antisipasi error No Access Control Allowed antar host
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
 
//Isi sesuai database
$mysqli=new mysqli("us-cdbr-azure-west-b.cleardb.com","be826d4ad86399","8670b078", "dbpalhub");
 

 $postdata = file_get_contents("php://input");
 $request = json_decode($postdata);
 $idx = $request->id;

  $sql="SELECT pengirim FROM timelines Where id='24'";

  $result = mysqli_query($mysqli,$sql);
  $count = mysqli_num_rows($result);

  if ($count > 0){
    $sqlq="SELECT * FROM users Where email='$result'";
    $resulx = mysqli_query($mysqli,$sqlq);
    $data = mysqli_fetch_array($resulx, MYSQL_ASSOC); //Data user difettch dalam bentuk array lalu diubah jadi JSON biar bisa diolah per objek/fieldnya
    echo json_encode($data);
  }
?>
