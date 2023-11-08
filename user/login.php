<?php
/**
 * Perform user login and return user data if successful.
 *
 * @param string $email The user's email address.
 * @param string $password The user's password.
 * @return string The JSON-encoded response indicating the success status and user data, if login was successful.
 */
include '../connection.php';

// Get the user email and password from the POST request
$userEmail = $_POST['email'];
$userPassword = md5($_POST['password']);

// Prepare the login query
$loginQuery = "SELECT * FROM user WHERE email = :userEmail AND password = :userPassword";
$userStmt = $pdo->prepare($loginQuery);
$userStmt->bindParam(':userEmail', $userEmail);
$userStmt->bindParam(':userPassword', $userPassword);

// Execute the login statement
$userStmt->execute(); 

if($userStmt->rowCount() > 0){
    // Prepare the user query to get user data
    $userQuery = "SELECT * FROM user WHERE email = :userEmail";
    $selectStmt = $pdo->prepare($userQuery);
    $selectStmt->bindParam(':userEmail', $userEmail);
    $selectStmt->execute();

    // Fetch the user data
    $getUserResult = $selectStmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if user data was found
    if(count($getUserResult) > 0){
        // Return a JSON response with success true and user data
        echo json_encode(array("success"=>true, "userData" => $getUserResult[0]));
    } else {
        // Return a JSON response with success false
        echo json_encode(array("success"=>false));
    }
}
else{
    // Return a JSON response with login failure
    echo json_encode(array("success"=>false));
}
