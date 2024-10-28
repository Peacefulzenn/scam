<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = "varun03"; // Your database password
$dbname = "hospital_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

// Get data from the request
$data = json_decode(file_get_contents("php://input"));

$name = $conn->real_escape_string($data->name);
$email = $conn->real_escape_string($data->email);
$password = password_hash($conn->real_escape_string($data->password), PASSWORD_DEFAULT);
$role = $conn->real_escape_string($data->role);
$specialization = $conn->real_escape_string($data->specialization);

// Check if the email already exists
$checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($checkEmailQuery);

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Email already exists.']);
    $conn->close();
    exit;
}

// Insert the user data into the database
$sql = "INSERT INTO users (name, email, password, role, specialization) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssss", $name, $email, $password, $role, $specialization);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Registration successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error preparing the statement: ' . $conn->error]);
}

$conn->close();
?>
