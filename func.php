<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "states";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['patsub'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    // Fetch the user from the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    // Check if the user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password2, $row['password'])) {
            // Password is correct, set session and redirect to the homepage
            $_SESSION['email'] = $email;
            $_SESSION['fname'] = $row['fname'];
            echo "Login successful! Welcome, " . $row['fname'];
            header("Location: homepage.php");  // Change to the desired page after login
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }
}

$conn->close();
?>
