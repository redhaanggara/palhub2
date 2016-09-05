 <?php

     $target_dir = "images";
     $name = $_POST['name'];
     print_r($_FILES);
     $target_file = $target_dir . basename($_FILES['file']['name']);

     move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

     //write code for saving to database 

     // Create connection
     $servername = "localhost";

     $username = "root";
     $password = "";
     $dbname = "jokedb";
     $conn = mysql_connect($servername, $username, $password);
     // Check connection
     if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
     }

     $sql = "INSERT INTO MyData1 (name,filename) VALUES ('$name','".basename($_FILES["file"]["name"])."')";

     if ($sql === TRUE) {
         echo json_encode($_FILES["file"]); // new file uploaded
     } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
     }

?>