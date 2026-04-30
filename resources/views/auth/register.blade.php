<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription – Maison Dagaz</title>
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
        input[type="text"],
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
        .login-link { text-align: center; margin-top: 20px; font-size: 13px; color: #aaa; }
        .login-link a { color: #7a2e2e; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }
        .alert-error { background: #fde8e8; color: #c0392b; padding: 11px 15px; border-radius: 9px; font-size: 13px; margin-bottom: 18px; border-left: 4px solid #e74c3c; }
    </style>
</head>
<body>

<div class="brand">
    <h1>MAISON DAGAZ</h1>
    <p>Créez votre compte</p>
</div>

<div class="card">
    <h2>Inscription</h2>

    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">Nom complet</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>

        <label for="email">Adresse e-mail</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Confirmer le mot de passe</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button type="submit" class="btn-primary">S'inscrire</button>
    </form>

    <div class="login-link">
        Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
    </div>
</div>

</body>
</html>
