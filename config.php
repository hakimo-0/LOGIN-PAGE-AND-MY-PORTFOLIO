<?php
session_start();

$host     = 'localhost';
$dbname   = 'login_page';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connexion echouee: " . $e->getMessage());
}

define('SITE_NAME', 'Login Page');
define('SITE_URL', 'http://localhost/login_page');
define('MAIL_FROM', 'noreply@loginpage.com');
define('MAIL_FROM_NAME', 'Login System');

// SMTP configuration (set credentials in environment variables for security).
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_ENCRYPTION', 'tls');
define('SMTP_USERNAME', getenv('SMTP_USERNAME') ?: 'chineksa@gmail.com');
define('SMTP_PASSWORD', getenv('SMTP_PASSWORD') ?: 'srui jhaw ptti ltcj');
?>
