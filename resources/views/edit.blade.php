<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier Produit – Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Georgia, serif; background-color: #f5e6e8; color: #7a2e2e; min-height: 100vh; padding-bottom: 60px; }
        .topbar { background: white; border-bottom: 2px solid #f0d8d8; padding: 12px 28px; display: flex; justify-content: space-between; align-items: center; }
        .topbar a { color: #7a2e2e; text-decoration: none; font-size: 14px; padding: 7px 14px; border-radius: 7px; border: 1px solid #e8cece; transition: all 0.2s; }
        .topbar a:hover { background: #7a2e2e; color: white; }
        .topbar .brand { font-size: 18px; letter-spacing: 3px; font-weight: bold; }
        header { text-align: center; padding: 40px 20px 10px; }
        header h1 { font-size: 28px; letter-spacing: 2px; }
        .container { width: 90%; max-width: 500px; margin: 30px auto; background: white; padding: 36px; border-radius: 18px; box-shadow: 0 8px 30px rgba(122,46,46,0.10); }
        label { display: block; font-size: 12px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 7px; color: #7a2e2e; }
        input, textarea, select { width: 100%; padding: 12px 15px; border: 1.5px solid #e8cece; border-radius: 9px; font-family: Georgia; font-size: 14px; color: #333; margin-bottom: 20px; background: #fdf9f9; transition: border-color 0.2s; }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #7a2e2e; background: white; }
        button[type="submit"] { width: 100%; padding: 13px; background: #7a2e2e; color: white; border: none; border-radius: 9px; font-size: 15px; font-family: Georgia; letter-spacing: 1px; cursor: pointer; transition: background 0.2s; }
        button[type="submit"]:hover { background: #5a1f1f; }
        .back { display: block; text-align: center; margin-top: 16px; color: #7a2e2e; font-size: 13px; text-decoration: none; }
        .back:hover { text-decoration: underline; }
        .alert-error { background: #fde8e8; color: #c0392b; padding: 11px 15px; border-radius: 9px; font-size: 13px; margin-bottom: 18px; border-left: 4px solid #e74c3c; }
    </style>
</head>
<body>

<div class="topbar">
    <span class="brand">MAISON DAGAZ</span>
    <a href="/">← Retour à la boutique</a>
</div>

<header>
    <h1> Modifier le produit</h1>
</header>

<div class="container">
    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/product/update/{{ $product->id }}">
        @csrf

        <label>Nom du produit</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" required>

        <label>Description</label>
        <textarea name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>

        <label>Prix (TND)</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>

        <label>Catégorie</label>
        <select name="category" required>
            <option value="Robes" {{ $product->category=='Robes' ? 'selected':'' }}>Robes</option>
            <option value="Jupes" {{ $product->category=='Jupes' ? 'selected':'' }}>Jupes</option>
        </select>

        <button type="submit"> Mettre à jour</button>
    </form>

    <a href="/" class="back">← Retour sans sauvegarder</a>
</div>

</body>
</html>
