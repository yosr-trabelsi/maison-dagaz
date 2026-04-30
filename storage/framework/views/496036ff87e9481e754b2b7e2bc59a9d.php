<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mes Commandes – Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Georgia, serif; background-color: #f5e6e8; color: #7a2e2e; }
        .topbar { background: white; border-bottom: 2px solid #f0d8d8; padding: 12px 28px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(122,46,46,0.07); }
        .topbar .brand { font-size: 18px; letter-spacing: 3px; font-weight: bold; color: #7a2e2e; text-decoration: none; }
        .topbar .nav-right { display: flex; gap: 10px; align-items: center; }
        .nav-btn { padding: 8px 16px; border-radius: 7px; font-family: Georgia; font-size: 13px; cursor: pointer; text-decoration: none; border: none; transition: all 0.2s; display: inline-block; }
        .btn-solid { background: #7a2e2e; color: white; }
        .btn-solid:hover { background: #5a1f1f; }
        .btn-ghost { background: #f5e6e8; color: #7a2e2e; }
        .btn-ghost:hover { background: #e8cece; }

        .page-header { text-align: center; padding: 40px 20px 20px; }
        .page-header h1 { font-size: 30px; letter-spacing: 2px; }

        .container { max-width: 720px; margin: 0 auto; padding: 0 20px 60px; }

        .order-card {
            background: white; border-radius: 14px; padding: 22px 26px;
            margin-bottom: 16px; box-shadow: 0 3px 12px rgba(122,46,46,0.07);
            display: flex; justify-content: space-between; align-items: center;
        }
        .order-info h3 { font-size: 16px; margin-bottom: 6px; }
        .order-info p { font-size: 13px; color: #888; }
        .order-info .price { font-size: 18px; font-weight: bold; color: #7a2e2e; margin-top: 4px; }
        .order-right { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
        .status-badge { padding: 5px 14px; border-radius: 20px; font-size: 13px; display: inline-block; }
        .status-pending   { background: #fef4e7; color: #e67e22; }
        .status-validated { background: #eaf7ea; color: #27ae60; }
        .status-cancelled { background: #fde8e8; color: #c0392b; }
        .details-btn { padding: 8px 16px; background: #7a2e2e; color: white; border-radius: 7px; text-decoration: none; font-size: 13px; transition: background 0.2s; }
        .details-btn:hover { background: #5a1f1f; }
        .back-link { display: block; text-align: center; margin-top: 20px; color: #7a2e2e; font-size: 13px; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
        .empty { text-align: center; padding: 60px 20px; color: #bbb; }
        .empty p { font-size: 16px; margin-top: 12px; }
    </style>
</head>
<body>

<div class="topbar">
    <a href="/" class="brand">MAISON DAGAZ</a>
    <div class="nav-right">
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('cart.index')); ?>" class="nav-btn btn-solid"> Panier</a>
            <span style="font-size:12px;color:#a05050;"> <?php echo e(auth()->user()->name); ?></span>
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin:0;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="nav-btn btn-ghost"> Déconnexion</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<div class="page-header">
    <h1> Mes Commandes</h1>
</div>

<div class="container">

<?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="order-card">
        <div class="order-info">
            <h3>Commande #<?php echo e($order->id); ?></h3>
            <p><?php echo e($order->created_at->format('d/m/Y à H:i')); ?></p>
            <div class="price"><?php echo e(number_format($order->total, 2)); ?> TND</div>
        </div>
        <div class="order-right">
            <?php if($order->status == 'En attente'): ?>
                <span class="status-badge status-pending"> En attente</span>
            <?php elseif($order->status == 'Validée'): ?>
                <span class="status-badge status-validated"> Validée</span>
            <?php else: ?>
                <span class="status-badge status-cancelled">Annulée</span>
            <?php endif; ?>
            <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="details-btn">Voir détails →</a>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty">
        <div style="font-size:48px;"></div>
        <p>Vous n'avez pas encore de commandes.</p>
    </div>
<?php endif; ?>

    <a href="/" class="back-link">← Retour à la boutique</a>
</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\maison-dagaz\maison-dagaz\resources\views/orders.blade.php ENDPATH**/ ?>