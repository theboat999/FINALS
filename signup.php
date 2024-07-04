<?php
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
$name = $_POST['name'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash the password for security

// SQL query to insert data into database
$sql = "INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
