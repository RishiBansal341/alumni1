<?php
session_start();

// Include PHPMailer classes
require_once("PHPMailer/src/PHPMailer.php");
require_once("PHPMailer/src/SMTP.php");
require_once("PHPMailer/src/Exception.php");

// Use PHPMailer namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get the email from the POST request
$email = $_POST['email'];

// Generate OTP
$otp = rand(11111, 99999);

// Store OTP and email in session temporarily for verification
$_SESSION['EMAIL'] = $email;
$_SESSION['OTP'] = $otp;

// Send OTP to the entered email
$html = "Your OTP verification code is " . $otp;
if (smtp_mailer($email, 'OTP Verification', $html)) {
    // Return 'yes' if OTP sent successfully
    echo "yes";
} else {
    // Return 'no' if failed to send OTP
    echo "no";
}

// Function to send email
function smtp_mailer($to, $subject, $msg) {
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

    try {
        // Server settings
        $mail->isSMTP();
        $mail->SMTPDebug = 2; // Set to 2 to get detailed error messages
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls'; // Use 'tls' for STARTTLS
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        // Authentication
        $mail->Username = 'kartikayverma53@gmail.com'; // Your SMTP username
        $mail->Password = 'vbehgnjzgxqvhnbq'; // Your SMTP password

        // Sender and recipient settings
        $mail->setFrom('kartikayverma53@gmail.com');
        $mail->addAddress($to);

        // Email content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $msg;

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Handle errors
        error_log("Mailer Error: " . $mail->ErrorInfo); // Log errors instead of echoing
        return false;
    }
}
?>
