<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: index.php");
    exit();
}

// Your profile content here
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Your HTML header code here -->
</head>
<body>
    <h1>User Profile</h1>
    <!-- Profile content goes here -->
    <a href="dashboard.php">Back to Dashboard</a>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
