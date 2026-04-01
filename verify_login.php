<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/send_mail.php';

if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$pending = $_SESSION['login_2fa'] ?? null;
if (!$pending || empty($pending['email'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$message = '';

if (isset($_GET['resend']) && $_GET['resend'] === '1') {
    $newCode = strval(rand(100000, 999999));
    $mailError = '';

    if (sendLoginCode($pending['email'], $newCode, $mailError)) {
        $_SESSION['login_2fa']['code'] = $newCode;
        $_SESSION['login_2fa']['expires'] = time() + (10 * 60);
        $message = 'Un nouveau code de connexion a ete envoye.';
        $pending = $_SESSION['login_2fa'];
    } else {
        $error = $mailError ?: 'Echec d\'envoi du nouveau code.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = preg_replace('/\D+/', '', trim($_POST['code'] ?? ''));

    if ($code === '') {
        $error = 'Entrez le code de verification.';
    } elseif (time() > (int) ($pending['expires'] ?? 0)) {
        $error = 'Code invalide ou expire. Renvoyez un nouveau code.';
    } elseif ($code !== (string) ($pending['code'] ?? '')) {
        $error = 'Code invalide ou expire.';
    } else {
        $_SESSION['user_id'] = (int) $pending['user_id'];
        $_SESSION['username'] = (string) $pending['username'];
        unset($_SESSION['login_2fa']);

        header('Location: dashboard.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verification de connexion</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
    <div class="logo">
        <h2>Verification</h2>
        <p class="sub">Entrez le code envoye a <?= htmlspecialchars($pending['email']) ?></p>
    </div>

    <?php if ($error): ?>
        <div class="alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($message): ?>
        <div class="alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="field">
            <label>Code de verification</label>
            <input type="text" name="code" placeholder="Ex: 483921" maxlength="6" required>
        </div>
        <button type="submit" class="btn">Confirmer la connexion</button>
    </form>

    <div class="link-row"><a href="verify_login.php?resend=1">Renvoyer le code</a></div>
    <div class="link-row"><a href="login.php">Retour a la connexion</a></div>
</div>
</body>
</html>
