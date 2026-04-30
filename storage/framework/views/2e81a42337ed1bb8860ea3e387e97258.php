<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion – Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Georgia, serif;
            background-color: #f5e6e8;
            color: #7a2e2e;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .brand { text-align: center; margin-bottom: 32px; }
        .brand h1 { font-size: 38px; letter-spacing: 5px; margin: 0; }
        .brand p  { font-size: 13px; color: #a05050; margin-top: 8px; letter-spacing: 1px; }
        .card {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 18px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(122,46,46,0.13);
        }
        .card h2 { font-size: 22px; margin-bottom: 28px; text-align: center; font-weight: normal; letter-spacing: 1px; }
        label { display: block; font-size: 12px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 7px; color: #7a2e2e; }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #e8cece;
            border-radius: 9px;
            font-family: Georgia;
            font-size: 14px;
            color: #333;
            margin-bottom: 20px;
            transition: border-color 0.2s;
            background: #fdf9f9;
        }
        input:focus { outline: none; border-color: #7a2e2e; background: white; }
        .remember { display: flex; align-items: center; gap: 8px; margin-bottom: 22px; font-size: 13px; color: #888; }
        .remember input { width: auto; margin: 0; }
        .btn-primary {
            width: 100%;
            padding: 13px;
            background: #7a2e2e;
            color: white;
            border: none;
            border-radius: 9px;
            font-size: 15px;
            font-family: Georgia;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-primary:hover { background: #5a1f1f; }
        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 22px 0; color: #ccc; font-size: 12px;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; border-top: 1px solid #eee;
        }
        .btn-register {
            width: 100%;
            padding: 12px;
            background: transparent;
            color: #7a2e2e;
            border: 2px solid #7a2e2e;
            border-radius: 9px;
            font-size: 15px;
            font-family: Georgia;
            letter-spacing: 1px;
            cursor: pointer;
            text-align: center;
            display: block;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-register:hover { background: #7a2e2e; color: white; }
        .forgot { text-align: center; margin-top: 18px; font-size: 13px; color: #aaa; }
        .forgot a { color: #7a2e2e; text-decoration: none; }
        .forgot a:hover { text-decoration: underline; }
        .alert-error   { background: #fde8e8; color: #c0392b; padding: 11px 15px; border-radius: 9px; font-size: 13px; margin-bottom: 18px; border-left: 4px solid #e74c3c; }
        .alert-success { background: #eaf7ea; color: #27ae60; padding: 11px 15px; border-radius: 9px; font-size: 13px; margin-bottom: 18px; border-left: 4px solid #27ae60; }
    </style>
</head>
<body>

<div class="brand">
    <h1>MAISON DAGAZ</h1>
    <p>Votre boutique de mode élégante</p>
</div>

<div class="card">
    <h2>Connexion</h2>

    <?php if(session('status')): ?>
        <div class="alert-success"><?php echo e(session('status')); ?></div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert-error"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>

        <label for="email">Adresse e-mail</label>
        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <div class="remember">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember" style="margin:0; font-weight:normal; text-transform:none; letter-spacing:0; color:#888;">Se souvenir de moi</label>
        </div>

        <button type="submit" class="btn-primary">Se connecter</button>
    </form>

    <div class="divider">ou</div>

    <a href="<?php echo e(route('register')); ?>" class="btn-register">Créer un compte</a>

    <div class="forgot">
        <a href="<?php echo e(route('password.request')); ?>">Mot de passe oublié ?</a>
    </div>
</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\maison-dagaz\maison-dagaz\resources\views/auth/login.blade.php ENDPATH**/ ?>