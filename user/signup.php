<?php
/**
 * Insert user data into the database and return a JSON response.
 *
 * @param string $name The user's name.
 * @param string $surname The user's surname.
 * @param string $email The user's email.
 * @param string $password The user's password.
 * @return void
 */
include '../connection.php';

// Get user data from the POST request
$userName = $_POST['name'];
$userSurname = $_POST['surname'];
$userEmail = $_POST['email'];
$userPassword = md5($_POST['password']);

// Prepare the query for inserting user data
$query = "INSERT INTO user SET name = :userName, surname = :userSurname, 
         email = :userEmail, password = :userPassword";
$insertStmt = $pdo->prepare($query);

// Bind the parameters to the prepared statement
$insertStmt->bindParam(':userName', $userName);
$insertStmt->bindParam(':userSurname', $userSurname);
$insertStmt->bindParam(':userEmail', $userEmail);
$insertStmt->bindParam(':userPassword', $userPassword);

// Execute the insert query
$insertStmt->execute();

// Check if the insert was successful
if($insertStmt->rowCount() > 0){
    // Prepare the query to fetch user data
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
    // Return a JSON response with insert failure
    echo json_encode(array("success"=>false));
}
