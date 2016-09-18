<?php
$servername = "us-cdbr-azure-west-b.cleardb.com";
$username = "be826d4ad86399";
$password = "8670b078";
$database = "dbpalhub";
// Koneksi dan memilih database di server
if(mysql_connect($servername,$username,$password)){
    echo "Koneksi Baik";
    if(mysql_select_db($database)){
        echo "database baik";
    }
    else{
        echo "database gagal";
    }
}
else{
    echo "koneksi gagal";
}
$postData = file_get_contents('php://input');
if (isset($postdata)){
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
else{
    echo json_encode(false);
     echo "postkosong";
}
?>
