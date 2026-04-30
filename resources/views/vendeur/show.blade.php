<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $vendeur->name }} – Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Georgia, serif; background-color: #f5e6e8; color: #7a2e2e; }

        /* NAV */
        .top-nav {
            background: white; border-bottom: 2px solid #f0d8d8;
            padding: 12px 28px; display: flex; justify-content: space-between;
            align-items: center; box-shadow: 0 2px 10px rgba(122,46,46,0.07);
            position: sticky; top: 0; z-index: 100;
        }
        .nav-brand { font-size: 20px; letter-spacing: 3px; font-weight: bold; color: #7a2e2e; text-decoration: none; }
        .nav-btn {
            padding: 8px 16px; border-radius: 7px; font-family: Georgia;
            font-size: 13px; cursor: pointer; text-decoration: none;
            border: none; transition: all 0.2s; display: inline-block;
        }
        .btn-outline { background: transparent; color: #7a2e2e; border: 2px solid #7a2e2e !important; }
        .btn-outline:hover { background: #7a2e2e; color: white; }

        
        .vendeur-hero {
            background: white;
            border-bottom: 2px solid #f0d8d8;
            padding: 40px 36px;
            display: flex;
            align-items: center;
            gap: 28px;
        }
        .vendeur-avatar {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: #7a2e2e;
            color: white;
            font-size: 2rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-weight: bold;
        }
        .vendeur-info h1 {
            font-size: 28px; letter-spacing: 3px; margin-bottom: 6px;
        }
        .vendeur-stats {
            display: flex; gap: 24px; margin-top: 10px; flex-wrap: wrap;
        }
        .stat {
            text-align: center;
            background: #fdf4f4;
            border: 1px solid #f0d8d8;
            border-radius: 10px;
            padding: 10px 20px;
        }
        .stat-value { font-size: 22px; font-weight: bold; color: #7a2e2e; }
        .stat-label { font-size: 11px; color: #a05050; letter-spacing: 1px; margin-top: 2px; }

        /* GRILLE */
        .section-title {
            font-size: 13px; letter-spacing: 3px; color: #a05050;
            text-align: center; padding: 32px 0 16px;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 24px; padding: 0 36px 60px;
        }
        .card {
            background: white; border-radius: 18px; overflow: hidden;
            box-shadow: 0 4px 18px rgba(122,46,46,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(122,46,46,0.13); }
        .card img { width: 100%; height: 220px; object-fit: cover; display: block; }
        .card-body { padding: 14px 16px 18px; }
        .card-category { font-size: 10px; color: #a05050; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 5px; }
        .card-name { font-size: 16px; margin-bottom: 6px; font-weight: bold; }
        .card-price { font-size: 18px; font-weight: bold; color: #7a2e2e; margin-bottom: 8px; }
        .card-rating { font-size: 12px; color: #c8963c; margin-bottom: 12px; }
        .btn-buy {
            width: 100%; padding: 9px; background: #7a2e2e; color: white;
            border: none; border-radius: 9px; font-family: Georgia;
            font-size: 13px; cursor: pointer; transition: background 0.2s;
        }
        .btn-buy:hover { background: #5a1f1f; }

        .empty { text-align: center; padding: 60px; color: #bbb; font-size: 15px; }
    </style>
</head>
<body>

<nav class="top-nav">
    <a href="/" class="nav-brand">MAISON DAGAZ</a>
    <a href="/" class="nav-btn btn-outline">← Retour à la boutique</a>
</nav>


<div class="vendeur-hero">
    <div class="vendeur-avatar">{{ strtoupper(substr($vendeur->name, 0, 1)) }}</div>
    <div class="vendeur-info">
        <h1>{{ $vendeur->name }}</h1>
        <p style="font-size:13px; color:#a05050; letter-spacing:1px;">Vendeur sur Maison Dagaz</p>
        <div class="vendeur-stats">
            <div class="stat">
                <div class="stat-value">{{ $products->count() }}</div>
                <div class="stat-label">PRODUITS</div>
            </div>
            <div class="stat">
                <div class="stat-value">{{ $totalReviews }}</div>
                <div class="stat-label">AVIS</div>
            </div>
            <div class="stat">
                <div class="stat-value">
                    @if($totalRatings)
                        {{ number_format($totalRatings, 1) }} ⭐
                    @else
                        —
                    @endif
                </div>
                <div class="stat-label">NOTE MOYENNE</div>
            </div>
        </div>
    </div>
</div>


<p class="section-title">PRODUITS DE {{ strtoupper($vendeur->name) }}</p>

@if($products->isEmpty())
    <div class="empty">Ce vendeur n'a pas encore de produits.</div>
@else
<div class="products">
    @foreach($products as $product)
    <div class="card">
        @if($product->image)
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
        @else
            <div style="width:100%;height:220px;background:#f5e6e8;display:flex;align-items:center;justify-content:center;font-size:40px;">👗</div>
        @endif
        <div class="card-body">
            <div class="card-category">{{ $product->category }}</div>
            <div class="card-name">{{ $product->name }}</div>
            <div class="card-rating">
                @php $avg = $product->reviews->avg('rating'); @endphp
                @if($avg)
                    @for($i=1; $i<=5; $i++){{ $i <= round($avg) ? '⭐' : '☆' }}@endfor
                    {{ number_format($avg, 1) }} ({{ $product->reviews->count() }} avis)
                @else
                    Aucun avis
                @endif
            </div>
            <div class="card-price">{{ number_format($product->price, 2) }} TND</div>
            @auth
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-buy"> Ajouter au panier</button>
            </form>
            @endauth
        </div>
    </div>
    @endforeach
</div>
@endif

</body>
</html>