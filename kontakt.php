<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if(!empty($_POST["website"])) {
exit;
}

$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$branche = htmlspecialchars($_POST["branche"]);
$message = htmlspecialchars($_POST["message"]);

$mail = new PHPMailer(true);

try {

$mail->isSMTP();

$mail->Host = 'smtp.kasserver.com';

$mail->SMTPAuth = true;

$mail->Username = 'info@ki-wissenssysteme.de';

$mail->Password = 'DEIN_EMAIL_PASSWORT';

$mail->SMTPSecure = 'tls';

$mail->Port = 587;

$mail->setFrom('info@ki-wissenssysteme.de', 'KI Wissenssysteme');

$mail->addAddress('info@ki-wissenssysteme.de');

$mail->addReplyTo($email, $name);

$mail->isHTML(true);

$mail->Subject = 'Neue Anfrage über Webseite';

$mail->Body = "

<h2>Neue Anfrage</h2>

<strong>Name:</strong> $name<br>

<strong>Email:</strong> $email<br>

<strong>Branche:</strong> $branche<br><br>

<strong>Nachricht:</strong><br>

$message

";

$mail->send();

header("Location: danke.html");

exit;

} catch (Exception $e) {

echo "Nachricht konnte nicht gesendet werden.";

}

}
