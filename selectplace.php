<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("be826d4ad86399", "be826d4ad86399", "8670b078", "dbpalhub");
$result = $conn->query("SELECT * FROM markers order by name");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'                       . $rs["id"]                        . '",';

    $outp .= '"name":"'                       . $rs["name"]                        . '",';

    $outp .= '"imageprofile":"'                       . $rs["imageprofile"]                       . '",';

    $outp .= '"deskripsi":"'                       . $rs["deskripsi"]                       . '",';

    $outp .= '"contact":"'                       . $rs["contact"]                       . '",';

    $outp .= '"address":"'                       . $rs["address"]                       . '",';

    $outp .= '"lat":"'                       . $rs["lat"]                       . '",';

    $outp .= '"lng":"'                       . $rs["lng"]                       . '",';

    $outp .= '"type":"'                       . $rs["type"]                       . '"}';

}
$outp ='{"records":['.$outp.']}';
echo($outp);
?>
