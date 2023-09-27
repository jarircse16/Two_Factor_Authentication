<?php
session_start();

// Check if the 2FA code is set in the session
if (!isset($_SESSION['2fa_code'])) {
    header("Location: index.php");
    exit();
}

// Initialize an error message variable
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredCode = $_POST['2fa_code'];
    $expectedCode = $_SESSION['2fa_code'];

    if ($enteredCode == $expectedCode) {
        // 2FA code is correct, log the user in and redirect to the dashboard
        $_SESSION['authenticated'] = true;
        unset($_SESSION['2fa_code']);
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Invalid 2FA code.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Your HTML header code here -->
</head>
<body>
    <h1>2FA Verification</h1>
    <form method="post">
        <label>Enter 2FA Code:</label>
        <input type="text" name="2fa_code" required><br>
        <button type="submit">Verify</button>
    </form>
    <?php if (!empty($error_message)) echo "<p>$error_message</p>"; ?>
</body>
</html>
