<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Georgia, serif;
            background-color: #f5e6e8;
            color: #7a2e2e;
        }

        
        .top-nav {
            background: white;
            border-bottom: 2px solid #f0d8d8;
            padding: 12px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(122,46,46,0.07);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-brand { font-size: 20px; letter-spacing: 3px; font-weight: bold; color: #7a2e2e; text-decoration: none; }
        .nav-left, .nav-right { display: flex; gap: 10px; align-items: center; }
        .nav-btn {
            padding: 8px 16px;
            border-radius: 7px;
            font-family: Georgia;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
            display: inline-block;
        }
        .btn-solid   { background: #7a2e2e; color: white; }
        .btn-solid:hover { background: #5a1f1f; }
        .btn-outline { background: transparent; color: #7a2e2e; border: 2px solid #7a2e2e !important; }
        .btn-outline:hover { background: #7a2e2e; color: white; }
        .btn-logout  { background: #f5e6e8; color: #7a2e2e; border: none; }
        .btn-logout:hover { background: #e8cece; }
        .user-chip {
            font-size: 12px; color: #a05050;
            background: #fdf4f4; border: 1px solid #f0d8d8;
            padding: 6px 12px; border-radius: 20px;
        }
        .admin-chip {
            font-size: 11px; background: #7a2e2e; color: #f5e6e8;
            padding: 4px 10px; border-radius: 20px; letter-spacing: 1px;
        }

        
        .btn-messages {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .msg-badge {
            display: none;
            position: absolute;
            top: -7px;
            right: -7px;
            background: #c0392b;
            color: white;
            font-size: 10px;
            font-weight: bold;
            font-family: Georgia;
            border-radius: 50px;
            padding: 2px 6px;
            min-width: 18px;
            text-align: center;
            line-height: 1.4;
            border: 2px solid white;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50%       { transform: scale(1.15); }
        }

        
        .hero {
            text-align: center;
            padding: 50px 20px 24px;
        }
        .hero h1 { font-size: 44px; letter-spacing: 6px; margin-bottom: 8px; }
        .hero p   { font-size: 13px; color: #a05050; letter-spacing: 2px; }

       
        .flash {
            max-width: 800px; margin: 0 auto 10px; padding: 12px 20px;
            border-radius: 9px; font-size: 13px; text-align: center;
        }
        .flash-success { background: #eaf7ea; color: #27ae60; border-left: 4px solid #27ae60; }
        .flash-error   { background: #fde8e8; color: #c0392b; border-left: 4px solid #e74c3c; }

       
        .controls { text-align: center; padding: 10px 20px 20px; }

        .search-form {
            display: inline-flex;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(122,46,46,0.10);
            margin-bottom: 16px;
        }
        .search-form input {
            padding: 11px 20px; border: none; outline: none;
            font-family: Georgia; font-size: 14px; min-width: 260px; background: transparent;
        }
        .search-form button {
            padding: 11px 20px; background: #7a2e2e; color: white;
            border: none; cursor: pointer; font-family: Georgia; font-size: 14px;
        }
        .search-form button:hover { background: #5a1f1f; }

        .filter-bar { margin-bottom: 14px; }
        .filter-bar a {
            margin: 4px 8px; text-decoration: none; color: #7a2e2e;
            font-size: 13px; font-weight: bold; padding: 5px 14px;
            border-radius: 20px; border: 1.5px solid transparent;
            transition: all 0.2s;
        }
        .filter-bar a:hover, .filter-bar a.active {
            border-color: #7a2e2e; background: #7a2e2e; color: white;
        }

        .sort-select {
            padding: 8px 14px; border: 1.5px solid #e8cece; border-radius: 7px;
            font-family: Georgia; color: #7a2e2e; font-size: 13px; background: white; cursor: pointer;
        }

       
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 28px;
            padding: 20px 36px 60px;
        }
        .card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(122,46,46,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(122,46,46,0.13); }
        .card img { width: 100%; height: 240px; object-fit: cover; display: block; }
        .card-body { padding: 16px 18px 20px; }
        .card-category { font-size: 11px; color: #a05050; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 6px; }
        .card-name  { font-size: 17px; margin-bottom: 6px; }
        .card-desc  { font-size: 13px; color: #888; margin-bottom: 10px; line-height: 1.5; }
        .card-price { font-size: 19px; font-weight: bold; color: #7a2e2e; margin-bottom: 6px; }
        .card-seller { font-size: 11px; color: #bbb; margin-bottom: 12px; }
        .card-actions { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 14px; }
        .card-actions a,
        .card-actions button {
            padding: 7px 14px; border-radius: 7px; font-size: 13px;
            font-family: Georgia; cursor: pointer; text-decoration: none;
            border: none; transition: all 0.2s;
        }
        .btn-buy    { background: #7a2e2e; color: white; }
        .btn-buy:hover { background: #5a1f1f; }
        .btn-edit   { background: #f5e6e8; color: #7a2e2e; border: 1px solid #e8cece !important; }
        .btn-edit:hover { background: #e8cece; }
        .btn-del    { background: #fde8e8; color: #c0392b; border: 1px solid #f5c6c6 !important; }
        .btn-del:hover { background: #e74c3c; color: white; }
        .admin-action-tag {
            font-size: 10px; background: #7a2e2e; color: #f5e6e8;
            padding: 2px 8px; border-radius: 4px; display: inline-block; margin-bottom: 8px;
        }

        
        .review-section { border-top: 1px solid #f5e6e8; padding-top: 14px; }
        .review-section h4 { font-size: 13px; margin-bottom: 10px; color: #a05050; }
        .review-form select,
        .review-form textarea {
            width: 100%; padding: 8px 10px; margin-bottom: 8px;
            border: 1.5px solid #e8cece; border-radius: 7px;
            font-family: Georgia; font-size: 13px; color: #333;
        }
        .review-form button {
            padding: 7px 16px; background: #7a2e2e; color: white;
            border: none; border-radius: 7px; cursor: pointer; font-family: Georgia; font-size: 13px;
        }
        .review-form button:hover { background: #5a1f1f; }
        .review-item { margin-top: 8px; font-size: 13px; padding: 8px 10px; background: #fdf9f9; border-radius: 7px; }
        .review-item .stars { color: #c8963c; }
        .review-item .r-name { font-size: 11px; color: #bbb; margin-top: 2px; }
        .own-note { font-size: 12px; color: #a05050; font-style: italic; text-align: center; padding: 8px; }
        .login-note { font-size: 12px; color: #bbb; text-align: center; padding: 8px; }
        .login-note a { color: #7a2e2e; }

        
        .empty { text-align: center; padding: 80px 20px; color: #bbb; }
        .empty p { font-size: 16px; margin-top: 12px; }
    </style>
</head>
<body>


<nav class="top-nav">
    <div class="nav-left">
        <a href="/" class="nav-brand">MAISON DAGAZ</a>
        <?php if(auth()->guard()->check()): ?>
            <a href="/product/create" class="nav-btn btn-solid"> Ajouter</a>
            
            <a href="<?php echo e(route('vendeur.dashboard')); ?>" class="nav-btn btn-outline"> Mon Shop</a>
            <?php if(auth()->user()->isAdmin()): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-btn btn-solid"> Admin</a>
                <span class="admin-chip">ADMIN</span>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="nav-right">
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('orders.index')); ?>" class="nav-btn btn-outline"> Commandes</a>
            <a href="<?php echo e(route('cart.index')); ?>"   class="nav-btn btn-solid"> Panier</a>

            
            <span class="btn-messages">
                <a href="<?php echo e(route('chat.index')); ?>" class="nav-btn btn-outline"> Messages</a>
                <span class="msg-badge" id="msg-badge">0</span>
            </span>

            <span class="user-chip"><?php echo e(auth()->user()->name); ?></span>
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin:0;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="nav-btn btn-logout"> Déconnexion</button>
            </form>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>"    class="nav-btn btn-solid">Se connecter</a>
            <a href="<?php echo e(route('register')); ?>" class="nav-btn btn-outline">S'inscrire</a>
        <?php endif; ?>
    </div>
</nav>


<div class="hero">
    <h1>MAISON DAGAZ</h1>
    <p>Mode élégante · Livraison rapide · Qualité garantie</p>
</div>


<div style="padding: 0 36px;">
    <?php if(session('success')): ?>
        <div class="flash flash-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="flash flash-error"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
</div>


<div class="controls">
    <div>
        <form method="GET" action="/" class="search-form">
            <input type="text" name="search" placeholder=" Rechercher un produit..." value="<?php echo e(request('search')); ?>">
            <button type="submit">Rechercher</button>
        </form>
    </div>
    <div class="filter-bar">
        <a href="/" class="<?php echo e(!request('category') ? 'active' : ''); ?>">Tous</a>
        <a href="/?category=Robes" class="<?php echo e(request('category')=='Robes' ? 'active' : ''); ?>">Robes</a>
        <a href="/?category=Jupes" class="<?php echo e(request('category')=='Jupes' ? 'active' : ''); ?>">Jupes</a>
    </div>
    <form method="GET" action="/">
        <input type="hidden" name="search"   value="<?php echo e(request('search')); ?>">
        <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
        <select name="sort" class="sort-select" onchange="this.form.submit()">
            <option value="">Trier par</option>
            <option value="price_asc"  <?php echo e(request('sort')=='price_asc'  ? 'selected':''); ?>>Prix croissant ↑</option>
            <option value="price_desc" <?php echo e(request('sort')=='price_desc' ? 'selected':''); ?>>Prix décroissant ↓</option>
            <option value="date_desc"  <?php echo e(request('sort')=='date_desc'  ? 'selected':''); ?>>Plus récents</option>
            <option value="date_asc"   <?php echo e(request('sort')=='date_asc'   ? 'selected':''); ?>>Plus anciens</option>
        </select>
    </form>
</div>


<div class="products">
    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="card">

        <?php if($product->image): ?>
            <img src="<?php echo e(asset('images/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>">
        <?php else: ?>
            <div style="width:100%;height:200px;background:#f5e6e8;display:flex;align-items:center;justify-content:center;font-size:40px;">👗</div>
        <?php endif; ?>

        <div class="card-body">
            <div class="card-category"><?php echo e($product->category); ?></div>
            <div class="card-name"><?php echo e($product->name); ?></div>
            <div class="card-desc"><?php echo e(Str::limit($product->description, 80)); ?></div>
            <div class="card-price"><?php echo e(number_format($product->price, 2)); ?> TND</div>

            
            <div class="card-seller">
                Vendeur :
                <?php if($product->user): ?>
                    <a href="<?php echo e(route('vendeur.show', $product->user->id)); ?>"
                       style="color:#7a2e2e; font-weight:bold; text-decoration:underline;">
                        <?php echo e($product->user->name); ?>

                    </a>
                <?php else: ?>
                    Inconnu
                <?php endif; ?>
            </div>

            <div class="card-actions">
    <?php if(auth()->guard()->check()): ?>

        
        <?php if(auth()->id() != $product->user_id): ?>
            <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" style="margin:0;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-buy"> Acheter</button>
            </form>
        <?php else: ?>
            <span class="own-note">C'est votre produit</span>
        <?php endif; ?>

    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->isAdmin() || $product->user_id == auth()->id()): ?>
            <a href="/product/edit/<?php echo e($product->id); ?>" class="btn-edit"> Modifier</a>
            <form method="POST" action="/product/delete/<?php echo e($product->id); ?>" style="margin:0;"
                  onsubmit="return confirm('Supprimer ce produit ?')">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-del">Supprimer </button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</div>
            
            <div class="review-section">
                <h4> Avis clients (<?php echo e($product->reviews->count()); ?>)</h4>

                <?php if(auth()->guard()->check()): ?>
                    <?php if($product->user_id == auth()->id()): ?>
                        <p class="own-note">Vous ne pouvez pas noter votre propre produit.</p>
                    <?php else: ?>
                        <div class="review-form">
                            <form method="POST" action="<?php echo e(route('product.review', $product->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <select name="rating" required>
                                    <option value=""> Choisir une note</option>
                                    <?php for($i=1; $i<=5; $i++): ?>
                                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?> étoile<?php echo e($i>1?'s':''); ?></option>
                                    <?php endfor; ?>
                                </select>
                                <textarea name="comment" placeholder="Votre commentaire (optionnel)" rows="2"></textarea>
                                <button type="submit">Envoyer l'avis</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="login-note"><a href="<?php echo e(route('login')); ?>">Connectez-vous</a> pour laisser un avis.</p>
                <?php endif; ?>

                <?php $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="review-item">
                    <div class="stars">
                        <?php for($i=1; $i<=5; $i++): ?><?php echo e($i<=$review->rating ? '⭐' : '☆'); ?><?php endfor; ?>
                    </div>
                    <?php if($review->comment): ?>
                        <div style="margin-top:4px; font-size:13px; color:#555;"><?php echo e($review->comment); ?></div>
                    <?php endif; ?>
                    <?php if($review->user): ?>
                        <div class="r-name">— <?php echo e($review->user->name); ?></div>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty" style="grid-column: 1/-1;">
            <div style="font-size:48px;"></div>
            <p>Aucun produit trouvé.</p>
        </div>
    <?php endif; ?>
</div>

<?php if(auth()->guard()->check()): ?>
<script>
(function () {
    const badge = document.getElementById('msg-badge');
    if (!badge) return;
    async function checkUnread() {
        try {
            const res  = await fetch('/chat/unread/count', {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();
            if (data.count > 0) {
                badge.textContent   = data.count;
                badge.style.display = 'inline-block';
            } else {
                badge.style.display = 'none';
            }
        } catch (e) {}
    }
    checkUnread();
    setInterval(checkUnread, 10000);
})();
</script>
<?php endif; ?>


<?php if(isset($recommendations) && $recommendations->count() > 0): ?>
<div style="padding: 10px 36px 60px;">
    <div style="text-align:center; margin-bottom: 28px;">
        <div style="font-size:11px; letter-spacing:3px; color:#a05050; margin-bottom:8px;">SÉLECTION POUR VOUS</div>
        <h2 style="font-size:26px; letter-spacing:4px; color:#7a2e2e; margin-bottom:6px;">
            <?php if(auth()->guard()->check()): ?>  Recommandés pour <?php echo e(auth()->user()->name); ?>

            <?php else: ?>  Nos coups de cœur
            <?php endif; ?>
        </h2>
        <p style="font-size:12px; color:#a05050; letter-spacing:1px;">
            <?php if(auth()->guard()->check()): ?> Basé sur vos préférences et avis
            <?php else: ?> Les produits les mieux notés par notre communauté
            <?php endif; ?>
        </p>
        <div style="width:50px; height:2px; background:#7a2e2e; margin:12px auto 0;"></div>
    </div>
    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:24px;">
        <?php $__currentLoopData = $recommendations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $avgRating = $product->reviews->avg('rating'); $reviewCount = $product->reviews->count(); ?>
        <div style="background:white; border-radius:18px; overflow:hidden; box-shadow:0 4px 18px rgba(122,46,46,0.08); border:2px solid #f0d8d8; position:relative;"
             onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 28px rgba(122,46,46,0.13)'"
             onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 18px rgba(122,46,46,0.08)'">
            <div style="position:absolute;top:12px;left:12px;background:#7a2e2e;color:white;font-size:10px;letter-spacing:1.5px;padding:4px 10px;border-radius:20px;z-index:2;">✨ RECOMMANDÉ</div>
            <?php if($product->image): ?>
                <img src="<?php echo e(asset('images/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" style="width:100%;height:220px;object-fit:cover;display:block;">
            <?php else: ?>
                <div style="width:100%;height:220px;background:#f5e6e8;display:flex;align-items:center;justify-content:center;font-size:40px;">👗</div>
            <?php endif; ?>
            <div style="padding:16px 18px 20px;">
                <div style="font-size:10px;color:#a05050;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:5px;"><?php echo e($product->category); ?></div>
                <div style="font-size:16px;font-weight:bold;color:#7a2e2e;margin-bottom:6px;"><?php echo e($product->name); ?></div>
                <div style="display:flex;align-items:center;gap:6px;margin-bottom:10px;">
                    <span style="color:#c8963c;font-size:14px;"><?php for($i=1;$i<=5;$i++): ?><?php echo e($i<=round($avgRating)?'⭐':'☆'); ?><?php endfor; ?></span>
                    <span style="font-size:12px;color:#a05050;font-weight:bold;"><?php echo e(number_format($avgRating,1)); ?></span>
                    <span style="font-size:11px;color:#bbb;">(<?php echo e($reviewCount); ?> avis)</span>
                </div>
                <div style="font-size:18px;font-weight:bold;color:#7a2e2e;margin-bottom:14px;"><?php echo e(number_format($product->price,2)); ?> TND</div>
                <?php if(auth()->guard()->check()): ?>
                <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" style="margin:0;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" style="width:100%;padding:9px;background:#7a2e2e;color:white;border:none;border-radius:9px;font-family:Georgia;font-size:13px;cursor:pointer;"
                        onmouseover="this.style.background='#5a1f1f'" onmouseout="this.style.background='#7a2e2e'">
                         Ajouter au panier
                    </button>
                </form>
                <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" style="display:block;text-align:center;padding:9px;background:#f5e6e8;color:#7a2e2e;border:2px solid #7a2e2e;border-radius:9px;font-family:Georgia;font-size:13px;text-decoration:none;">
                    Se connecter pour acheter
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\maison-dagaz\maison-dagaz\resources\views/home.blade.php ENDPATH**/ ?>