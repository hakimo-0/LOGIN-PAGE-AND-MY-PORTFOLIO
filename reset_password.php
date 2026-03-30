<?php
require 'config.php';

$error   = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code      = trim($_POST['code']      ?? '');
    $password  = trim($_POST['password']  ?? '');
    $password2 = trim($_POST['password2'] ?? '');
    $email     = $_SESSION['reset_email'] ?? '';

    if (empty($email)) {
        $error = 'Session expiree. Recommencez depuis le debut.';
    } elseif (empty($code) || empty($password) || empty($password2)) {
        $error = 'Veuillez remplir tous les champs.';
    } elseif (strlen($password) < 8) {
        $error = 'Le mot de passe doit contenir au moins 8 caracteres.';
    } elseif ($password !== $password2) {
        $error = 'Les mots de passe ne correspondent pas.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND reset_code = ? AND reset_expires > NOW()");
        $stmt->execute([$email, $code]);
        $user = $stmt->fetch();

        if ($user) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_code = NULL, reset_expires = NULL WHERE id = ?");
            $stmt->execute([$hash, $user['id']]);
            unset($_SESSION['reset_email']);
            $success = true;
        } else {
            $error = 'Code invalide ou expire.';
        }
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
    <?php if ($success): ?>
        <div class="alert-success">Mot de passe modifie ! <br><a href="login.php">Se connecter</a></div>
    <?php else: ?>
    <div class="alert-success">sir l db ghatl9a lcod tmak.</div>
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
    <div class="link-row"><a href="forgot_password.php">Renvoyer le code</a></div>
</div>
</body>
</html>