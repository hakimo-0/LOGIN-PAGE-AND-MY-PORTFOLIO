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
?>