<?php
session_start();

// Get the OTP from the POST request
$otp = $_POST['otp'];

// Retrieve the email and OTP from session
$email = $_SESSION['EMAIL'];
$stored_otp = $_SESSION['OTP'];

// Verify the OTP
if ($otp == $stored_otp) {
    // OTP is correct
    $_SESSION['IS_LOGIN'] = $email;
    echo "yes";
} else {
    // OTP is incorrect
    echo "not_exist";
}
?>
