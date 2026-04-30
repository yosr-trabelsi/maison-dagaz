<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Commande #<?php echo e($order->id); ?> – Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Georgia, serif; background-color: #f5e6e8; color: #7a2e2e; }
        .topbar { background: white; border-bottom: 2px solid #f0d8d8; padding: 12px 28px; display: flex; justify-content: space-between; align-items: center; }
        .topbar .brand { font-size: 18px; letter-spacing: 3px; font-weight: bold; color: #7a2e2e; text-decoration: none; }
        .nav-btn { padding: 8px 16px; border-radius: 7px; font-family: Georgia; font-size: 13px; cursor: pointer; text-decoration: none; border: none; transition: all 0.2s; display: inline-block; }
        .btn-solid { background: #7a2e2e; color: white; }
        .btn-solid:hover { background: #5a1f1f; }

        .container { max-width: 680px; margin: 40px auto; padding: 0 20px 60px; }
        .card { background: white; border-radius: 16px; padding: 32px; box-shadow: 0 4px 18px rgba(122,46,46,0.08); }
        h2 { font-size: 22px; margin-bottom: 20px; }
        .meta { display: flex; gap: 20px; margin-bottom: 24px; flex-wrap: wrap; }
        .meta-item { font-size: 14px; }
        .meta-item .label { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #aaa; margin-bottom: 4px; }
        .meta-item .value { font-size: 15px; font-weight: bold; }
        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 13px; }
        .status-pending   { background: #fef4e7; color: #e67e22; }
        .status-validated { background: #eaf7ea; color: #27ae60; }
        .status-cancelled { background: #fde8e8; color: #c0392b; }
        hr { border: none; border-top: 1px solid #f0d8d8; margin: 20px 0; }
        h3 { font-size: 16px; margin-bottom: 14px; }
        .item-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f9f0f0; font-size: 14px; }
        .item-row:last-child { border-bottom: none; }
        .item-name { font-weight: bold; }
        .item-qty  { color: #888; font-size: 13px; }
        .item-price { font-weight: bold; }
        .total-row { display: flex; justify-content: space-between; padding: 16px 0 0; font-size: 17px; font-weight: bold; border-top: 2px solid #f0d8d8; margin-top: 8px; }
        .back-btn { display: inline-block; margin-top: 24px; padding: 10px 20px; background: #7a2e2e; color: white; border-radius: 8px; text-decoration: none; font-size: 14px; }
        .back-btn:hover { background: #5a1f1f; }
    </style>
</head>
<body>

<div class="topbar">
    <a href="/" class="brand">MAISON DAGAZ</a>
    <a href="<?php echo e(route('orders.index')); ?>" class="nav-btn btn-solid">← Mes commandes</a>
</div>

<div class="container">
    <div class="card">
        <h2>Commande #<?php echo e($order->id); ?></h2>

        <div class="meta">
            <div class="meta-item">
                <div class="label">Date</div>
                <div class="value"><?php echo e($order->created_at->format('d/m/Y à H:i')); ?></div>
            </div>
            <div class="meta-item">
                <div class="label">Statut</div>
                <div class="value">
                    <?php if($order->status == 'En attente'): ?>
                        <span class="status-badge status-pending"> En attente</span>
                    <?php elseif($order->status == 'Validée'): ?>
                        <span class="status-badge status-validated"> Validée</span>
                    <?php else: ?>
                        <span class="status-badge status-cancelled"> Annulée</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <hr>

        <h3>Produits commandés</h3>

        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item-row">
            <div>
                <div class="item-name"><?php echo e($item->product ? $item->product->name : 'Produit supprimé'); ?></div>
                <div class="item-qty">Quantité : <?php echo e($item->quantity); ?></div>
            </div>
            <div class="item-price"><?php echo e(number_format($item->price * $item->quantity, 2)); ?> TND</div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="total-row">
            <span>Total</span>
            <span><?php echo e(number_format($order->total, 2)); ?> TND</span>
        </div>

        <a href="<?php echo e(route('orders.index')); ?>" class="back-btn">← Retour aux commandes</a>
    </div>
</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\maison-dagaz\maison-dagaz\resources\views/order_details.blade.php ENDPATH**/ ?>