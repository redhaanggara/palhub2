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



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xcxc";

// Create connection
$link = mysql_connect($servername, $username, $password);
// Check connection
if (!$link) {
    die("Connection failed: " . mysql_connect_error());
}


mysql_select_db($dbname, $link);
print_r($_FILES);

if(isset($_FILES['file'])){
    if(count($_FILES['file']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['file']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

              $h1 =$_FILES['file']['name'][0];
              $h2 =$_FILES['file']['name'][1];
              $h3 =$_FILES['file']['name'][2];


            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
               // $shortname = $_FILES['file']['name'][$i];

                //save the url and the file
                $filePath = "ab/" .$_FILES['file']['name'][$i];

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    //insert into db 
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file
                }
              }
        }
          $sql = "INSERT INTO cbmultiple (tanggalpost,x,y,z) VALUES
                     (null,'$h1','$h2','$h3')";
          
                     mysql_query($sql);
    }
}
?>