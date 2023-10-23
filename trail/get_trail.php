<?php
include '../connection.php';

$trailId = $_POST['id'];

$query = "SELECT * FROM trail AS trl 
          JOIN checkpoint AS cp ON cp.trail_id = trl.id 
          WHERE trl.id = :trailId";


$stmt = $pdo->prepare($query);
$stmt->bindParam(':trailId', $trailId);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$trailData = array(
    "id" => $results[0]['id'],
    "title" => $results[0]['title'],
    "length" => $results[0]['length'],
    "duration" => $results[0]['duration'],
    "description" => $results[0]['description'],
    "altitude" => $results[0]['altitude'],
    "checkpoints" => array()
);

foreach ($results as $row) {
    $checkpoint = array(
        "id" => $row['id'],
        "name" => $row['name'],
        "latitude" => $row['latitude'],
        "longitude" => $row['longitude'],
        "trailId" => $row['trail_id'],
    );

    $trailData["checkpoints"][] = $checkpoint;
}

$responseData = array(
    "success" => true,
    "trailData" => $trailData
);

header('Content-Type: application/json');
echo json_encode($responseData);
?>