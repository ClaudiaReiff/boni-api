<?php
include '../connection.php';

$userName = $_POST['name'];
$userSurname = $_POST['surname'];
$userEmail = $_POST['email'];

$createUserQuery = "INSERT INTO user SET email = '$userEmail', name = '$userName', surname = '$userSurname'";
$result = $connection->query($createUserQuery);

if($result){
    echo json_encode(array("success"=>true));
}
else{
    echo json_encode(array("success"=>false));
}
