<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Commande confirmée – Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Georgia, serif;
            background-color: #f5e6e8;
            color: #7a2e2e;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 60px 50px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(122,46,46,0.12);
            max-width: 440px;
            width: 100%;
        }
        .icon { font-size: 60px; margin-bottom: 20px; }
        h1 { font-size: 26px; margin-bottom: 12px; letter-spacing: 1px; }
        p { font-size: 14px; color: #888; margin-bottom: 32px; line-height: 1.6; }
        .btn {
            display: inline-block; padding: 12px 28px;
            background: #7a2e2e; color: white;
            border-radius: 9px; text-decoration: none;
            font-size: 15px; font-family: Georgia;
            letter-spacing: 1px; transition: background 0.2s;
            margin: 6px;
        }
        .btn:hover { background: #5a1f1f; }
        .btn-outline {
            background: transparent; color: #7a2e2e;
            border: 2px solid #7a2e2e;
        }
        .btn-outline:hover { background: #7a2e2e; color: white; }
    </style>
</head>
<body>
<div class="card">
    <div class="icon"></div>
    <h1>Commande confirmée !</h1>
    <p>Merci pour votre achat. Votre commande a bien été enregistrée et est en cours de traitement.</p>
    <div>
        <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-outline"> Mes commandes</a>
        <a href="/" class="btn"> Continuer mes achats</a>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\maison-dagaz\maison-dagaz\resources\views/confirmation.blade.php ENDPATH**/ ?>