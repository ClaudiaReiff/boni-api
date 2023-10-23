<?php
include '../connection.php';

$userName = $_POST['name'];
$userSurname = $_POST['surname'];
$userEmail = $_POST['email'];
$userPassword = md5($_POST['password']);

$query = 
    "INSERT INTO user SET name = :userName, surname = :userSurname, 
    email = :userEmail, password = :userPassword";

$insertStmt = $pdo->prepare($query);

$insertStmt->bindParam(':userName', $userName);
$insertStmt->bindParam(':userSurname', $userSurname);
$insertStmt->bindParam(':userEmail', $userEmail);
$insertStmt->bindParam(':userPassword', $userPassword);

$insertStmt->execute();

if($insertStmt->rowCount() > 0){
    $userQuery = "SELECT * FROM user WHERE email = ':userEmail'";
    $selectStmt = $pdo->prepare($userQuery);
    $selectStmt->bindParam(':userEmail', $userEmail);
    $selectStmt->execute();
    $getUserResult = $selectStmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($getUserResult) > 0){
        echo json_encode(array("success"=>true, "userData" => $getUserResult[0]));
    } else {
        echo json_encode(array("success"=>false));
    }
}
else{
    echo json_encode(array("success"=>false));
}
