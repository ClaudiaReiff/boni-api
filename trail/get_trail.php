<?php
include '../connection.php';

$trailId = $_POST['id'];

$trailQuery = "SELECT * FROM trail AS trl 
               JOIN checkpoint AS cp ON cp.trail_id = trl.id WHERE trl.id = '$trailId'";

$result = $connection->query($trailQuery);

$stmt = $pdo->prepare($trailQuery);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$trailData = array(
    "id" => $results[0]['id'],
    "name" => $results[0]['name'],
    "length" => $results[0]['length'],
    "duration" => $results[0]['duration'],
    "description" => $results[0]['description'],
    "altitude" => $results[0]['altitude'],
    "checkpoints" => array()
);

foreach ($results as $row) {
    $checkpoint = array(
        "id" => $row['id'],
        "longitude" => $row['longitude'],
        "latitude" => $row['latitude'],
        "trailId" => $row['trailId'],
        "checkedIn" => $row['checkedIn']
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