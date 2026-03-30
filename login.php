<?php
require_once __DIR__ . '/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $error = 'Veuillez remplir tous les champs.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Email ou mot de passe incorrect.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ORMVATF — Connexion</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="left-panel">
  <div class="brand">
    <span class="brand-name">ORMVATF</span>
  </div>
  <div class="left-content">
    <h1>Accès<br><span>Sécurisé.</span></h1>
    <p>Gérez vos projets et votre profil dans un environnement professionnel et protégé.</p>
  </div>
  <div class="stats-container">
    <div class="stat-item"><div class="stat-value"></div><div class="stat-label"></div></div>
    <div class="stat-item"><div class="stat-value"></div><div class="stat-label"></div></div>
    <div class="stat-item"><div class="stat-value"></div><div class="stat-label"></div></div>
  </div>
</div>

<div class="right-panel">
  <div class="login-container">
    <h2>Connexion</h2>
    <p class="subtitle">Heureux de vous revoir sur ORMVATF</p>

    <?php if ($error): ?>
      <div class="alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="form-group">
        <label>Adresse Email</label>
        <input type="email" name="email" placeholder="nom@exemple.com"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
      </div>
      <div class="form-group">
        <label>Mot de passe</label>
        <input type="password" name="password" placeholder="••••••••" required>
      </div>
      
      <div class="options-row">
        <label class="remember-me">
            <input type="checkbox" name="remember"> Se souvenir de moi
        </label>
        <a href="forgot_password.php" class="forgot-link">Oublié ?</a>
      </div>

      <button type="submit" class="btn-primary">Entrer dans l'espace</button>
    </form>

    <div class="ui-divider">ou</div>
    
    <div class="footer-text">
      Nouveau ici ? <a href="register.php">Créer un compte</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>