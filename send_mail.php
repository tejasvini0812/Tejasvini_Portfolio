<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Validate form data
    if (!empty($name) && !empty($email) && !empty($phone) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0; // Disable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'tejasvini0812@gmail.com'; // SMTP username
            $mail->Password = 'Teja@0812'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('your-email@example.com'); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'New Contact Form Submission';
            $mail->Body = "Name: $name<br>Email: $email<br>Phone: $phone<br><br>Message:<br>$message";

            $mail->send();
            echo 'success';
        } catch (Exception $e) {
            echo "error: Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'validation_error';
    }
} else {
    echo 'invalid_request';
}
?>