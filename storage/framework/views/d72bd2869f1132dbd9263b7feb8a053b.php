<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Chat avec <?php echo e($user->name); ?> – Maison Dagaz</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --rose:        #f5ece8;
            --rose-md:     #e8d5cc;
            --bordeaux:    #7a2535;
            --bordeaux-dk: #5c1a26;
            --text:        #2c1810;
            --muted:       #9e8880;
            --white:       #fffaf8;
            --bubble-me:   #7a2535;
            --bubble-them: #efe5e0;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Jost', sans-serif;
            background: var(--rose);
            color: var(--text);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        
        .navbar {
            background: var(--white);
            border-bottom: 1px solid var(--rose-md);
            padding: 0 1.5rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            z-index: 100;
        }
        .navbar-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 600;
            letter-spacing: .15em;
            color: var(--bordeaux);
            text-decoration: none;
        }
        .navbar-back {
            color: var(--bordeaux);
            text-decoration: none;
            font-size: .82rem;
            font-weight: 500;
            letter-spacing: .05em;
            transition: opacity .2s;
        }
        .navbar-back:hover { opacity: .7; }

       
        .chat-layout {
            display: flex;
            flex: 1;
            overflow: hidden;
            max-width: 1100px;
            width: 100%;
            margin: 0 auto;
            padding: 1.5rem;
            gap: 1.5rem;
        }

        
        .sidebar {
            width: 280px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: .75rem;
            overflow-y: auto;
        }
        .sidebar-title {
            font-size: .7rem;
            font-weight: 500;
            letter-spacing: .12em;
            color: var(--muted);
            padding: 0 .5rem;
            margin-bottom: .25rem;
        }

        .new-conv {
            background: var(--white);
            border: 1px solid var(--rose-md);
            border-radius: 10px;
            padding: .9rem 1rem;
            display: flex;
            gap: .6rem;
        }
        .new-conv select {
            flex: 1;
            border: 1px solid var(--rose-md);
            border-radius: 7px;
            padding: .4rem .7rem;
            font-family: 'Jost', sans-serif;
            font-size: .8rem;
            color: var(--text);
            background: var(--rose);
            outline: none;
        }
        .new-conv select:focus { border-color: var(--bordeaux); }
        .btn-go {
            background: var(--bordeaux);
            color: #fff;
            border: none;
            border-radius: 7px;
            padding: .4rem .85rem;
            font-size: .8rem;
            cursor: pointer;
            transition: background .2s;
        }
        .btn-go:hover { background: var(--bordeaux-dk); }

        .contact-item {
            background: var(--white);
            border: 1px solid var(--rose-md);
            border-radius: 10px;
            padding: .85rem 1rem;
            display: flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
            color: var(--text);
            transition: border-color .2s, box-shadow .15s;
        }
        .contact-item:hover,
        .contact-item.active {
            border-color: var(--bordeaux);
            box-shadow: 0 2px 10px rgba(122,37,53,.08);
        }
        .contact-item.active { background: #fdf3f0; }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--bordeaux);
            color: #fff;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .avatar.sm { width: 32px; height: 32px; font-size: .95rem; }

        .contact-info { flex: 1; min-width: 0; }
        .contact-name { font-size: .88rem; font-weight: 500; }
        .contact-preview {
            font-size: .75rem;
            color: var(--muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .badge {
            background: var(--bordeaux);
            color: #fff;
            font-size: .65rem;
            font-weight: 600;
            border-radius: 50px;
            padding: .1rem .45rem;
        }

        
        .chat-window {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--white);
            border: 1px solid var(--rose-md);
            border-radius: 14px;
            overflow: hidden;
        }

        .chat-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--rose-md);
            display: flex;
            align-items: center;
            gap: .9rem;
            background: var(--white);
            flex-shrink: 0;
        }
        .chat-header-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--bordeaux);
        }
        .online-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #5cb85c;
            display: inline-block;
        }

       
        .messages-area {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: .75rem;
            scroll-behavior: smooth;
        }

        .msg-row {
            display: flex;
            align-items: flex-end;
            gap: .6rem;
        }
        .msg-row.mine { flex-direction: row-reverse; }

        .bubble {
            max-width: 70%;
            padding: .65rem 1rem;
            border-radius: 14px;
            font-size: .9rem;
            line-height: 1.5;
            word-break: break-word;
            position: relative;
            animation: fadeUp .25s ease;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .bubble.mine {
            background: var(--bubble-me);
            color: #fff;
            border-bottom-right-radius: 4px;
        }
        .bubble.theirs {
            background: var(--bubble-them);
            color: var(--text);
            border-bottom-left-radius: 4px;
        }

        .msg-time {
            font-size: .68rem;
            color: var(--muted);
            flex-shrink: 0;
            margin-bottom: .2rem;
        }

        .date-divider {
            text-align: center;
            font-size: .72rem;
            color: var(--muted);
            letter-spacing: .08em;
            margin: .5rem 0;
        }

        
        .chat-input-area {
            border-top: 1px solid var(--rose-md);
            padding: 1rem 1.5rem;
            display: flex;
            gap: .75rem;
            align-items: flex-end;
            background: var(--white);
            flex-shrink: 0;
        }
        .chat-textarea {
            flex: 1;
            border: 1px solid var(--rose-md);
            border-radius: 10px;
            padding: .65rem 1rem;
            font-family: 'Jost', sans-serif;
            font-size: .9rem;
            color: var(--text);
            background: var(--rose);
            resize: none;
            outline: none;
            max-height: 120px;
            min-height: 42px;
            transition: border-color .2s;
            line-height: 1.5;
        }
        .chat-textarea:focus { border-color: var(--bordeaux); }
        .chat-textarea::placeholder { color: var(--muted); }

        .btn-send {
            background: var(--bordeaux);
            color: #fff;
            border: none;
            border-radius: 10px;
            width: 44px;
            height: 44px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s, transform .15s;
            flex-shrink: 0;
        }
        .btn-send:hover { background: var(--bordeaux-dk); transform: scale(1.05); }
        .btn-send svg { width: 18px; height: 18px; }

        
        .messages-area::-webkit-scrollbar,
        .sidebar::-webkit-scrollbar { width: 4px; }
        .messages-area::-webkit-scrollbar-track,
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .messages-area::-webkit-scrollbar-thumb,
        .sidebar::-webkit-scrollbar-thumb { background: var(--rose-md); border-radius: 2px; }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="/" class="navbar-brand">MAISON DAGAZ</a>
    <a href="<?php echo e(route('chat.index')); ?>" class="navbar-back">← Tous les messages</a>
</nav>

<div class="chat-layout">

    
    <aside class="sidebar">
        <p class="sidebar-title">CONVERSATIONS</p>

        
        <div class="new-conv">
            <select id="new-user-select">
                <option value="">— Nouveau —</option>
                <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($u->id); ?>"><?php echo e($u->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button class="btn-go" id="start-btn">→</button>
        </div>

        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('chat.show', $contact->id)); ?>"
               class="contact-item <?php echo e($contact->id === $user->id ? 'active' : ''); ?>">
                <div class="avatar sm"><?php echo e(strtoupper(substr($contact->name, 0, 1))); ?></div>
                <div class="contact-info">
                    <div class="contact-name"><?php echo e($contact->name); ?></div>
                    <div class="contact-preview"><?php echo e(Str::limit($contact->last_message ?? '—', 28)); ?></div>
                </div>
                <?php if($contact->unread_count > 0): ?>
                    <span class="badge"><?php echo e($contact->unread_count); ?></span>
                <?php endif; ?>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </aside>

    
    <div class="chat-window">

        
        <div class="chat-header">
            <div class="avatar"><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></div>
            <div>
                <div class="chat-header-name"><?php echo e($user->name); ?></div>
                <span class="online-dot"></span>
                <small style="color:var(--muted);font-size:.75rem;margin-left:.3rem;">en ligne</small>
            </div>
        </div>

        
        <div class="messages-area" id="messages-area">
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $mine = $msg->sender_id === Auth::id(); ?>
                <div class="msg-row <?php echo e($mine ? 'mine' : ''); ?>" data-id="<?php echo e($msg->id); ?>">
                    <?php if(!$mine): ?>
                        <div class="avatar sm"><?php echo e(strtoupper(substr($user->name,0,1))); ?></div>
                    <?php endif; ?>
                    <div class="bubble <?php echo e($mine ? 'mine' : 'theirs'); ?>">
                        <?php echo e($msg->body); ?>

                    </div>
                    <span class="msg-time"><?php echo e($msg->created_at->format('H:i')); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="chat-input-area">
            <textarea
                id="msg-input"
                class="chat-textarea"
                placeholder="Écrire un message…"
                rows="1"
            ></textarea>
            <button class="btn-send" id="send-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    const RECEIVER_ID = <?php echo e($user->id); ?>;
    const CSRF        = document.querySelector('meta[name="csrf-token"]').content;
    const area        = document.getElementById('messages-area');
    const input       = document.getElementById('msg-input');
    const sendBtn     = document.getElementById('send-btn');

    
    function scrollBottom() {
        area.scrollTop = area.scrollHeight;
    }
    scrollBottom();

    
    function getLastId() {
        const rows = area.querySelectorAll('[data-id]');
        if (!rows.length) return 0;
        return parseInt(rows[rows.length - 1].dataset.id) || 0;
    }

    
    function appendMessage(msg) {
        const row = document.createElement('div');
        row.className = 'msg-row' + (msg.is_mine ? ' mine' : '');
        row.dataset.id = msg.id;

        const avatarLetter = '<?php echo e(strtoupper(substr($user->name,0,1))); ?>';

        row.innerHTML = `
            ${!msg.is_mine ? `<div class="avatar sm">${avatarLetter}</div>` : ''}
            <div class="bubble ${msg.is_mine ? 'mine' : 'theirs'}">${msg.body}</div>
            <span class="msg-time">${msg.time}</span>
        `;
        area.appendChild(row);
        scrollBottom();
    }

    
    async function sendMessage() {
        const body = input.value.trim();
        if (!body) return;

        input.value = '';
        input.style.height = 'auto';

        try {
            const res = await fetch(`/chat/${RECEIVER_ID}/send`, {
                method:  'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'Accept':       'application/json',
                },
                body: JSON.stringify({ body }),
            });

           
            poll();
        } catch (e) {
            console.error('Erreur envoi:', e);
        }
    }

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
    });

    
    input.addEventListener('input', () => {
        input.style.height = 'auto';
        input.style.height = Math.min(input.scrollHeight, 120) + 'px';
    });

    
    async function poll() {
        const lastId = getLastId();
        try {
            const res  = await fetch(`/chat/${RECEIVER_ID}/poll?last_id=${lastId}`, {
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
            });
            const msgs = await res.json();
            msgs.forEach(appendMessage);
        } catch (e) {  }
    }

    setInterval(poll, 3000);

    
    document.getElementById('start-btn').addEventListener('click', () => {
        const id = document.getElementById('new-user-select').value;
        if (id) window.location.href = '/chat/' + id;
    });
</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\maison-dagaz\maison-dagaz\resources\views/chat/show.blade.php ENDPATH**/ ?>