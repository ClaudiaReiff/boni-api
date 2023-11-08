<?php
/**
 * Check if the given email exists in the database.
 *
 * @param string $email The user's email.
 * @return void
 */
include '../connection.php';

// Get the user email from the POST request
$userEmail = $_POST['email'];

// Prepare the query to check if the email exists in the database
$getUserQuery = "SELECT * FROM user WHERE email= :userEmail";
$userStmt = $pdo->prepare($getUserQuery);
$userStmt->bindParam(':userEmail', $userEmail);
$userStmt->execute();

// Check if the email exists in the database
if($userStmt->rowCount() > 0){
    // Return a JSON response indicating that the email is found
    echo json_encode(array("emailFound"=>true));
}
else{
    // Return a JSON response indicating that the email is not found
    echo json_encode(array("emailFound"=>false));
}
