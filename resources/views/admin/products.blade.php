<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produits – Admin Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Georgia, serif; background: #f5e6e8; color: #7a2e2e; }
        .topbar { background: #7a2e2e; color: white; padding: 14px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.15); }
        .topbar .brand { font-size: 18px; letter-spacing: 3px; font-weight: bold; }
        .topbar .brand span { font-size: 12px; background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 10px; margin-left: 10px; }
        .topbar nav { display: flex; gap: 6px; align-items: center; }
        .topbar nav a, .topbar nav button { color: white; text-decoration: none; padding: 7px 14px; border-radius: 7px; border: 1px solid rgba(255,255,255,0.3); background: transparent; font-family: Georgia; font-size: 13px; cursor: pointer; transition: background 0.2s; }
        .topbar nav a:hover, .topbar nav button:hover { background: rgba(255,255,255,0.15); }
        .topbar nav a.active { background: rgba(255,255,255,0.2); }
        .container { max-width: 1150px; margin: 40px auto; padding: 0 24px; }
        .page-title { font-size: 26px; margin-bottom: 24px; }
        .flash-success { background:#eaf7ea; color:#27ae60; padding:12px 18px; border-radius:9px; margin-bottom:20px; border-left: 4px solid #27ae60; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 18px rgba(122,46,46,0.06); }
        th { background: #7a2e2e; color: white; padding: 12px 18px; text-align: left; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; font-weight: normal; }
        td { padding: 12px 18px; border-bottom: 1px solid #f9f0f0; font-size: 14px; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fdf9f9; }
        .thumb { width: 52px; height: 52px; object-fit: cover; border-radius: 8px; }
        .no-img { width: 52px; height: 52px; background: #f5e6e8; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
        .badge-cat { background: #f5e6e8; color: #7a2e2e; padding: 3px 10px; border-radius: 12px; font-size: 12px; }
        .btn-edit   { background: #f5e6e8; color: #7a2e2e; border: 1px solid #e8cece; padding: 6px 12px; border-radius: 7px; cursor: pointer; font-family: Georgia; font-size: 13px; text-decoration: none; display: inline-block; transition: all 0.2s; }
        .btn-edit:hover { background: #e8cece; }
        .btn-delete { background: #fde8e8; color: #c0392b; border: 1px solid #f5c6c6; padding: 6px 12px; border-radius: 7px; cursor: pointer; font-family: Georgia; font-size: 13px; transition: all 0.2s; }
        .btn-delete:hover { background: #e74c3c; color: white; border-color: #e74c3c; }
        .actions { display: flex; gap: 6px; }
    </style>
</head>
<body>

<div class="topbar">
    <div class="brand">MAISON DAGAZ <span>ADMIN</span></div>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.users') }}"> Utilisateurs</a>
        <a href="{{ route('admin.products') }}" class="active"> Produits</a>
        <a href="{{ route('admin.orders') }}"> Commandes</a>
        <a href="/"> Boutique</a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf <button type="submit"> Déconnexion</button>
        </form>
    </nav>
</div>

<div class="container">
    <div class="page-title">Gestion des produits <span style="font-size:16px;color:#bbb;">({{ $products->count() }})</span></div>

    @if(session('success'))<div class="flash-success">{{ session('success') }}</div>@endif

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Produit</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Vendeur</th>
                <th>Avis</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ asset('images/' . $product->image) }}" class="thumb" alt="{{ $product->name }}">
                    @else
                        <div class="no-img">👗</div>
                    @endif
                </td>
                <td>
                    <strong>{{ $product->name }}</strong><br>
                    <span style="font-size:12px;color:#aaa;">{{ Str::limit($product->description, 50) }}</span>
                </td>
                <td><span class="badge-cat">{{ $product->category }}</span></td>
                <td><strong>{{ number_format($product->price, 2) }} TND</strong></td>
                <td>{{ $product->user ? $product->user->name : '—' }}</td>
                <td>{{ $product->reviews->count() }} ⭐</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit"> Modifier</a>
                        <form method="POST" action="{{ route('admin.products.delete', $product->id) }}"
                              onsubmit="return confirm('Supprimer le produit {{ addslashes($product->name) }} ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;color:#bbb;padding:40px;">Aucun produit.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
