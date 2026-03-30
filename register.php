<?php
require_once __DIR__ . '/config.php';

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username  = trim($_POST['username']  ?? '');
    $email     = trim($_POST['email']     ?? '');
    $password  = trim($_POST['password']  ?? '');
    $password2 = trim($_POST['password2'] ?? '');

    if (empty($username) || empty($email) || empty($password) || empty($password2)) {
        $error = 'Veuillez remplir tous les champs.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Adresse email invalide.';
    } elseif (strlen($password) < 8) {
        $error = 'Le mot de passe doit contenir au moins 8 caractères.';
    } elseif ($password !== $password2) {
        $error = 'Les mots de passe ne correspondent pas.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'Cet email est déjà utilisé.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hash]);
            $success = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
            --input-bg: #2d3748;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --error: #f87171;
            --success: #10b981;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body { 
            font-family: 'Poppins', sans-serif; 
            background: var(--dark-bg); 
            color: var(--text-main); 
            min-height: 100vh; 
            display: flex; 
            align-items: stretch; 
        }

        .left-panel { 
            width: 42%; 
            background: var(--card-bg); 
            display: flex; 
            flex-direction: column; 
            justify-content: space-between; 
            padding: 3.5rem; 
            position: relative; 
            overflow: hidden; 
        }

        .left-panel::before { 
            content: ''; 
            position: absolute; 
            width: 500px; height: 500px; 
            background: radial-gradient(circle, rgba(79,70,229,0.15) 0%, transparent 70%); 
            top: -100px; left: -100px; 
        }

        .companies { z-index: 1; display: flex; align-items: center; gap: 10px; }
        
        .companies-name { font-weight: 700; font-size: 1.6rem; letter-spacing: -0.5px; }

        .left-content { z-index: 1; }
        .left-content h1 { font-size: 2.8rem; font-weight: 700; line-height: 1.1; margin-bottom: 1.2rem; }
        .left-content h1 span { color: var(--primary); }
        .left-content p { color: var(--text-muted); line-height: 1.8; font-size: 1.05rem; }

        .stats-container { display: flex; gap: 2.5rem; z-index: 1; }
        .stat-item .stat-value { font-size: 1.4rem; font-weight: 700; color: var(--primary); }
        .stat-item .stat-label { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1.2px; margin-top: 4px; }

        .right-panel { flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem; overflow-y: auto; }
        .login-container { width: 100%; max-width: 400px; }
        .login-container h2 { font-size: 2.2rem; font-weight: 700; margin-bottom: 0.5rem; letter-spacing: -1px; }
        .subtitle { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 2rem; }

        .form-group { margin-bottom: 1.25rem; }
        .form-group label { 
            display: block; font-size: 0.75rem; font-weight: 600; 
            color: var(--text-muted); text-transform: uppercase; 
            letter-spacing: 1px; margin-bottom: 0.6rem; 
        }

        .form-group input { 
            width: 100%; background: var(--input-bg); 
            border: 1px solid rgba(255,255,255,0.05); 
            border-radius: 12px; padding: 1rem; 
            color: white; outline: none; transition: 0.3s; 
        }

        .form-group input:focus { 
            border-color: var(--primary); 
            box-shadow: 0 0 0 4px rgba(79,70,229,0.1); 
        }

        .btn-primary { 
            width: 100%; padding: 1rem; background: var(--primary); 
            color: white; border: none; border-radius: 12px; 
            font-weight: 600; font-size: 1rem; cursor: pointer; transition: 0.3s; 
        }
        .btn-primary:hover { background: var(--primary-hover); transform: translateY(-1px); }

        .ui-divider { display: flex; align-items: center; gap: 1rem; margin: 1.5rem 0; color: var(--text-muted); font-size: 0.8rem; }
        .ui-divider::before, .ui-divider::after { content: ''; flex: 1; height: 1px; background: rgba(255,255,255,0.1); }

        .footer-text { text-align: center; font-size: 0.9rem; color: var(--text-muted); margin-top: 1.5rem; }
        .footer-text a { color: var(--primary); text-decoration: none; font-weight: 600; }

        .alert-error { 
            background: rgba(239, 68, 68, 0.1); 
            border: 1px solid rgba(239, 68, 68, 0.2); 
            padding: 1rem; border-radius: 12px; 
            color: var(--error); margin-bottom: 1.5rem; font-size: 0.9rem; 
        }
        
        .alert-success { 
            background: rgba(16, 185, 129, 0.1); 
            border: 1px solid rgba(16, 185, 129, 0.2); 
            padding: 1.5rem; border-radius: 12px; 
            color: var(--success); text-align: center; margin-bottom: 1.5rem;
        }

        @media (max-width: 850px) {
            body { flex-direction: column; }
            .left-panel { width: 100%; padding: 2.5rem; min-height: auto; }
            .left-content, .stats-container { display: none; }
        }
    </style>
</head>
<body>

<div class="left-panel">
    <div class="companies">
    <a href="login.php" style="text-decoration: none; color: inherit;">
    <span class="companies-name">ORMVATF</span>
</a>    </div>
    
    <div class="left-content">
        <h1>Créez votre<br><span>compte.</span></h1>
        <p>Rejoignez notre plateforme et commencez à gérer vos projets efficacement.</p>
    </div>

    <div class="stats-container">
        <div class="stat-item">
            <div class="stat-value">2min</div>
            <div class="stat-label">Inscription</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">100%</div>
            <div class="stat-label">Gratuit</div>
        </div>
    </div>
</div>

<div class="right-panel">
    <div class="login-container">
        <h2>Inscription</h2>
        <p class="subtitle">Remplissez vos informations ci-dessous.</p>

        <?php if ($error): ?>
            <div class="alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert-success">
                <strong style="display:block; margin-bottom:5px;">Succès!</strong>
                Compte créé avec succès. Vous pouvez maintenant vous connecter.
                <a href="login.php" class="btn-primary" style="display:block; text-decoration:none; margin-top:15px;">Se connecter</a>
            </div>
        <?php else: ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="username" placeholder="Votre nom" 
                           value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="exemple@mail.com" 
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="Minimum 8 caractères" required>
                </div>

                <div class="form-group">
                    <label>Confirmer</label>
                    <input type="password" name="password2" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-primary">Créer le compte</button>
            </form>
        <?php endif; ?>

        <div class="ui-divider"><span>ou</span></div>

        <div class="footer-text">
            Déjà inscrit ? <a href="login.php">Se connecter</a>
        </div>
    </div>
</div>

</body>
</html>