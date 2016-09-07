<?php
//Untuk antisipasi error No Access Control Allowed antar host
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept");
 
// Create connection
$mysqli=new mysqli("us-cdbr-azure-west-b.cleardb.com","be826d4ad86399","8670b078", "dbpalhub");

$postdata = file_get_contents('php://input');
$request = json_decode($postdata);

$idx = mysql_real_escape_string($request->idx);
$uname = mysql_real_escape_string($request->user);

$sqlll="SELECT * FROM userlike WHERE idposting ='$idx' AND likers ='$uname'";
$resulttt = mysqli_query($mysqli,$sqlll);

  $count = mysqli_num_rows($resulttt); //Kalo data User yang dicari oleh query $sql ada ditabase, count akan bernilai 1
  if($count <= 0){
     $sqll = "INSERT INTO userlike (idposting,likers) VALUES ('$idx','$uname')";
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
?>
