<?php
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

if(isset($_POST['submit'])){
    if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

              $h1 =$_FILES['upload']['name'][0];
              $h2 =$_FILES['upload']['name'][1];
              $h3 =$_FILES['upload']['name'][2];


            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['upload']['name'][$i];

                //save the url and the file
                $filePath = "ab/" .$_FILES['upload']['name'][$i];

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

    //show success message
    echo "<h1>Uploaded:</h1>";    
    if(is_array($files)){
        echo "<ul>";
        foreach($files as $file){
            echo "<li>$file</li>";
        }
        echo "</ul>";
    }
}
?>

<form action="" enctype="multipart/form-data" method="post">

    <div>
        <label for='upload'>Add Attachments:</label>
        <input id='upload' name="upload[]" type="file" multiple="multiple" />
    </div>

    <p><input type="submit" name="submit" value="Submit"></p>

</form>