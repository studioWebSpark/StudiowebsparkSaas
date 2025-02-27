<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, user-scalable=no, minimal-ui">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="theme-color" content="#2563eb">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css'>
    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <style>
        html {
            height: 100%;
            overflow: hidden;
            overscroll-behavior: none;
            position: fixed;
            width: 100%;
            touch-action: none;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            background-color: #2563eb;
            position: fixed;
            overflow-y: auto;
            overscroll-behavior-y: none;
            -webkit-overflow-scrolling: touch;
        }

        /* Motif de points */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
            background-size: 40px 40px;
            opacity: 0.2;
            pointer-events: none;
        }

        /* Mode sombre */
        html.dark body {
            background-color: #1e3a8a;
        }

        #app {
            height: 100%;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            overscroll-behavior-y: none;
        }
    </style>
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
