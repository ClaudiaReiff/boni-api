<?php
include '../connection.php';

$trailId = $_POST['id'];

$trailQuery = "SELECT * FROM route WHERE id = '$trailId'";
$result = $connection->query($trailQuery);

//trail found
if($result->num_rows > 0){
    $trailRecord = array();
    while($rowFound = $result->fetch_assoc()){
        $trailRecord[] = $rowFound;
    }
    echo json_encode(array("success"=>true, "trailData" => $trailRecord[0]));
}
else{
    echo json_encode(array("success"=>false));
}
