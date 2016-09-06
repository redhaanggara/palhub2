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
 if (isset($postdata)) { //Periksa apakah data yang dipost bernilai null
      $request = json_decode($postdata);
      $name = $request->name;
      $email = $request->email;
      $password = $request->password; //Sesuaikan dengan rumus password yang sudah dipake sebelumnya
     
  $sql="SELECT * FROM users WHERE email='$email'";

  $result = mysqli_query($mysqli,$sql);

  $count = mysqli_num_rows($result); //Kalo data User yang dicari oleh query $sql ada ditabase, count akan bernilai 1
  if($count > 0){
    echo json_encode(false);
    echo "ja";
  }

  else{
    $sqll = "INSERT INTO users (nama,email,password,phone,dp,bio,locate) VALUES
        ('$name','$email','$password','null','null','null','null')";
          
    mysqli_query($mysqli,$sqll);
    echo json_encode(true);
  }
}
else {
  echo json_encode(false); //Antisipasi apabila data yg dipost null, response = falsenein
  echo "nein";
}

?>
