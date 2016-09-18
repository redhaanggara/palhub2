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
$server = "us-cdbr-azure-west-b.cleardb.com";
$username = "be826d4ad86399";
$password = "8670b078";
$database = "dbpalhub";
// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");

$postdata = file_get_contents('php://input');
if ($postdata == ""){
    echo "postkosong";
}
else {
    echo "masuke";
    $request = json_decode($postdata);
    $deskripsi = $request->deskripsi;
    $uname = $request->uname;
    $lokasi = $request->lokasi;
    $x= $request->lat;
    $y= $request->lng;
    $target_dir = "xyz/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $namafile = basename( $_FILES["file"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  if(mysql_query("INSERT INTO timelines(photo1,deskripsi,pengirim,location,lat,lng) VALUES
        ('$namafile','$deskripsi','$uname','$lokasi','$x','$y'")){
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file){
            echo json_encode(true);
            echo "perfect";
        }
            else{
                echo json_encode(false);
                echo "gagalmovefile";
            }
        }
 else{
      echo json_encode(false);
      echo "gagalinsert";
 }
}
?>
