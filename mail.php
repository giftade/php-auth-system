<?php

// $to = 'recipients@email-address.com';
// $subject = 'Hello from XAMPP!';
// $message = 'This is a Mailhog test';
// $headers = "From: your@email-address.com\r\n";

// if (mail($to, $subject, $message, $headers)) {
//   echo "SUCCESS";
// } else {
//   echo "ERROR";
// }

function sendVerificationEmail(string $email, string $token): string
{
  $verificationUrl = "http://localhost:8080/includes/verify.php?token=" . urlencode($token);

  $subject = "Verify your email address";
  $message = "Hi,\n\nPlease click the link below to verify your email address:\n$verificationUrl\n\nThank you!";
  $headers = "From: no-reply@gsa.com\r\n";

  // Simple mail() function, configure your SMTP for production
  if (mail($email, $subject, $message, $headers)) {
    return "SUCCESS";
  } else {
    return "ERROR";
  }
}

echo sendVerificationEmail("gsa@gmail.com", "hgdekcjckkc");
