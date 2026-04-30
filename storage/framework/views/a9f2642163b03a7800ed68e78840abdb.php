<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon Shop – Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Georgia, serif; background-color: #f5e6e8; color: #7a2e2e; }

        .top-nav {
            background: white; border-bottom: 2px solid #f0d8d8;
            padding: 12px 28px; display: flex; justify-content: space-between;
            align-items: center; box-shadow: 0 2px 10px rgba(122,46,46,0.07);
            position: sticky; top: 0; z-index: 100;
        }
        .nav-brand { font-size: 20px; letter-spacing: 3px; font-weight: bold; color: #7a2e2e; text-decoration: none; }
        .nav-right { display: flex; gap: 10px; }
        .nav-btn {
            padding: 8px 16px; border-radius: 7px; font-family: Georgia;
            font-size: 13px; cursor: pointer; text-decoration: none;
            border: none; transition: all 0.2s; display: inline-block;
        }
        .btn-solid { background: #7a2e2e; color: white; }
        .btn-solid:hover { background: #5a1f1f; }
        .btn-outline { background: transparent; color: #7a2e2e; border: 2px solid #7a2e2e !important; }
        .btn-outline:hover { background: #7a2e2e; color: white; }

        .page { max-width: 1000px; margin: 0 auto; padding: 36px 24px 60px; }

        .page-title {
            font-size: 28px; letter-spacing: 4px; margin-bottom: 6px;
        }
        .page-sub { font-size: 13px; color: #a05050; letter-spacing: 1px; margin-bottom: 32px; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 36px;
        }
        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 20px 24px;
            border: 1px solid #f0d8d8;
            box-shadow: 0 2px 10px rgba(122,46,46,0.05);
            text-align: center;
        }
        .stat-icon { font-size: 24px; margin-bottom: 8px; }
        .stat-value { font-size: 26px; font-weight: bold; color: #7a2e2e; }
        .stat-label { font-size: 11px; color: #a05050; letter-spacing: 1.5px; margin-top: 4px; }

        .section-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 16px; border-bottom: 1px solid #f0d8d8; padding-bottom: 10px;
        }
        .section-header h2 { font-size: 16px; letter-spacing: 2px; }

        table { width: 100%; border-collapse: collapse; background: white;
            border-radius: 12px; overflow: hidden;
            box-shadow: 0 2px 10px rgba(122,46,46,0.05); margin-bottom: 36px; }
        th { background: #7a2e2e; color: white; padding: 12px 16px;
            font-size: 11px; letter-spacing: 1.5px; text-align: left; }
        td { padding: 12px 16px; font-size: 13px; border-bottom: 1px solid #fdf4f4; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fdf9f9; }

        .badge {
            display: inline-block; padding: 3px 10px; border-radius: 20px;
            font-size: 11px; font-weight: bold; letter-spacing: 0.5px;
        }
        .badge-pending  { background: #fff3cd; color: #856404; }
        .badge-valid    { background: #d1e7dd; color: #0f5132; }
        .badge-cancel   { background: #f8d7da; color: #842029; }

        .empty-table { text-align: center; padding: 30px; color: #bbb; font-size: 13px; }
    </style>
</head>
<body>

<nav class="top-nav">
    <a href="/" class="nav-brand">MAISON DAGAZ</a>
    <div class="nav-right">
        <a href="<?php echo e(route('vendeur.show', auth()->id())); ?>" class="nav-btn btn-outline"> Mon profil public</a>
        <a href="/" class="nav-btn btn-solid">← Boutique</a>
    </div>
</nav>

<div class="page">
    <h1 class="page-title">Mon Shop</h1>
    <p class="page-sub">Tableau de bord de <?php echo e($vendeur->name); ?></p>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value"><?php echo e($totalProducts); ?></div>
            <div class="stat-label">PRODUITS</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?php echo e($totalOrders); ?></div>
            <div class="stat-label">COMMANDES</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?php echo e(number_format($totalVentes, 0)); ?></div>
            <div class="stat-label">TND DE VENTES</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?php echo e($avgRating ? number_format($avgRating, 1) : '—'); ?></div>
            <div class="stat-label">NOTE MOYENNE</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?php echo e($totalReviews); ?></div>
            <div class="stat-label">AVIS REÇUS</div>
        </div>
    </div>

    <div class="section-header">
        <h2>MES PRODUITS</h2>
        <a href="/product/create" class="nav-btn btn-solid" style="font-size:12px; padding:6px 14px;"> Ajouter</a>
    </div>

    <?php if($products->isEmpty()): ?>
        <div class="empty-table">Vous n'avez pas encore de produits.</div>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>PRODUIT</th>
                <th>CATÉGORIE</th>
                <th>PRIX</th>
                <th>AVIS</th>
                <th>NOTE</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><strong><?php echo e($product->name); ?></strong></td>
                <td><?php echo e($product->category); ?></td>
                <td><?php echo e(number_format($product->price, 2)); ?> TND</td>
                <td><?php echo e($product->reviews->count()); ?></td>
                <td>
                    <?php $avg = $product->reviews->avg('rating'); ?>
                    <?php echo e($avg ? number_format($avg, 1) . ' ⭐' : '—'); ?>

                </td>
                <td style="display:flex; gap:6px;">
                    <a href="/product/edit/<?php echo e($product->id); ?>" style="
                        padding:5px 12px; background:#f5e6e8; color:#7a2e2e;
                        border:1px solid #e8cece; border-radius:7px;
                        font-size:12px; text-decoration:none;">Modifier</a>
                    <form method="POST" action="/product/delete/<?php echo e($product->id); ?>"
                          onsubmit="return confirm('Supprimer ?')" style="margin:0;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" style="
                            padding:5px 12px; background:#fde8e8; color:#c0392b;
                            border:1px solid #f5c6c6; border-radius:7px;
                            font-size:12px; cursor:pointer;">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php endif; ?>

    <div class="section-header">
        <h2>MES VENTES RÉCENTES</h2>
    </div>

    <?php if($orderItems->isEmpty()): ?>
        <div class="empty-table">Aucune vente pour l'instant.</div>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>COMMANDE #</th>
                <th>PRODUIT</th>
                <th>QTÉ</th>
                <th>MONTANT</th>
                <th>STATUT</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>#<?php echo e($item->order_id); ?></td>
                <td><?php echo e($item->product->name ?? '—'); ?></td>
                <td><?php echo e($item->quantity); ?></td>
                <td><?php echo e(number_format($item->price * $item->quantity, 2)); ?> TND</td>
                <td>
                    <?php $status = $item->order->status ?? 'En attente'; ?>
                    <span class="badge
                        <?php echo e($status === 'Validée' ? 'badge-valid' : ($status === 'Annulée' ? 'badge-cancel' : 'badge-pending')); ?>">
                        <?php echo e($status); ?>

                    </span>
                </td>
                <td><?php echo e($item->created_at ? $item->created_at->format('d/m/Y') : '—'); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

</body>
</html><?php /**PATH C:\xampp\htdocs\maison-dagaz\maison-dagaz\resources\views/vendeur/dashboard.blade.php ENDPATH**/ ?>