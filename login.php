<?php
session_start();

// Database connection details
$servername = "localhost"; // or your host
$username = "root"; // your username
$password = ""; // your password, if any
$dbname = "user_data"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to retrieve user data
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Check if the password matches
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Password matches, start a session and redirect to home.php
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } else {
        // Password does not match
        header("Location: index.php?error=invalid");
        exit();
    }
} else {
    // Username does not exist
    header("Location: index.php?error=invalid");
    exit();
}

// Close connection
$conn->close();
?>
