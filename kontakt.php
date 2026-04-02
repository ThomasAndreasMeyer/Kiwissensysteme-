<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if(!empty($_POST["website"])) {
exit;
}

$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$branche = htmlspecialchars($_POST["branche"]);
$message = htmlspecialchars($_POST["message"]);

$to = "info@ki-wissenssysteme.de";

$subject = "Neue Anfrage über Webseite";

$body = "Neue Anfrage über KI-Wissenssysteme Webseite\n\n";

$body .= "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Branche: $branche\n\n";
$body .= "Nachricht:\n$message";

$headers = "From: info@ki-wissenssysteme.de\r\n";
$headers .= "Reply-To: $email";

mail($to, $subject, $body, $headers);

header("Location: danke.html");
exit;

}

?>
