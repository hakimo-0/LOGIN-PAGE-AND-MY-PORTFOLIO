<?php
require 'config.php';
require 'send_mail.php';

function normalizeCode(string $raw): string
{
    return preg_replace('/\D+/', '', $raw);
}

function getValidResetCodes(): array
{
    $now = time();
    $valid = [];

    if (!empty($_SESSION['reset_codes']) && is_array($_SESSION['reset_codes'])) {
        foreach ($_SESSION['reset_codes'] as $item) {
            $code = isset($item['code']) ? normalizeCode((string) $item['code']) : '';
            $expires = isset($item['expires']) ? (int) $item['expires'] : 0;

            if ($code !== '' && $expires > $now) {
                $valid[] = ['code' => $code, 'expires' => $expires];
            }
        }
    }

    $_SESSION['reset_codes'] = $valid;
    return $valid;
}

function appendResetCode(string $code, int $expires): void
{
    $codes = getValidResetCodes();
    $codes[] = ['code' => $code, 'expires' => $expires];

    // Keep only last 5 valid codes
    if (count($codes) > 5) {
        $codes = array_slice($codes, -5);
    }

    $_SESSION['reset_codes'] = $codes;
    $_SESSION['reset_code'] = $code;
    $_SESSION['reset_expires'] = $expires;
}

function isCodeValid(string $inputCode): bool
{
    $normalizedInput = normalizeCode($inputCode);
    if ($normalizedInput === '') {
        return false;
    }

    $codes = getValidResetCodes();
    foreach ($codes as $item) {
        if ($normalizedInput === (string) $item['code']) {
            return true;
        }
    }

    // Backward compatibility with old single-code session format
    $legacyCode = normalizeCode((string) ($_SESSION['reset_code'] ?? ''));
    $legacyExpires = (int) ($_SESSION['reset_expires'] ?? 0);
    return $legacyCode !== '' && $legacyExpires > time() && $normalizedInput === $legacyCode;
}

$error = '';
$message = '';
$success = false;
$email = $_SESSION['reset_email'] ?? '';

if (isset($_GET['resend']) && $_GET['resend'] === '1' && !$success) {
    if (empty($email)) {
        $error = 'Session expiree. Recommencez depuis le debut.';
    } else {
        $newCode = strval(rand(100000, 999999));
        $expiresAt = time() + (15 * 60);
        $mailError = '';

        if (sendResetCode($email, $newCode, $mailError)) {
            appendResetCode($newCode, $expiresAt);
            $message = 'Un nouveau code a ete envoye a votre email.';
        } else {
            $error = $mailError ?: 'Echec d\'envoi du nouveau code.';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = trim($_POST['code'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $password2 = trim($_POST['password2'] ?? '');

    if (empty($email)) {
        $error = 'Session expiree. Recommencez depuis le debut.';
    } elseif (empty($code) || empty($password) || empty($password2)) {
        $error = 'Veuillez remplir tous les champs.';
    } elseif (strlen($password) < 8) {
        $error = 'Le mot de passe doit contenir au moins 8 caracteres.';
    } elseif ($password !== $password2) {
        $error = 'Les mots de passe ne correspondent pas.';
    } elseif (!isCodeValid($code)) {
        $error = 'Code invalide ou expire.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE email = ?');
        $stmt->execute([$hash, $email]);

        unset($_SESSION['reset_email'], $_SESSION['reset_code'], $_SESSION['reset_expires'], $_SESSION['reset_codes']);
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page - Nouveau mot de passe</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
    <div class="logo">
        <h2>Nouveau mot de passe</h2>
        <p class="sub">Entrez le code recu par email</p>
    </div>
    <?php if ($error): ?>
        <div class="alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($message): ?>
        <div class="alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert-success">Mot de passe modifie ! <br><a href="login.php">Se connecter</a></div>
    <?php else: ?>
    <form method="POST">
        <div class="field">
            <label>Code de verification</label>
            <input type="text" name="code" placeholder="Ex: 483921" maxlength="6">
        </div>
        <div class="field">
            <label>Nouveau mot de passe</label>
            <input type="password" name="password" placeholder="Minimum 8 caracteres">
        </div>
        <div class="field">
            <label>Confirmer</label>
            <input type="password" name="password2" placeholder="........">
        </div>
        <button type="submit" class="btn">Confirmer</button>
    </form>
    <?php endif; ?>
    <div class="link-row"><a href="reset_password.php?resend=1">Renvoyer le code</a></div>
</div>
</body>
</html>
