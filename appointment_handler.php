<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
// Require PHPMailer files
require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "states";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize POST data
$department = htmlspecialchars($_POST['department']);
$doctor = htmlspecialchars($_POST['doctor']);
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$date = htmlspecialchars($_POST['date']);
$time = htmlspecialchars($_POST['time']);

// Validate inputs
if (empty($department) || empty($doctor) || empty($name) || empty($email) || empty($date) || empty($time)) {
    echo json_encode(["status" => "error", "message" => "All fields are required!"]);
    exit;
}

// Insert data into the database
$sql = "INSERT INTO appointments (department, doctor, name, email, date, time)
VALUES ('$department', '$doctor', '$name', '$email', '$date', '$time')";

if ($conn->query($sql) === TRUE) {
    // Send email confirmation
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'himanshufirke04@gmail.com'; // Replace with your email address
        $mail->Password = 'oded qxnr yylm iokb'; // Replace with your email password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom('your-email@gmail.com', 'Hospital Locator'); // Replace with your sender email
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = "Appointment Confirmation";
        $mail->Body = "Dear $name,<br><br>Your appointment with <b>$doctor</b> in the <b>$department</b> department on <b>$date</b> at <b>$time</b> has been confirmed.<br><br>Thank you!";

        // Send email
        $mail->send();
        echo json_encode(["status" => "success", "message" => "Appointment booked and email sent successfully!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Appointment booked, but email could not be sent. Error: " . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
}


$conn->close();
?>
