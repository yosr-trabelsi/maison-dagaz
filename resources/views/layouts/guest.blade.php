<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Maison Dagaz') }}</title>

    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    
</head>

<body style="font-family: Georgia; background-color: #f5e6e8; color: #7a2e2e;">

    <div style="min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">

        <div>
            <a href="/">
                <h2 style="text-align:center;">MAISON DAGAZ</h2>
            </a>
        </div>

        <div style="width: 100%; max-width: 400px; margin-top: 20px; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 5px 10px rgba(0,0,0,0.1);">
            {{ $slot }}
        </div>

    </div>

</body>
</html>