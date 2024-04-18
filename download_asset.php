<?php
include 'db.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$zip = $_POST['zip'];
$consentGiven = isset($_POST['marketingOptIn']) ? 1 : 0;

$query = $pdo->prepare("INSERT INTO user_consents (email, single_opt_in, single_opt_in_timestamp, first_name, last_name, phone_number, country, zip_code) 
    VALUES (?, ?, NOW(), ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE 
    single_opt_in=?, single_opt_in_timestamp=NOW(), first_name=?, last_name=?, phone_number=?, country=?, zip_code=?");

$query->execute([$email, $consentGiven, $firstName, $lastName, $phone, $country, $zip, $consentGiven, $firstName, $lastName, $phone, $country, $zip]);

if ($consentGiven) {
    sendDoubleOptInEmail($email);
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="dummy.pdf"');
readfile('dummy.pdf');

function sendDoubleOptInEmail($email) {
    $subject = 'Confirm Your Email Subscription';
    $message = 'Please confirm your subscription by clicking on this link: <a href="http://localhost/double-opt-in/confirm.php?email=' . urlencode($email) . '">Confirm Opt-In</a>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: joshiashwini39@gmail.com' . "\r\n";
    $headers .= 'Reply-To: joshiashwini39@gmail.com' . "\r\n";

    mail($email, $subject, $message, $headers);
}