<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = "";     // Default is no password
$dbname = "xoxo outfits";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$name = $first_name . ' ' . $last_name;
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash the password

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $first_name, $last_name, $email, $pass);

// Execute and check result
if ($stmt->execute()) {
    echo "Signup successful. <a href='login.html'>Login here</a>.";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>