<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panier – Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Georgia, serif; background-color: #f5e6e8; color: #7a2e2e; }
        .topbar { background: white; border-bottom: 2px solid #f0d8d8; padding: 12px 28px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(122,46,46,0.07); }
        .topbar .brand { font-size: 18px; letter-spacing: 3px; font-weight: bold; color: #7a2e2e; text-decoration: none; }
        .topbar .nav-right { display: flex; gap: 10px; align-items: center; }
        .nav-btn { padding: 8px 16px; border-radius: 7px; font-family: Georgia; font-size: 13px; cursor: pointer; text-decoration: none; border: none; transition: all 0.2s; display: inline-block; }
        .btn-solid   { background: #7a2e2e; color: white; }
        .btn-solid:hover { background: #5a1f1f; }
        .btn-outline { background: transparent; color: #7a2e2e; border: 2px solid #7a2e2e !important; }
        .btn-outline:hover { background: #7a2e2e; color: white; }
        .btn-ghost { background: #f5e6e8; color: #7a2e2e; }
        .btn-ghost:hover { background: #e8cece; }

        .page-header { text-align: center; padding: 40px 20px 20px; }
        .page-header h1 { font-size: 30px; letter-spacing: 2px; }

        .container { max-width: 700px; margin: 0 auto; padding: 0 20px 60px; }

        .cart-item {
            background: white; border-radius: 14px; padding: 20px 24px;
            margin-bottom: 16px; box-shadow: 0 3px 12px rgba(122,46,46,0.07);
            display: flex; align-items: center; gap: 20px;
        }
        .item-thumb { width: 70px; height: 70px; object-fit: cover; border-radius: 10px; flex-shrink: 0; }
        .item-thumb-placeholder { width: 70px; height: 70px; background: #f5e6e8; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 28px; flex-shrink: 0; }
        .item-info { flex: 1; }
        .item-info h3 { font-size: 16px; margin-bottom: 4px; }
        .item-info .cat { font-size: 12px; color: #a05050; }
        .item-info .price { font-size: 15px; font-weight: bold; margin-top: 4px; }
        .item-actions { display: flex; flex-direction: column; gap: 8px; align-items: flex-end; }
        .qty-form { display: flex; gap: 6px; align-items: center; }
        .qty-input { width: 60px; padding: 6px; border: 1.5px solid #e8cece; border-radius: 7px; text-align: center; font-family: Georgia; font-size: 14px; }
        .btn-sm { padding: 6px 12px; border-radius: 7px; font-family: Georgia; font-size: 12px; cursor: pointer; border: none; transition: all 0.2s; }
        .btn-update { background: #7a2e2e; color: white; }
        .btn-update:hover { background: #5a1f1f; }
        .btn-remove { background: #fde8e8; color: #c0392b; border: 1px solid #f5c6c6 !important; }
        .btn-remove:hover { background: #e74c3c; color: white; }

        .summary-box { background: white; border-radius: 14px; padding: 28px; box-shadow: 0 3px 12px rgba(122,46,46,0.07); margin-top: 10px; }
        .summary-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 15px; border-bottom: 1px solid #f5e6e8; }
        .summary-row:last-child { border: none; font-size: 18px; font-weight: bold; color: #7a2e2e; }
        .checkout-btn { width: 100%; padding: 14px; background: #7a2e2e; color: white; border: none; border-radius: 10px; font-size: 16px; font-family: Georgia; letter-spacing: 1px; cursor: pointer; margin-top: 18px; transition: background 0.2s; }
        .checkout-btn:hover { background: #5a1f1f; }
        .back-link { display: block; text-align: center; margin-top: 16px; color: #7a2e2e; font-size: 13px; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
        .empty { text-align: center; padding: 60px 20px; color: #bbb; }
        .empty p { font-size: 16px; margin-top: 12px; }
    </style>
</head>
<body>

<div class="topbar">
    <a href="/" class="brand">MAISON DAGAZ</a>
    <div class="nav-right">
        @auth
            <a href="{{ route('orders.index') }}" class="nav-btn btn-outline"> Commandes</a>
            <span style="font-size:12px;color:#a05050;"> {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="nav-btn btn-ghost"> Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-btn btn-solid">Se connecter</a>
        @endauth
    </div>
</div>

<div class="page-header">
    <h1> Mon Panier</h1>
</div>

<div class="container">

@if(count($cart) > 0)

    @foreach($cart as $id => $item)
    <div class="cart-item">
        @if(isset($item['image']) && $item['image'])
            <img src="{{ asset('images/' . $item['image']) }}" class="item-thumb" alt="{{ $item['name'] }}">
        @else
            <div class="item-thumb-placeholder"></div>
        @endif

        <div class="item-info">
            <h3>{{ $item['name'] }}</h3>
            <div class="cat">{{ $item['category'] }}</div>
            <div class="price">{{ number_format($item['price'], 2) }} TND / unité</div>
        </div>

        <div class="item-actions">
            <form method="POST" action="{{ route('cart.update', $id) }}" class="qty-form">
                @csrf
                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="qty-input">
                <button type="submit" class="btn-sm btn-update">🔄</button>
            </form>
            <form method="POST" action="{{ route('cart.remove', $id) }}">
                @csrf
                <button type="submit" class="btn-sm btn-remove"> Retirer</button>
            </form>
        </div>
    </div>
    @endforeach

    <div class="summary-box">
        @foreach($cart as $id => $item)
        <div class="summary-row">
            <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
            <span>{{ number_format($item['price'] * $item['quantity'], 2) }} TND</span>
        </div>
        @endforeach
        <div class="summary-row">
            <span>Total</span>
            <span>{{ number_format($total, 2) }} TND</span>
        </div>

        @auth
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button type="submit" class="checkout-btn"> Valider la commande</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="checkout-btn" style="display:block;text-align:center;text-decoration:none;">
             Se connecter pour commander
        </a>
        @endauth
    </div>

@else
    <div class="empty">
        <div style="font-size:48px;"></div>
        <p>Votre panier est vide.</p>
    </div>
@endif

    <a href="/" class="back-link">← Retour à la boutique</a>
</div>

</body>
</html>
