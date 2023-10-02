<?php
include '../connection.php';

$userName = $_POST['name'];
$userSurname = $_POST['surname'];
$userEmail = $_POST['email'];
$userPassword = md5($_POST['password']);

$createUserQuery = 
    "INSERT INTO user SET name = '$userName', surname = '$userSurname', 
    email = '$userEmail', password = '$userPassword'";
    
$result = $connection->query($createUserQuery);

if($result){
    echo json_encode(array("success"=>true));
}
else{
    echo json_encode(array("success"=>false));
}
