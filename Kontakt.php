<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Konfigurationsdatei laden (eine Ebene über public_html)
$config = require '../config.php';

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

$mail = new PHPMailer\PHPMailer\PHPMailer(true);

try {

$mail->isSMTP();

$mail->Host = $config["SMTP_HOST"];

$mail->SMTPAuth = true;

$mail->Username = $config["SMTP_USER"];

$mail->Password = $config["SMTP_PASS"];

$mail->SMTPSecure = 'tls';

$mail->Port = $config["SMTP_PORT"];

$mail->setFrom($config["SMTP_USER"], 'KI Wissenssysteme');

$mail->addAddress($config["SMTP_USER"]);

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
