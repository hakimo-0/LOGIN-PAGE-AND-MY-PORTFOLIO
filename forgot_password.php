<?php
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');

    // ── Validation email ─────────────────────────────────────
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Veuillez entrer une adresse email valide.';

    } else {

        // ── Vérification email dans DB ───────────────────────
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            $error = 'Aucun compte associé à cet email.';

        } else {

            // ── Génération du code + expiration ──────────────
            $code    = strval(rand(100000, 999999));
            $expires = date('Y-m-d H:i:s', strtotime('+15 minutes'));

            // ── Sauvegarde dans DB ────────────────────────────
            $stmt = $pdo->prepare("
                UPDATE users
                SET reset_code    = ?,
                    reset_expires = ?
                WHERE email = ?
            ");
            $stmt->execute([$code, $expires, $email]);

            // ── Redirection vers reset_password.php ──────────
            $_SESSION['reset_email'] = $email;
            header('Location: reset_password.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORMVATF — Mot de passe oublié</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="left-panel">
    <div class="brand">
        <span class="brand-name">ORMVATF</span>
    </div>
    <div class="left-content">
        <h1>Mot de passe<br><span>oublié ?</span></h1>
        <p>Entrez votre email pour recevoir un code de réinitialisation.</p>
    </div>
    <div class="stats-container"></div>
</div>

<div class="right-panel">
    <div class="login-container">
        <h2>Récupération</h2>
        <p class="subtitle">Entrez votre email pour continuer.</p>

        <?php if ($error): ?>
            <div class="alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
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
            <a href="login.php">← Retour à la connexion</a>
        </div>
    </div>
</div>

</body>
</html>