<?php
$to = 'joshiashwini39@gmail.com';
$subject = 'Test Mail from XAMPP';
$message = 'This is a test email sent from XAMPP using Sendmail.';
$headers = 'From: joshiashwini39@gmail.com';

if(mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully!';
} else {
    echo 'Failed to send email. Check your settings.';
}
?>
