<?php
include '../connection.php';

$userId = $_POST['userId'];
$trailId = $_POST['trailId'];

$query = "SELECT * FROM user_trails WHERE user_id = :userId AND 
          trail_id = :trailId AND hiking_date = CURDATE()";

$stmt = $pdo->prepare($trailQuery);
$stmt->bindParam(':userId', $userId);
$stmt->bindParam(':trailId', $trailId);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($results) > 0){
    echo json_encode(array("trailStarted"=>true));
} else {
    echo json_encode(array("trailStarted"=>false));
}