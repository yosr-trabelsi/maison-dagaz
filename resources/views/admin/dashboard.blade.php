<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard – Maison Dagaz</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Georgia, serif; background: #f5e6e8; color: #7a2e2e; }

        .topbar {
            background: #7a2e2e; color: white;
            padding: 14px 30px;
            display: flex; justify-content: space-between; align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        }
        .topbar .brand { font-size: 18px; letter-spacing: 3px; font-weight: bold; }
        .topbar .brand span { font-size: 12px; background: rgba(255,255,255,0.2); padding: 2px 8px; border-radius: 10px; margin-left: 10px; letter-spacing: 1px; }
        .topbar nav { display: flex; gap: 6px; align-items: center; flex-wrap: wrap; }
        .topbar nav a, .topbar nav button {
            color: white; text-decoration: none; padding: 7px 14px;
            border-radius: 7px; border: 1px solid rgba(255,255,255,0.3);
            background: transparent; font-family: Georgia; font-size: 13px; cursor: pointer;
            transition: background 0.2s;
        }
        .topbar nav a:hover, .topbar nav button:hover { background: rgba(255,255,255,0.15); }
        .topbar nav a.active { background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.6); }

        .container { max-width: 1100px; margin: 40px auto; padding: 0 24px; }

        .page-title { font-size: 26px; margin-bottom: 28px; display: flex; align-items: center; gap: 10px; }

        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px; }
        .stat-card {
            background: white; border-radius: 16px; padding: 30px 24px;
            text-align: center; box-shadow: 0 4px 18px rgba(122,46,46,0.08);
            border-top: 4px solid #7a2e2e;
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); }
        .stat-card .icon   { font-size: 32px; margin-bottom: 10px; }
        .stat-card .number { font-size: 44px; font-weight: bold; color: #7a2e2e; line-height: 1; }
        .stat-card .label  { font-size: 13px; color: #aaa; margin-top: 8px; letter-spacing: 1px; text-transform: uppercase; }

        .section-title {
            font-size: 17px; margin-bottom: 16px; padding-bottom: 10px;
            border-bottom: 2px solid #f0d8d8; display: flex; justify-content: space-between; align-items: center;
        }
        .section-title a { font-size: 13px; color: #7a2e2e; text-decoration: none; background: #f5e6e8; padding: 5px 12px; border-radius: 6px; }
        .section-title a:hover { background: #e8cece; }

        table { width: 100%; border-collapse: collapse; background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 18px rgba(122,46,46,0.06); }
        th { background: #7a2e2e; color: white; padding: 12px 18px; text-align: left; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; font-weight: normal; }
        td { padding: 13px 18px; border-bottom: 1px solid #f9f0f0; font-size: 14px; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fdf9f9; }

        .flash { background:#eaf7ea; color:#27ae60; padding:12px 18px; border-radius:9px; margin-bottom:24px; border-left: 4px solid #27ae60; font-size: 14px; }

        .quick-links { display: flex; gap: 14px; margin-bottom: 36px; flex-wrap: wrap; }
        .quick-link {
            flex: 1; min-width: 160px; background: white; border-radius: 12px; padding: 20px;
            text-decoration: none; color: #7a2e2e; text-align: center;
            box-shadow: 0 3px 12px rgba(122,46,46,0.07);
            border: 2px solid transparent; transition: all 0.2s;
        }
        .quick-link:hover { border-color: #7a2e2e; transform: translateY(-2px); }
        .quick-link .ql-icon { font-size: 28px; margin-bottom: 8px; }
        .quick-link .ql-label { font-size: 13px; }
    </style>
</head>
<body>

<div class="topbar">
    <div class="brand">MAISON DAGAZ <span>ADMIN</span></div>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="active"> Dashboard</a>
        <a href="{{ route('admin.users') }}"> Utilisateurs</a>
        <a href="{{ route('admin.products') }}"> Produits</a>
        <a href="{{ route('admin.orders') }}"> Commandes</a>
        <a href="/"> Boutique</a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit"> Déconnexion</button>
        </form>
    </nav>
</div>

<div class="container">
    <div class="page-title"> Tableau de bord</div>

    @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
    @endif

    
    <div class="stats">
        <div class="stat-card">
            <div class="icon"></div>
            <div class="number">{{ $totalUsers }}</div>
            <div class="label">Utilisateurs</div>
        </div>
        <div class="stat-card">
            <div class="icon"></div>
            <div class="number">{{ $totalProducts }}</div>
            <div class="label">Produits</div>
        </div>
        <div class="stat-card">
            <div class="icon"></div>
            <div class="number">{{ $totalOrders }}</div>
            <div class="label">Commandes</div>
        </div>
    </div>

    
    <div class="quick-links">
        <a href="{{ route('admin.users') }}" class="quick-link">
            <div class="ql-icon"></div>
            <div class="ql-label">Gérer les utilisateurs</div>
        </a>
        <a href="{{ route('admin.products') }}" class="quick-link">
            <div class="ql-icon"></div>
            <div class="ql-label">Gérer les produits</div>
        </a>
        <a href="{{ route('admin.orders') }}" class="quick-link">
            <div class="ql-icon"></div>
            <div class="ql-label">Gérer les commandes</div>
        </a>
        <a href="/" class="quick-link">
            <div class="ql-icon"></div>
            <div class="ql-label">Voir la boutique</div>
        </a>
    </div>

    
    <div class="section-title">
        Derniers inscrits
        <a href="{{ route('admin.users') }}">Voir tous →</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Inscrit le</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentUsers as $user)
            <tr>
                <td style="color:#bbb;">{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d/m/Y à H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center; color:#bbb; padding:30px;">Aucun utilisateur.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
