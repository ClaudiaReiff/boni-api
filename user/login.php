<?php
include '../connection.php';

$userEmail = $_POST['email'];
$userPassword = md5($_POST['password']);

$loginQuery = 
    "SELECT * FROM user WHERE email = '$userEmail' AND password = '$userPassword'";
    
$result = $connection->query($loginQuery);

//allow login
if($result->num_rows > 0){
    $userRecord = array();
    while($rowFound = $result->fetch_assoc()){
        $userRecord[] = $rowFound;
    }
    echo json_encode(array("success"=>true, "userData" => $userRecord[0]));
}
//deny login
else{
    echo json_encode(array("success"=>false));
}