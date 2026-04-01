<?php
require 'config.php';
require 'send_mail.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');

    // Validation email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Veuillez entrer une adresse email valide.';

    } else {

        // Verification email dans DB
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            $error = 'Aucun compte associe a cet email.';

        } else {

            // Generation du code + expiration
            $code = strval(rand(100000, 999999));
            $expiresAt = time() + (15 * 60);

            $mailError = '';
            if (sendResetCode($email, $code, $mailError)) {
                // Stockage temporaire en session (pas en DB)
                $_SESSION['reset_email'] = $email;
                $_SESSION['reset_code'] = $code;
                $_SESSION['reset_expires'] = $expiresAt;
                $_SESSION['reset_codes'] = [
                    ['code' => $code, 'expires' => $expiresAt]
                ];

                header('Location: reset_password.php');
                exit;
            }

            $error = $mailError ?: 'Echec d\'envoi du code par email. Reessayez plus tard.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORMVATF - Mot de passe oublie</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="left-panel">
    <div class="brand">
    <div class="companies">
    <a href="login.php" style="text-decoration: none; color: inherit;">
    <span class="companies-name">ORMVATF</span>
</a> 
   </div>
    </div>
    <div class="left-content">
        <h1>Mot de passe<br><span>oublie ?</span></h1>
        <p>Entrez votre email pour recevoir un code de reinitialisation.</p>
    </div>
    <div class="stats-container"></div>
</div>

<div class="right-panel">
    <div class="login-container">
        <h2>Recuperation</h2>
        <p class="subtitle">Entrez votre email pour continuer.</p>

        <?php if ($error): ?>
            <div class="alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Adresse Email</label>
                <input type="email"
                       name="email"
                       placeholder="nom@exemple.com"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                       required>
            </div>
            <button type="submit" class="btn-primary">Continuer</button>
        </form>

        <div class="ui-divider">ou</div>
        <div class="footer-text">
            <a href="login.php">Retour a la connexion</a>
        </div>
    </div>
</div>

</body>
</html>
