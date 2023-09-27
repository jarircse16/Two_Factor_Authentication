<?php
session_start();
require 'db.php'; // Database connection
require 'PHPMailer/PHPMailer.php'; // Include PHPMailer library
require 'PHPMailer/SMTP.php'; // Include SMTP support

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verify email and password against the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            if ($row['is_2fa_enabled']) {
                // Generate a 6-digit code
                $code = rand(100000, 999999);
                echo "Generated Code: " . $code;


                // Send the code via email using SMTP
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'jarir1114@gmail.com'; // Replace with your SMTP username
                $mail->Password = 'y2j@123@y2j'; // Replace with your SMTP password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('admin@news478.com', 'Jarir'); // Replace with your name and email
                $mail->addAddress($email);
                $mail->isHTML(false);
                $mail->Subject = 'Your 2FA Code';
                $mail->Body = 'Your 2FA code is: ' . $code;

                if ($mail->send()) {
                    // Store the code in the session for later verification
                    $_SESSION['2fa_code'] = $code;
                    $_SESSION['user_id'] = $row['id'];
                    header("Location: 2fa_verification.php"); // Redirect to the 2FA verification page
                    exit();
                } else {
                    // Email sending failed
                    $error_message = "Failed to send the 2FA code.";
                }
            } else {
                // 2FA is not enabled, log the user in directly to the dashboard
                $_SESSION['user_id'] = $row['id'];
                header("Location: dashboard.php");
                exit();
            }
        }
    }

    // Authentication failed
    $error_message = "Invalid email or password.";
}
?>

<!-- Display login form -->
<!DOCTYPE html>
<html>
<head>
    <!-- Your HTML header code here -->
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <label>Email:</label>
        <input type="text" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
</body>
</html>
