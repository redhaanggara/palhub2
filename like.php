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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jokedb";

// Create connection
$mysqli=new mysqli("localhost","root","", "jokedb");


$postdata = file_get_contents('php://input');
$request = json_decode($postdata);

$idx = mysql_real_escape_string($request->idx);
$uname = mysql_real_escape_string($request->user);

$sqlll="SELECT * FROM userlike WHERE idposting ='$idx' AND likers ='$uname'";
$resulttt = mysqli_query($mysqli,$sqlll);

  $count = mysqli_num_rows($resulttt); //Kalo data User yang dicari oleh query $sql ada ditabase, count akan bernilai 1
  if($count <= 0){
     $sqll = "INSERT INTO userlike (idposting,likers) VALUES
        ('$idx','$uname')";
    mysqli_query($mysqli,$sqll);
          
    $result = "SELECT `like` From `timelines` WHERE id ='$idx'";
    
    if($hasil = mysqli_query($mysqli,$result)){
    while ($execute=mysqli_fetch_assoc($hasil)) {
        $bs=$execute['like'];
        }
    }

    $num=$bs=$bs+1;
    $sql = "UPDATE `timelines` SET `like` = $num where id = '$idx'";       
    mysqli_query($mysqli,$sql);
  }
  else{
   echo "falseja";
}
exit();
?>