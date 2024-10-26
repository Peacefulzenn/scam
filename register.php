<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = "varun03"; // Your database password
$dbname = "hospital_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the request
$data = json_decode(file_get_contents("php://input"));

$name = $conn->real_escape_string($data->name);
$email = $conn->real_escape_string($data->email);
$password = password_hash($conn->real_escape_string($data->password), PASSWORD_DEFAULT);
$role = $conn->real_escape_string($data->role);
$specialization = $conn->real_escape_string($data->specialization);

// Insert the user data into the database
$sql = "INSERT INTO users (name, email, password, role, specialization) VALUES ('$name', '$email', '$password', '$role', '$specialization')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Registration successful']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
