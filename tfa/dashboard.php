<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: index.php");
    exit();
}

// Your dashboard content here
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Your HTML header code here -->
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <!-- Dashboard content goes here -->
    <a href="profile.php">View Profile</a>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
