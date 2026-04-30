<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier Produit – Admin</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Georgia, serif; background: #f5e6e8; color: #7a2e2e; min-height: 100vh; }
        .topbar { background: #7a2e2e; color: white; padding: 14px 30px; display: flex; justify-content: space-between; align-items: center; }
        .topbar .brand { font-size: 18px; letter-spacing: 3px; font-weight: bold; }
        .topbar .brand span { font-size: 12px; background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 10px; margin-left: 10px; }
        .topbar nav a { color: white; text-decoration: none; padding: 7px 14px; border-radius: 7px; border: 1px solid rgba(255,255,255,0.3); font-family: Georgia; font-size: 13px; }
        .topbar nav a:hover { background: rgba(255,255,255,0.15); }
        .container { max-width: 540px; margin: 50px auto; padding: 0 20px; }
        .card { background: white; border-radius: 18px; padding: 40px; box-shadow: 0 8px 30px rgba(122,46,46,0.10); }
        h2 { font-size: 22px; margin-bottom: 28px; font-weight: normal; }
        label { display: block; font-size: 12px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 7px; color: #7a2e2e; }
        input, textarea, select { width: 100%; padding: 12px 15px; border: 1.5px solid #e8cece; border-radius: 9px; font-family: Georgia; font-size: 14px; color: #333; margin-bottom: 20px; background: #fdf9f9; transition: border-color 0.2s; }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #7a2e2e; background: white; }
        .btn-primary { width: 100%; padding: 13px; background: #7a2e2e; color: white; border: none; border-radius: 9px; font-size: 15px; font-family: Georgia; letter-spacing: 1px; cursor: pointer; transition: background 0.2s; }
        .btn-primary:hover { background: #5a1f1f; }
        .back-link { display: block; text-align: center; margin-top: 16px; color: #7a2e2e; font-size: 13px; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
        .flash { background:#eaf7ea; color:#27ae60; padding:10px 15px; border-radius:9px; margin-bottom:20px; border-left: 4px solid #27ae60; font-size:13px; }
    </style>
</head>
<body>

<div class="topbar">
    <div class="brand">MAISON DAGAZ <span>ADMIN</span></div>
    <nav>
        <a href="<?php echo e(route('admin.products')); ?>">← Retour aux produits</a>
    </nav>
</div>

<div class="container">
    <div class="card">
        <h2> Modifier le produit</h2>

        <?php if(session('success')): ?><div class="flash"><?php echo e(session('success')); ?></div><?php endif; ?>

        <form method="POST" action="<?php echo e(route('admin.products.update', $product->id)); ?>">
            <?php echo csrf_field(); ?>

            <label>Nom du produit</label>
            <input type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>" required>

            <label>Description</label>
            <textarea name="description" rows="4" required><?php echo e(old('description', $product->description)); ?></textarea>

            <label>Prix (TND)</label>
            <input type="number" name="price" value="<?php echo e(old('price', $product->price)); ?>" step="0.01" min="0" required>

            <label>Catégorie</label>
            <select name="category" required>
                <option value="Robes" <?php echo e($product->category=='Robes' ? 'selected':''); ?>>Robes</option>
                <option value="Jupes" <?php echo e($product->category=='Jupes' ? 'selected':''); ?>>Jupes</option>
            </select>

            <button type="submit" class="btn-primary"> Mettre à jour</button>
        </form>

        <a href="<?php echo e(route('admin.products')); ?>" class="back-link">← Retour sans sauvegarder</a>
    </div>
</div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\maison-dagaz\maison-dagaz\resources\views/admin/edit_product.blade.php ENDPATH**/ ?>