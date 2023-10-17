<?php
include '../connection.php';

$routeId = $_POST['id'];

$routeQuery = "SELECT * FROM route WHERE id = '$routeId'";
$result = $connection->query($routeQuery);

//route found
if($result->num_rows > 0){
    $routeRecord = array();
    while($rowFound = $result->fetch_assoc()){
        $routeRecord[] = $rowFound;
    }
    echo json_encode(array("success"=>true, "routeData" => $routeRecord[0]));
}
else{
    echo json_encode(array("success"=>false));
}
