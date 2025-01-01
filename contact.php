<?php
$servername = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "states"; // Replace with your database name

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = $conn->real_escape_string(trim($_POST["txtName"]));
    $email = $conn->real_escape_string(trim($_POST["txtEmail"]));
    $phone = $conn->real_escape_string(trim($_POST["txtPhone"]));
    $message = $conn->real_escape_string(trim($_POST["txtMsg"]));

    // Insert data into the database
    $sql = "INSERT INTO contact (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    // Check if the query was successful
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message sent successfully!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='contact.html';</script>";
    }
}

$conn->close();
?>
