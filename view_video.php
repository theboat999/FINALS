<?php
session_start();

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

// Query to retrieve videos from the database
$sql = "SELECT id, title, description, file_name, uploaded_by, upload_date FROM videos ORDER BY upload_date DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <div class="container">
        <div class="navigation">
            <h1><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-label="TikTok" role="img" viewBox="0 0 512 512" width="75px" height="75px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"><rect rx="15%" height="512" width="512" fill="#ffffff"/><defs><path id="t" d="M219 200a117 117 0 1 0 101 115v-128a150 150 0 0 0 88 28v-63a88 88 0 0 1-88-88h-64v252a54 54 0 1 1-37-51z" style="mix-blend-mode:multiply"/></defs><use href="#t" fill="#f05" x="18" y="15"/><use href="#t" fill="#0ee"/></g></svg>KitKot</h1>
            <a href="view_video.php"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#000000"><path d="M226.67-186.67h140v-246.66h226.66v246.66h140v-380L480-756.67l-253.33 190v380ZM160-120v-480l320-240 320 240v480H526.67v-246.67h-93.34V-120H160Zm320-352Z"/></svg>Home</a>
            <a href="edit_profile.php"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#000000"><path d="M480-480.67q-66 0-109.67-43.66Q326.67-568 326.67-634t43.66-109.67Q414-787.33 480-787.33t109.67 43.66Q633.33-700 633.33-634t-43.66 109.67Q546-480.67 480-480.67ZM160-160v-100q0-36.67 18.5-64.17T226.67-366q65.33-30.33 127.66-45.5 62.34-15.17 125.67-15.17t125.33 15.5q62 15.5 127.28 45.3 30.54 14.42 48.96 41.81Q800-296.67 800-260v100H160Zm66.67-66.67h506.66V-260q0-14.33-8.16-27-8.17-12.67-20.5-19-60.67-29.67-114.34-41.83Q536.67-360 480-360t-111 12.17Q314.67-335.67 254.67-306q-12.34 6.33-20.17 19-7.83 12.67-7.83 27v33.33ZM480-547.33q37 0 61.83-24.84Q566.67-597 566.67-634t-24.84-61.83Q517-720.67 480-720.67t-61.83 24.84Q393.33-671 393.33-634t24.84 61.83Q443-547.33 480-547.33Zm0-86.67Zm0 407.33Z"/></svg>Profile</a>
            <a href="upload_video.php"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#000000"><path d="M146.67-160q-27 0-46.84-19.83Q80-199.67 80-226.67v-506.66q0-27 19.83-46.84Q119.67-800 146.67-800h506.66q27 0 46.84 19.83Q720-760.33 720-733.33V-530l160-160v420L720-430v203.33q0 27-19.83 46.84Q680.33-160 653.33-160H146.67Zm0-66.67h506.66v-506.66H146.67v506.66Zm0 0v-506.66 506.66Z"/></svg>Upload</a>
            <a href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#000000"><path d="M186.67-120q-27 0-46.84-19.83Q120-159.67 120-186.67v-586.66q0-27 19.83-46.84Q159.67-840 186.67-840h292.66v66.67H186.67v586.66h292.66V-120H186.67Zm470.66-176.67-47-48 102-102H360v-66.66h351l-102-102 47-48 184 184-182.67 182.66Z"/></svg>Logout</a>
        </div>

        <div class="video-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="video-card">
                    <h3 class="video-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p class="video-description"><?php echo htmlspecialchars($row['description']); ?></p>
                    <video class="video-player" controls>
                        <source src="uploads/<?php echo urlencode($row['file_name']); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <p>Uploaded by: <?php echo htmlspecialchars($row['uploaded_by']); ?></p>
                    <p>Uploaded on: <?php echo htmlspecialchars($row['upload_date']); ?></p>
                </div>
                <?php
            }
        } else {
            echo "No videos uploaded.";
        }
        ?>
        </div>
    </div>

    <script>
    // JavaScript for autoplaying videos when they come into view

    // Get all video elements
    const videos = document.querySelectorAll('.video-player');

    // IntersectionObserver to detect when videos enter the viewport
    let observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Play the video when it comes into view
                entry.target.play();
            } else {
                // Pause the video when it goes out of view
                entry.target.pause();
            }
        });
    }, { threshold: 0.5 }); // Adjust threshold as needed

    // Observe each video element
    videos.forEach(video => {
        observer.observe(video);
    });
    </script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
