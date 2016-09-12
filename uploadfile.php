<?php
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

$deskripsi = $_POST['deskripsi'];
$uname = $_POST['uname'];
$lokasi = $_POST['lokasi'];
$x=$_POST['lat'];
$y=$_POST['lng'];
$namefile ="cecak";

  $sql = "INSERT INTO timelines (photo1,deskripsi,pengirim,location,lat,lng) VALUES
        ('$namafile','$deskripsi','$uname','$lokasi','$x','$y')";
        if ($conn->query($sql) == TRUE){
                echo json_encode(true);
                echo "ja";
          }
        else{
                  echo json_encode(false);
                  echo "fail";
        }
?>
