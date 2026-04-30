<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Utilisateurs – Admin Maison Dagaz</title>
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
        .container { max-width: 1050px; margin: 40px auto; padding: 0 24px; }
        .page-title { font-size: 26px; margin-bottom: 24px; }
        .flash-success { background:#eaf7ea; color:#27ae60; padding:12px 18px; border-radius:9px; margin-bottom:20px; border-left: 4px solid #27ae60; font-size: 14px; }
        .flash-error   { background:#fde8e8; color:#c0392b; padding:12px 18px; border-radius:9px; margin-bottom:20px; border-left: 4px solid #e74c3c; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 18px rgba(122,46,46,0.06); }
        th { background: #7a2e2e; color: white; padding: 12px 18px; text-align: left; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; font-weight: normal; }
        td { padding: 13px 18px; border-bottom: 1px solid #f9f0f0; font-size: 14px; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fdf9f9; }
        .badge { background: #f5e6e8; color: #7a2e2e; padding: 3px 10px; border-radius: 12px; font-size: 12px; display: inline-block; }
        .btn-delete { background: #fde8e8; color: #c0392b; border: 1px solid #f5c6c6; padding: 6px 14px; border-radius: 7px; cursor: pointer; font-family: Georgia; font-size: 13px; transition: all 0.2s; }
        .btn-delete:hover { background: #e74c3c; color: white; border-color: #e74c3c; }
        .avatar { width: 36px; height: 36px; border-radius: 50%; background: #7a2e2e; color: white; display: flex; align-items: center; justify-content: center; font-size: 16px; }
    </style>
</head>
<body>

<div class="topbar">
    <div class="brand">MAISON DAGAZ <span>ADMIN</span></div>
    <nav>
        <a href="{{ route('admin.dashboard') }}"> Dashboard</a>
        <a href="{{ route('admin.users') }}" class="active"> Utilisateurs</a>
        <a href="{{ route('admin.products') }}"> Produits</a>
        <a href="{{ route('admin.orders') }}"> Commandes</a>
        <a href="/"> Boutique</a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf <button type="submit"> Déconnexion</button>
        </form>
    </nav>
</div>

<div class="container">
    <div class="page-title"> Gestion des utilisateurs <span style="font-size:16px;color:#bbb;">({{ $users->count() }})</span></div>

    @if(session('success'))<div class="flash-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="flash-error">{{ session('error') }}</div>@endif

    <table>
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Email</th>
                <th>Produits</th>
                <th>Inscrit le</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        <span>{{ $user->name }}</span>
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td><span class="badge">{{ $user->products_count }} produit(s)</span></td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.delete', $user->id) }}"
                          onsubmit="return confirm('Supprimer l\'utilisateur {{ addslashes($user->name) }} ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete"> Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:#bbb;padding:40px;">Aucun utilisateur enregistré.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
