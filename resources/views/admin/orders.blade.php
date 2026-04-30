<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Commandes – Admin Maison Dagaz</title>
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
        .container { max-width: 1100px; margin: 40px auto; padding: 0 24px; }
        .page-title { font-size: 26px; margin-bottom: 24px; }
        .flash-success { background:#eaf7ea; color:#27ae60; padding:12px 18px; border-radius:9px; margin-bottom:20px; border-left: 4px solid #27ae60; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 18px rgba(122,46,46,0.06); }
        th { background: #7a2e2e; color: white; padding: 12px 18px; text-align: left; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; font-weight: normal; }
        td { padding: 13px 18px; border-bottom: 1px solid #f9f0f0; font-size: 14px; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fdf9f9; }
        .status-pending   { color: #e67e22; background: #fef4e7; padding: 3px 10px; border-radius: 12px; font-size: 12px; display:inline-block; }
        .status-validated { color: #27ae60; background: #eaf7ea; padding: 3px 10px; border-radius: 12px; font-size: 12px; display:inline-block; }
        .status-cancelled { color: #c0392b; background: #fde8e8; padding: 3px 10px; border-radius: 12px; font-size: 12px; display:inline-block; }
        .status-form { display: flex; gap: 8px; align-items: center; }
        select.status-select { padding: 6px 10px; border: 1.5px solid #e8cece; border-radius: 7px; font-family: Georgia; font-size: 13px; color: #333; background: white; cursor: pointer; margin-bottom: 0; }
        .btn-update { background: #7a2e2e; color: white; border: none; padding: 7px 14px; border-radius: 7px; cursor: pointer; font-family: Georgia; font-size: 13px; transition: background 0.2s; }
        .btn-update:hover { background: #5a1f1f; }
    </style>
</head>
<body>

<div class="topbar">
    <div class="brand">MAISON DAGAZ <span>ADMIN</span></div>
    <nav>
        <a href="{{ route('admin.dashboard') }}"> Dashboard</a>
        <a href="{{ route('admin.users') }}"> Utilisateurs</a>
        <a href="{{ route('admin.products') }}"> Produits</a>
        <a href="{{ route('admin.orders') }}" class="active"> Commandes</a>
        <a href="/"> Boutique</a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf <button type="submit"> Déconnexion</button>
        </form>
    </nav>
</div>

<div class="container">
    <div class="page-title"> Gestion des commandes <span style="font-size:16px;color:#bbb;">({{ $orders->count() }})</span></div>

    @if(session('success'))<div class="flash-success">{{ session('success') }}</div>@endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Total</th>
                <th>Statut actuel</th>
                <th>Date</th>
                <th>Modifier le statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td style="color:#bbb;">{{ $order->id }}</td>
                <td>{{ $order->user ? $order->user->name : 'Invité' }}</td>
                <td><strong>{{ number_format($order->total, 2) }} TND</strong></td>
                <td>
                    @if($order->status == 'En attente')
                        <span class="status-pending"> En attente</span>
                    @elseif($order->status == 'Validée')
                        <span class="status-validated">Validée</span>
                    @else
                        <span class="status-cancelled"> Annulée</span>
                    @endif
                </td>
                <td>{{ $order->created_at->format('d/m/Y à H:i') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="status-form">
                        @csrf
                        <select name="status" class="status-select">
                            <option value="En attente" {{ $order->status=='En attente' ? 'selected':'' }}> En attente</option>
                            <option value="Validée"    {{ $order->status=='Validée'    ? 'selected':'' }}>Validée</option>
                            <option value="Annulée"    {{ $order->status=='Annulée'    ? 'selected':'' }}> Annulée</option>
                        </select>
                        <button type="submit" class="btn-update">Mettre à jour</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#bbb;padding:40px;">Aucune commande.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
