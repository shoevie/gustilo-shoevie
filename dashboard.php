<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Display content if authenticated
$username = $_SESSION['username'];


?>

<script>
    window.onload = function () {
        if (performance.navigation.type === 2) { // Detects "Back" navigation
            location.reload(); // Forces reload from server
        }
    };
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<nav>
        <a href="services.php">Manage Services</a> |
        <a href="reviews.php">Manage Reviews</a> |
        <a href="logout.php">Logout</a>
    </nav>

</body>
</html>

