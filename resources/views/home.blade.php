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
        @auth
            <a href="/product/create" class="nav-btn btn-solid"> Ajouter</a>
            {{--  MON SHOP --}}
            <a href="{{ route('vendeur.dashboard') }}" class="nav-btn btn-outline"> Mon Shop</a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="nav-btn btn-solid"> Admin</a>
                <span class="admin-chip">ADMIN</span>
            @endif
        @endauth
    </div>
    <div class="nav-right">
        @auth
            <a href="{{ route('orders.index') }}" class="nav-btn btn-outline"> Commandes</a>
            <a href="{{ route('cart.index') }}"   class="nav-btn btn-solid"> Panier</a>

            {{--  MESSAGES --}}
            <span class="btn-messages">
                <a href="{{ route('chat.index') }}" class="nav-btn btn-outline"> Messages</a>
                <span class="msg-badge" id="msg-badge">0</span>
            </span>

            <span class="user-chip">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="nav-btn btn-logout"> Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}"    class="nav-btn btn-solid">Se connecter</a>
            <a href="{{ route('register') }}" class="nav-btn btn-outline">S'inscrire</a>
        @endauth
    </div>
</nav>


<div class="hero">
    <h1>MAISON DAGAZ</h1>
    <p>Mode élégante · Livraison rapide · Qualité garantie</p>
</div>


<div style="padding: 0 36px;">
    @if(session('success'))
        <div class="flash flash-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash flash-error">{{ session('error') }}</div>
    @endif
</div>


<div class="controls">
    <div>
        <form method="GET" action="/" class="search-form">
            <input type="text" name="search" placeholder=" Rechercher un produit..." value="{{ request('search') }}">
            <button type="submit">Rechercher</button>
        </form>
    </div>
    <div class="filter-bar">
        <a href="/" class="{{ !request('category') ? 'active' : '' }}">Tous</a>
        <a href="/?category=Robes" class="{{ request('category')=='Robes' ? 'active' : '' }}">Robes</a>
        <a href="/?category=Jupes" class="{{ request('category')=='Jupes' ? 'active' : '' }}">Jupes</a>
    </div>
    <form method="GET" action="/">
        <input type="hidden" name="search"   value="{{ request('search') }}">
        <input type="hidden" name="category" value="{{ request('category') }}">
        <select name="sort" class="sort-select" onchange="this.form.submit()">
            <option value="">Trier par</option>
            <option value="price_asc"  {{ request('sort')=='price_asc'  ? 'selected':'' }}>Prix croissant ↑</option>
            <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected':'' }}>Prix décroissant ↓</option>
            <option value="date_desc"  {{ request('sort')=='date_desc'  ? 'selected':'' }}>Plus récents</option>
            <option value="date_asc"   {{ request('sort')=='date_asc'   ? 'selected':'' }}>Plus anciens</option>
        </select>
    </form>
</div>


<div class="products">
    @forelse($products as $product)
    <div class="card">

        @if($product->image)
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
        @else
            <div style="width:100%;height:200px;background:#f5e6e8;display:flex;align-items:center;justify-content:center;font-size:40px;">👗</div>
        @endif

        <div class="card-body">
            <div class="card-category">{{ $product->category }}</div>
            <div class="card-name">{{ $product->name }}</div>
            <div class="card-desc">{{ Str::limit($product->description, 80) }}</div>
            <div class="card-price">{{ number_format($product->price, 2) }} TND</div>

            {{-- VENDEUR CLIQUABLE --}}
            <div class="card-seller">
                Vendeur :
                @if($product->user)
                    <a href="{{ route('vendeur.show', $product->user->id) }}"
                       style="color:#7a2e2e; font-weight:bold; text-decoration:underline;">
                        {{ $product->user->name }}
                    </a>
                @else
                    Inconnu
                @endif
            </div>

            <div class="card-actions">
    @auth

        {{-- 🔒 Empêcher le vendeur d’acheter son propre produit --}}
        @if(auth()->id() != $product->user_id)
            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-buy"> Acheter</button>
            </form>
        @else
            <span class="own-note">C'est votre produit</span>
        @endif

    @endauth

    @auth
        @if(auth()->user()->isAdmin() || $product->user_id == auth()->id())
            <a href="/product/edit/{{ $product->id }}" class="btn-edit"> Modifier</a>
            <form method="POST" action="/product/delete/{{ $product->id }}" style="margin:0;"
                  onsubmit="return confirm('Supprimer ce produit ?')">
                @csrf
                <button type="submit" class="btn-del">Supprimer </button>
            </form>
        @endif
    @endauth
</div>
            
            <div class="review-section">
                <h4> Avis clients ({{ $product->reviews->count() }})</h4>

                @auth
                    @if($product->user_id == auth()->id())
                        <p class="own-note">Vous ne pouvez pas noter votre propre produit.</p>
                    @else
                        <div class="review-form">
                            <form method="POST" action="{{ route('product.review', $product->id) }}">
                                @csrf
                                <select name="rating" required>
                                    <option value=""> Choisir une note</option>
                                    @for($i=1; $i<=5; $i++)
                                        <option value="{{ $i }}">{{ $i }} étoile{{ $i>1?'s':'' }}</option>
                                    @endfor
                                </select>
                                <textarea name="comment" placeholder="Votre commentaire (optionnel)" rows="2"></textarea>
                                <button type="submit">Envoyer l'avis</button>
                            </form>
                        </div>
                    @endif
                @else
                    <p class="login-note"><a href="{{ route('login') }}">Connectez-vous</a> pour laisser un avis.</p>
                @endauth

                @foreach($product->reviews as $review)
                <div class="review-item">
                    <div class="stars">
                        @for($i=1; $i<=5; $i++){{ $i<=$review->rating ? '⭐' : '☆' }}@endfor
                    </div>
                    @if($review->comment)
                        <div style="margin-top:4px; font-size:13px; color:#555;">{{ $review->comment }}</div>
                    @endif
                    @if($review->user)
                        <div class="r-name">— {{ $review->user->name }}</div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @empty
        <div class="empty" style="grid-column: 1/-1;">
            <div style="font-size:48px;"></div>
            <p>Aucun produit trouvé.</p>
        </div>
    @endforelse
</div>

@auth
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
@endauth

{{--  SECTION RECOMMANDATIONS --}}
@if(isset($recommendations) && $recommendations->count() > 0)
<div style="padding: 10px 36px 60px;">
    <div style="text-align:center; margin-bottom: 28px;">
        <div style="font-size:11px; letter-spacing:3px; color:#a05050; margin-bottom:8px;">SÉLECTION POUR VOUS</div>
        <h2 style="font-size:26px; letter-spacing:4px; color:#7a2e2e; margin-bottom:6px;">
            @auth  Recommandés pour {{ auth()->user()->name }}
            @else  Nos coups de cœur
            @endauth
        </h2>
        <p style="font-size:12px; color:#a05050; letter-spacing:1px;">
            @auth Basé sur vos préférences et avis
            @else Les produits les mieux notés par notre communauté
            @endauth
        </p>
        <div style="width:50px; height:2px; background:#7a2e2e; margin:12px auto 0;"></div>
    </div>
    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:24px;">
        @foreach($recommendations as $product)
        @php $avgRating = $product->reviews->avg('rating'); $reviewCount = $product->reviews->count(); @endphp
        <div style="background:white; border-radius:18px; overflow:hidden; box-shadow:0 4px 18px rgba(122,46,46,0.08); border:2px solid #f0d8d8; position:relative;"
             onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 28px rgba(122,46,46,0.13)'"
             onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 18px rgba(122,46,46,0.08)'">
            <div style="position:absolute;top:12px;left:12px;background:#7a2e2e;color:white;font-size:10px;letter-spacing:1.5px;padding:4px 10px;border-radius:20px;z-index:2;">✨ RECOMMANDÉ</div>
            @if($product->image)
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%;height:220px;object-fit:cover;display:block;">
            @else
                <div style="width:100%;height:220px;background:#f5e6e8;display:flex;align-items:center;justify-content:center;font-size:40px;">👗</div>
            @endif
            <div style="padding:16px 18px 20px;">
                <div style="font-size:10px;color:#a05050;text-transform:uppercase;letter-spacing:1.5px;margin-bottom:5px;">{{ $product->category }}</div>
                <div style="font-size:16px;font-weight:bold;color:#7a2e2e;margin-bottom:6px;">{{ $product->name }}</div>
                <div style="display:flex;align-items:center;gap:6px;margin-bottom:10px;">
                    <span style="color:#c8963c;font-size:14px;">@for($i=1;$i<=5;$i++){{ $i<=round($avgRating)?'⭐':'☆' }}@endfor</span>
                    <span style="font-size:12px;color:#a05050;font-weight:bold;">{{ number_format($avgRating,1) }}</span>
                    <span style="font-size:11px;color:#bbb;">({{ $reviewCount }} avis)</span>
                </div>
                <div style="font-size:18px;font-weight:bold;color:#7a2e2e;margin-bottom:14px;">{{ number_format($product->price,2) }} TND</div>
                @auth
                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" style="width:100%;padding:9px;background:#7a2e2e;color:white;border:none;border-radius:9px;font-family:Georgia;font-size:13px;cursor:pointer;"
                        onmouseover="this.style.background='#5a1f1f'" onmouseout="this.style.background='#7a2e2e'">
                         Ajouter au panier
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" style="display:block;text-align:center;padding:9px;background:#f5e6e8;color:#7a2e2e;border:2px solid #7a2e2e;border-radius:9px;font-family:Georgia;font-size:13px;text-decoration:none;">
                    Se connecter pour acheter
                </a>
                @endauth
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

</body>
</html>