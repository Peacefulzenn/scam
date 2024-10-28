<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
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

// Get data from the request
$data = json_decode(file_get_contents("php://input"));

// Check if email and password are set
if (isset($data->email) && isset($data->password)) {
    $email = $conn->real_escape_string($data->email);
    $password = $data->password;

    // Query to fetch user details
    $sql = "SELECT name, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $row['password'])) {
            session_start();
    $_SESSION['user_email'] = $email;
            // Password is correct
            echo json_encode(['success' => true, 'message' => 'Login successful', 'name' => $row['name']]);
        } else {
            // Invalid password
            echo json_encode(['success' => false, 'message' => 'Invalid password']);
        }
    } else {
        // No user found with this email
        echo json_encode(['success' => false, 'message' => 'No user found with this email']);
    }
} else {
    // Invalid input data
    echo json_encode(['success' => false, 'message' => 'Invalid input data']);
}

// Close the database connection
$conn->close();
?>
