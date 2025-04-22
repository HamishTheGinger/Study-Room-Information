<?php
$config = include(__DIR__ . '/../../config.php'); 

$DATABASE_HOST = $config['DATABASE_HOST'];
$DATABASE_USER = $config['DATABASE_USER'];
$DATABASE_PASS = $config['DATABASE_PASS'];
$DATABASE_NAME = $config['DATABASE_NAME'];

// Create connection
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check if `building_id` is provided
if (isset($_POST['building_id'])) {
    $building_id = intval($_POST['building_id']); // Sanitize input

    $stmt = $con->prepare("SELECT room_id, room_number FROM room WHERE building_id = ? ORDER BY room_number");
    $stmt->bind_param("i", $building_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }

    echo json_encode($rooms);
    $stmt->close();
}
?>