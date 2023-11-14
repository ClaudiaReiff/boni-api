<?php
include '../connection.php';
// Get the trail and user ID from the POST request

$request = json_decode(file_get_contents("php://input"));
$trailId = $request->trailId;
$userId = $request->userId;
// Prepare the query for checking user in
$query = "INSERT INTO user_trails SET trail_id = :trailId, user_id = :userId, hiking_date = CURDATE(), checked_points = 1";
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
}
else{
    // Return a JSON response with success false
    echo json_encode(array("success"=>false));
}
?>