<?php
// Database connection parameters
$host = "localhost"; // or your database server
$user = "root"; // your database username
$password = "varun03"; // your database password
$dbname = "hospital_db"; // your database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO doctors (name, gender, specialization, doctor_id, schedule_date, schedule_time) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $data['name'], $data['gender'], $data['specialization'], $data['id'], $data['schedule']['date'], $data['schedule']['time']);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Doctor added successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
}

// Close the connection
$stmt->close();
$conn->close();
?>
