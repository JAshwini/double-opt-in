<?php
include 'db.php';

$email = $_GET['email'];

$query = $pdo->prepare("UPDATE user_consents SET double_opt_in = 1, double_opt_in_timestamp = NOW(), is_compliant = 1 WHERE email = ?");
$query->execute([$email]);

if ($query->rowCount() > 0) {
    shareUserDetailsWithClient($email);
}

echo 'Thank you for confirming your subscription!';

function shareUserDetailsWithClient($email) {
    $clientEmail = "ashwini.j@gomogroup.com";
    $subject = "New Compliant Lead Notification";
    $message = "Dear Client,\n\nYou have a new compliant lead: $email.\n\nBest Regards,\nYour Team";
    $headers = "From: joshiashwini39@gmail.com" . "\r\n" .
               "Reply-To: joshiashwini39@gmail.com" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

	mail($clientEmail, $subject, $message, $headers);
}