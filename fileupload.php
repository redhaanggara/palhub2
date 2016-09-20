<?php
header('Access-Control-Allow-Origin: *');
if(isset($_POST['btnsubmit'])){
	$namafile= $_FILES['userfile']['name'];
	$temporari= $_FILES['userfile']['tmp_name'];
    $target_path = "xyz/";
 
    if(move_uploaded_file($temporari, $target_path)) {
     echo ($namafile);
      echo "Upload and move success";
     } else{
      echo "There was an error uploading the file, please try again!";
     }  
 }
 else{
 	echo "kosong";
 } 
?>
