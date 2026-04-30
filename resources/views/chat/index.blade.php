<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Messages – Maison Dagaz</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --rose:    #f5ece8;
            --rose-md: #e8d5cc;
            --bordeaux:#7a2535;
            --bordeaux-dark: #5c1a26;
            --text:    #2c1810;
            --muted:   #9e8880;
            --white:   #fffaf8;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Jost', sans-serif;
            background: var(--rose);
            color: var(--text);
            min-height: 100vh;
        }

        
        .navbar {
            background: var(--white);
            border-bottom: 1px solid var(--rose-md);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 600;
            letter-spacing: .15em;
            color: var(--bordeaux);
            text-decoration: none;
        }
        .navbar-back {
            display: flex;
            align-items: center;
            gap: .5rem;
            color: var(--bordeaux);
            text-decoration: none;
            font-size: .85rem;
            font-weight: 500;
            letter-spacing: .05em;
            transition: opacity .2s;
        }
        .navbar-back:hover { opacity: .7; }

        
        .page {
            max-width: 860px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
        }

        .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 600;
            color: var(--bordeaux);
            letter-spacing: .05em;
            margin-bottom: .4rem;
        }
        .page-sub {
            color: var(--muted);
            font-size: .85rem;
            font-weight: 300;
            margin-bottom: 2rem;
        }

        
        .new-conv {
            background: var(--white);
            border: 1px solid var(--rose-md);
            border-radius: 12px;
            padding: 1.2rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .new-conv label {
            font-size: .8rem;
            font-weight: 500;
            letter-spacing: .08em;
            color: var(--muted);
            white-space: nowrap;
        }
        .new-conv select {
            flex: 1;
            border: 1px solid var(--rose-md);
            border-radius: 8px;
            padding: .55rem 1rem;
            font-family: 'Jost', sans-serif;
            font-size: .9rem;
            color: var(--text);
            background: var(--rose);
            outline: none;
            cursor: pointer;
        }
        .new-conv select:focus { border-color: var(--bordeaux); }
        .btn-start {
            background: var(--bordeaux);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: .55rem 1.4rem;
            font-family: 'Jost', sans-serif;
            font-size: .85rem;
            font-weight: 500;
            letter-spacing: .06em;
            cursor: pointer;
            white-space: nowrap;
            transition: background .2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-start:hover { background: var(--bordeaux-dark); }

        
        .contact-list {
            display: flex;
            flex-direction: column;
            gap: .75rem;
        }

        .contact-card {
            background: var(--white);
            border: 1px solid var(--rose-md);
            border-radius: 12px;
            padding: 1.1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: var(--text);
            transition: border-color .2s, box-shadow .2s, transform .15s;
        }
        .contact-card:hover {
            border-color: var(--bordeaux);
            box-shadow: 0 4px 16px rgba(122,37,53,.08);
            transform: translateY(-1px);
        }

        .avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: var(--bordeaux);
            color: #fff;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-info { flex: 1; min-width: 0; }
        .contact-name {
            font-weight: 500;
            font-size: .95rem;
            margin-bottom: .2rem;
        }
        .contact-preview {
            font-size: .8rem;
            color: var(--muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .contact-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: .4rem;
            flex-shrink: 0;
        }
        .contact-time {
            font-size: .75rem;
            color: var(--muted);
        }
        .badge {
            background: var(--bordeaux);
            color: #fff;
            font-size: .7rem;
            font-weight: 600;
            border-radius: 50px;
            padding: .15rem .55rem;
            min-width: 20px;
            text-align: center;
        }

       
        .empty {
            text-align: center;
            padding: 3rem;
            color: var(--muted);
        }
        .empty-icon { font-size: 2.5rem; margin-bottom: .75rem; }
        .empty-text { font-size: .9rem; }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="/" class="navbar-brand">MAISON DAGAZ</a>
    <a href="/" class="navbar-back">← Retour à la boutique</a>
</nav>

<div class="page">
    <h1 class="page-title">Messages</h1>
    <p class="page-sub">Vos conversations privées</p>

    {{-- Nouvelle conversation --}}
    <form class="new-conv" method="GET" action="">
        <label>NOUVEAU</label>
        <select name="user_id" id="new-user-select">
            <option value="">— Choisir un utilisateur —</option>
            @foreach ($allUsers as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
        <a href="#" class="btn-start" id="start-btn">Démarrer</a>
    </form>

    {{-- Liste des conversations --}}
    @if ($contacts->isEmpty())
        <div class="empty">
            <div class="empty-icon"></div>
            <p class="empty-text">Aucune conversation pour l'instant.<br>Sélectionnez un utilisateur ci-dessus pour commencer.</p>
        </div>
    @else
        <div class="contact-list">
            @foreach ($contacts as $contact)
                <a href="{{ route('chat.show', $contact->id) }}" class="contact-card">
                    <div class="avatar">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                    <div class="contact-info">
                        <div class="contact-name">{{ $contact->name }}</div>
                        <div class="contact-preview">{{ $contact->last_message ?? 'Aucun message' }}</div>
                    </div>
                    <div class="contact-meta">
                        @if ($contact->last_message_at)
                            <span class="contact-time">{{ \Carbon\Carbon::parse($contact->last_message_at)->diffForHumans() }}</span>
                        @endif
                        @if ($contact->unread_count > 0)
                            <span class="badge">{{ $contact->unread_count }}</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

<script>
    document.getElementById('start-btn').addEventListener('click', function (e) {
        e.preventDefault();
        const sel = document.getElementById('new-user-select');
        const id  = sel.value;
        if (id) window.location.href = '/chat/' + id;
    });
</script>

</body>
</html>
