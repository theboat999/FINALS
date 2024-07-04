<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Database connection details
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "user_data"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["video"])) {
    $file_temp = $_FILES["video"]["tmp_name"];
    $file_name = basename($_FILES["video"]["name"]);
    $file_size = $_FILES["video"]["size"];
    $file_type = $_FILES["video"]["type"];

    // Ensure the uploads directory exists
    $target_dir = __DIR__ . "/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory with full permissions
    }

    $target_file = $target_dir . $file_name;

    // Check file size (max 100MB)
    if ($file_size > 100 * 1024 * 1024) {
        echo "Sorry, your file is too large.";
        exit();
    }

    // Move uploaded file to target directory
    if (move_uploaded_file($file_temp, $target_file)) {
        // Get title and description from form input
        $title = $_POST['title'];  // Example: assuming input field name is 'title'
        $description = $_POST['description'];  // Example: assuming input field name is 'description'
        $uploaded_by = $_SESSION['username'];  // Example: get from session

        // Insert video details into database
        $insert_sql = "INSERT INTO videos (title, description, file_name, uploaded_by) 
                       VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ssss", $title, $description, $file_name, $uploaded_by);

        if ($stmt->execute()) {
            echo "Video uploaded successfully.";
        } else {
            echo "Error uploading video: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>
