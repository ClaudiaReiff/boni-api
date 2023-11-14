<?php
include '../connection.php';

// Get the trail and user ID from the POST request
$trailId = $_POST['trailId'];
$userId = $_POST['userId'];

// Prepare the query for checking user in
$query = "INSERT INTO user_trails (trail_id, user_id, hiking_date, checked_points) VALUES (:trailId, :userId, CURDATE(), 1)";
$insertStmt = $pdo->prepare($query);

// Bind the parameters to the prepared statement
$insertStmt->bindParam(':trailId', $trailId);
$insertStmt->bindParam(':userId', $userId);

// Execute the insert query
$insertStmt->execute();

// Check if the insert was successful
if($insertStmt->rowCount() > 0){
    // Return a JSON response with success true
    echo json_encode(array("success"=>true));
} else{
    // Return a JSON response with success false
    echo json_encode(array("success"=>false));
}
?>