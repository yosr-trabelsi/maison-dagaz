<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un Produit – Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Georgia, serif; background-color: #f5e6e8; color: #7a2e2e; min-height: 100vh; padding-bottom: 60px; }
        .topbar { background: white; border-bottom: 2px solid #f0d8d8; padding: 12px 28px; display: flex; justify-content: space-between; align-items: center; }
        .topbar .brand { font-size: 18px; letter-spacing: 3px; font-weight: bold; color: #7a2e2e; text-decoration: none; }
        .nav-btn { padding: 8px 16px; border-radius: 7px; font-family: Georgia; font-size: 13px; cursor: pointer; text-decoration: none; border: none; transition: all 0.2s; display: inline-block; }
        .btn-outline { background: transparent; color: #7a2e2e; border: 1.5px solid #7a2e2e; }
        .btn-outline:hover { background: #7a2e2e; color: white; }

        .page-header { text-align: center; padding: 40px 20px 10px; }
        .page-header h1 { font-size: 28px; letter-spacing: 2px; }

        .container { width: 90%; max-width: 520px; margin: 30px auto; background: white; padding: 38px; border-radius: 18px; box-shadow: 0 8px 30px rgba(122,46,46,0.10); }
        label { display: block; font-size: 12px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 7px; color: #7a2e2e; }
        input[type="text"], input[type="number"], input[type="file"], textarea, select {
            width: 100%; padding: 12px 15px; border: 1.5px solid #e8cece; border-radius: 9px;
            font-family: Georgia; font-size: 14px; color: #333;
            margin-bottom: 20px; background: #fdf9f9; transition: border-color 0.2s;
        }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #7a2e2e; background: white; }
        input[type="file"] { padding: 10px; cursor: pointer; }
        .btn-submit { width: 100%; padding: 13px; background: #7a2e2e; color: white; border: none; border-radius: 9px; font-size: 15px; font-family: Georgia; letter-spacing: 1px; cursor: pointer; transition: background 0.2s; }
        .btn-submit:hover { background: #5a1f1f; }
        .back-link { display: block; text-align: center; margin-top: 16px; color: #7a2e2e; font-size: 13px; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
        .alert-error { background: #fde8e8; color: #c0392b; padding: 11px 15px; border-radius: 9px; font-size: 13px; margin-bottom: 18px; border-left: 4px solid #e74c3c; }
        .hint { font-size: 12px; color: #bbb; margin-top: -14px; margin-bottom: 18px; }
    </style>
</head>
<body>

<div class="topbar">
    <a href="/" class="brand">MAISON DAGAZ</a>
    <a href="/" class="nav-btn btn-outline">← Retour</a>
</div>

<div class="page-header">
    <h1> Ajouter un Produit</h1>
</div>

<div class="container">
    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ url('/product/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nom du produit</label>
        <input type="text" name="name" placeholder="Ex : Robe de soirée" value="{{ old('name') }}" required>

        <label>Description</label>
        <textarea name="description" placeholder="Décrivez votre produit..." rows="4" required>{{ old('description') }}</textarea>

        <label>Prix (TND)</label>
        <input type="number" name="price" placeholder="0.00" step="0.01" min="0" value="{{ old('price') }}" required>

        <label>Catégorie</label>
        <select name="category" required>
            <option value="">-- Choisir une catégorie --</option>
            <option value="Robes"  {{ old('category')=='Robes' ? 'selected':'' }}>Robes</option>
            <option value="Jupes"  {{ old('category')=='Jupes' ? 'selected':'' }}>Jupes</option>
        </select>

        <label>Image du produit</label>
        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg">
        <p class="hint">Formats acceptés : JPG, PNG. Taille max : 2 Mo. (optionnel)</p>

        <button type="submit" class="btn-submit">Ajouter le produit</button>
    </form>

    <a href="/" class="back-link">← Retour sans ajouter</a>
</div>

</body>
</html>
