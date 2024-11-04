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

// Extract the variables from the data
$name = $conn->real_escape_string($data->name);
$age = $conn->real_escape_string($data->age);
$gender = $conn->real_escape_string($data->gender);
$disease = $conn->real_escape_string($data->disease);
$weight = $conn->real_escape_string($data->weight);
$doctor = $conn->real_escape_string($data->doctor);
$appointmentDate = $conn->real_escape_string($data->appointmentDate);
$appointmentTime = $conn->real_escape_string($data->appointmentTime);

// Insert the patient data into the database
$sql = "INSERT INTO patients (name, age, gender, disease, weight, doctor, appointmentDate, appointmentTime) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sissssss", $name, $age, $gender, $disease, $weight, $doctor, $appointmentDate, $appointmentTime);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Patient added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error preparing the statement: ' . $conn->error]);
}

$conn->close();
?>
