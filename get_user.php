<?php
session_start();
$servername = "localhost";
$username = "root"; // Your database username
$password = "varun03"; // Your database password
$dbname = "hospital_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (isset($_SESSION['user_email'])) {
    $email = $conn->real_escape_string($_SESSION['user_email']);
    
    // Query to fetch user details
    $sql = "SELECT name, email FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['name' => $row['name'], 'email' => $row['email']]);
    } else {
        echo json_encode(['error' => 'No user found']);
    }
} else {
    echo json_encode(['error' => 'User not logged in']);
}

$conn->close();
?>
