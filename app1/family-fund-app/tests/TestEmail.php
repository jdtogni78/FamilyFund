<?php
//phpinfo();
$to = "jdtogni@gmail.com";
$subject = "Hey, I’m Justin!";
$body = "Hello, MailHog!";
$headers = "From: justin@atatus.com" . "\r\n";
mail($to, $subject, $body, $headers);
?>
