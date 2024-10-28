<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$host = "localhost"; 
$dbname = "hospital_db"; 
$username = "root"; 
$password = "varun03"; 

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Validate the data (basic example)
if (!isset($data['name'], $data['age'], $data['gender'], $data['disease'], $data['weight'], $data['doctor'], $data['appointmentDate'], $data['appointmentTime'])) {
    echo json_encode(["status" => "error", "message" => "Invalid input data."]);
    exit;
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO patients (name, age, gender, disease, weight, doctor, appointmentDate, appointmentTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sissssss", $data['name'], $data['age'], $data['gender'], $data['disease'], $data['weight'], $data['doctor'], $data['appointmentDate'], $data['appointmentTime']);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Patient added successfully."]);
} else {
    error_log("Database Error: " . $stmt->error);
    echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
}

// Log incoming data
error_log(print_r($data, true));

// Close connections
$stmt->close();
$conn->close();
?>
