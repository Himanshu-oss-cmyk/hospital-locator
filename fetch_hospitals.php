<?php
// Database configuration
$host = 'localhost'; // Database host
$user = 'root'; // Database username
$password = ''; // Database password
$dbname = 'states'; // Database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get specialty from the request
$specialty = isset($_GET['specialty']) ? $_GET['specialty'] : '';

// Prepare SQL query to fetch hospitals by specialty
$sql = "SELECT hospital_name, latitude, longitude,address,contact ,medical_type, hospital_images FROM jalgaon WHERE medical_type = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $specialty);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an array to hold the hospital data
$hospitals = [];

// Fetch the hospitals and add them to the array
while ($row = $result->fetch_assoc()) {
    $hospitals[] = $row;
}

// Return the hospitals data as JSON
header('Content-Type: application/json');
echo json_encode($hospitals);

// Close the connection
$stmt->close();
$conn->close();
?>
