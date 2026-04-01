<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendResetCode($email, $code, &$errorMessage = '')
{
    $mail = new PHPMailer(true);

    try {
        $usingPlaceholders =
            stripos((string) SMTP_USERNAME, 'yourgmail') !== false ||
            stripos((string) SMTP_PASSWORD, 'YOUR_GMAIL_APP_PASSWORD') !== false;

        if (empty(SMTP_USERNAME) || empty(SMTP_PASSWORD) || $usingPlaceholders) {
            $errorMessage = 'SMTP non configure: remplacez SMTP_USERNAME et SMTP_PASSWORD dans config.php.';
            return false;
        }

        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';

        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;

        $mail->SMTPSecure = SMTP_ENCRYPTION;
        $mail->Port = SMTP_PORT;

        $mail->setFrom(SMTP_USERNAME, MAIL_FROM_NAME);
        $mail->addAddress($email);

        $mail->Subject = 'Code de reinitialisation du mot de passe By Hakim';
        $mail->Body = "Bonjour,\n\nVotre code de verification est : $code\nCe code expire dans 15 minutes.\n\nSi vous n'avez pas demande cette reinitialisation, ignorez ce message.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        $raw = (string) $e->getMessage();
        $lower = strtolower($raw);
        error_log('sendResetCode failed: ' . $raw);

        if (str_contains($lower, 'username and password not accepted') || str_contains($lower, 'could not authenticate')) {
            $errorMessage = 'Authentification Gmail refusee: activez 2-Step Verification puis utilisez App Password.';
        } elseif (str_contains($lower, 'smtp connect() failed') || str_contains($lower, 'connection failed')) {
            $errorMessage = 'Connexion SMTP echouee: verifiez internet, host smtp.gmail.com et port 587.';
        } else {
            $errorMessage = 'Echec d\'envoi email SMTP: ' . $raw;
        }
        return false;
    }
}
