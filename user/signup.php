<?php
include '../connection.php';

$userName = $_POST['name'];
$userSurname = $_POST['surname'];
$userEmail = $_POST['email'];
$userPassword = md5($_POST['password']);

$createUserQuery = 
    "INSERT INTO user SET name = '$userName', surname = '$userSurname', 
    email = '$userEmail', password = '$userPassword'";
    
$createUserResult = $connection->query($createUserQuery);

if($createUserResult){

    //Get new user created
    $userQuery = "SELECT * FROM user WHERE email = '$userEmail'";
    $getUserResult = $connection->query($userQuery);

    if($getUserResult->num_rows > 0){
        $userRecord = array();
        while($rowFound = $getUserResult->fetch_assoc()){
            $userRecord[] = $rowFound;
        }
        echo json_encode(array("success"=>true, "userData" => $userRecord[0]));
    }
    else {
        echo json_encode(array("success"=>false));
    }
}
else{
    echo json_encode(array("success"=>false));
}
