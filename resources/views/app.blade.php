<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, minimal-ui">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Meta description pour le SEO -->
    <meta name="description" content="StudioWebspark - Agence web spécialisée dans la création de sites web professionnels pour auto-entrepreneurs. Sites livrés en 24h avec un accompagnement personnalisé.">
    
    <meta name="theme-color" content="#2563eb">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:600&display=swap" as="style">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:600&display=swap">
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

        /* Styles critiques pour le titre principal */
        h1 {
            margin-top: 2rem;
            font-weight: 700;
            font-family: 'figtree', sans-serif;
            line-height: 1.2;
            color: white;
        }
        
        @media (min-width: 640px) {
            h1 {
                font-size: 3rem;
            }
        }
        
        @media (min-width: 1024px) {
            h1 {
                font-size: 3.75rem;
            }
        }
        
        .text-blue-200 {
            color: #bfdbfe;
        }

        @font-face {
            font-family: 'Figtree';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: local('Figtree SemiBold'), local('Figtree-SemiBold'), url('https://fonts.bunny.net/figtree/files/figtree-latin-600-normal.woff2') format('woff2');
        }

        /* Utiliser une police système en attendant que Figtree soit chargée */
        h1 {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .font-loaded h1 {
            font-family: 'Figtree', system-ui, sans-serif;
        }

        /* Styles pour le titre statique */
        .static-hero {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: #2563eb;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        
        .static-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
            background-size: 40px 40px;
            opacity: 0.2;
            pointer-events: none;
        }
        
        .static-hero .logo-container {
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .static-hero .logo {
            width: 120px;
            height: 120px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3));
        }
        
        .static-hero .brand-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .static-hero .brand-name {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            background: linear-gradient(to right, #ffffff, #bfdbfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 1px;
        }
        
        .static-hero .brand-tagline {
            font-size: 1.2rem;
            font-weight: 500;
            margin: 0.25rem 0 0;
            color: #bfdbfe;
            letter-spacing: 1px;
        }
        
        .static-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
            font-family: system-ui, -apple-system, sans-serif;
        }
        
        .static-hero .subtitle {
            font-size: 3rem;
            font-weight: 700;
            color: #bfdbfe;
            font-family: system-ui, -apple-system, sans-serif;
        }
        
        .static-hero .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background-color: white;
            border-radius: 9999px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .static-hero .badge-dot {
            width: 8px;
            height: 8px;
            background-color: #3b82f6;
            border-radius: 50%;
            margin-right: 0.5rem;
        }
        
        .static-hero .badge-text {
            font-size: 0.875rem;
            font-weight: 500;
            background: linear-gradient(to right, #2563eb, #4f46e5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Cacher le héros statique une fois que Vue est chargé */
        .js-loaded .static-hero {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
    </style>
    
    <!-- Optimisation du LCP - Script critique à placer en haut du head -->
    <script>
    // Injecter le titre immédiatement, avant même le DOMContentLoaded
    (function() {
        // Créer le titre dès que possible
        document.write('<h1 id="early-lcp" style="position:fixed; top:40%; left:50%; transform:translate(-50%,-50%); z-index:9999; font-size:3rem; font-weight:700; color:white; text-align:center; font-family:system-ui,-apple-system,sans-serif; max-width:90%; line-height:1.2;"><span>Propulsez Votre Activité</span><br><span style="color:#bfdbfe;">dans l\'Ère Digitale 🚀</span></h1>');
        
        // Cacher le titre une fois que Vue a rendu la page
        window.addEventListener('load', function() {
            setTimeout(function() {
                var earlyTitle = document.getElementById('early-lcp');
                if (earlyTitle) {
                    earlyTitle.style.display = 'none';
                }
            }, 100);
        });
    })();
    </script>

    <!-- Préchargement des icônes critiques -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" as="style">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <script>
    // Optimisation du LCP - Injecter le titre immédiatement
    (function() {
        // Créer un style pour le titre
        var style = document.createElement('style');
        style.textContent = `
            .hero-title {
                margin-top: 2rem;
                font-weight: 700;
                font-family: 'figtree', sans-serif;
                line-height: 1.2;
                font-size: 2.25rem;
                color: white;
                text-align: center;
                position: absolute;
                top: 40%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 10;
                width: 100%;
                max-width: 800px;
            }
            .hero-title .text-blue-200 {
                color: #bfdbfe;
            }
            @media (min-width: 640px) {
                .hero-title {
                    font-size: 3rem;
                }
            }
            @media (min-width: 1024px) {
                .hero-title {
                    font-size: 3.75rem;
                }
            }
        `;
        document.head.appendChild(style);
        
        // Créer et injecter le titre
        var heroTitle = document.createElement('h1');
        heroTitle.className = 'hero-title';
        heroTitle.innerHTML = `
            <span>Propulsez Votre Activité</span>
            <br>
            <span class="text-blue-200">dans l'Ère Digitale 🚀</span>
        `;
        
        // Ajouter le titre au body dès que possible
        document.addEventListener('DOMContentLoaded', function() {
            // Vérifier si le titre existe déjà (rendu par Vue)
            var existingTitle = document.querySelector('h1');
            if (existingTitle) {
                // Si le titre existe, on le cache pour éviter le duplicata
                heroTitle.style.display = 'none';
            } else {
                // Sinon on l'ajoute au body
                document.body.appendChild(heroTitle);
                
                // Et on le cache quand Vue aura rendu son propre titre
                var observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.addedNodes) {
                            mutation.addedNodes.forEach(function(node) {
                                if (node.tagName === 'H1' || (node.querySelector && node.querySelector('h1'))) {
                                    heroTitle.style.display = 'none';
                                    observer.disconnect();
                                }
                            });
                        }
                    });
                });
                
                observer.observe(document.body, { childList: true, subtree: true });
            }
        });
    })();
    </script>

    <script>
    // Détecter quand la police est chargée
    document.fonts.ready.then(function() {
        document.documentElement.classList.add('font-loaded');
    });
    </script>

    <!-- Styles inlinés pour les icônes Boxicons critiques -->
    <style>
      /* Styles de base pour Boxicons */
      @font-face {
        font-family: 'boxicons';
        font-weight: normal;
        font-style: normal;
        src: url('https://unpkg.com/boxicons@2.1.4/fonts/boxicons.woff2') format('woff2');
      }
      
      .bx {
        font-family: 'boxicons' !important;
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
        line-height: 1;
        display: inline-block;
        text-transform: none;
        speak: none;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
      
      /* Uniquement les icônes utilisées dans la partie visible */
      .bx-home:before { content: "\e900"; }
      .bx-menu:before { content: "\e9c6"; }
      /* Ajoutez d'autres icônes selon vos besoins */
    </style>
    
    <!-- Chargement asynchrone du reste de Boxicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" media="print" onload="this.media='all'">
    <noscript>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    </noscript>
</head>

<body class="font-sans antialiased">
    <!-- Héros statique qui s'affiche immédiatement -->
    <div class="static-hero">
        <div class="logo-container">
            <img src="/favicon.svg" alt="StudioWebspark Logo" class="logo">
            <div class="brand-info">
                <p class="brand-name">StudioWebspark</p>
                <p class="brand-tagline">Agence Web</p>
            </div>
        </div>
        
        <div class="badge">
            <span class="badge-dot"></span>
            <span class="badge-text">Accompagnement dédié aux auto-entrepreneurs ⚡️</span>
        </div>
        
        <h1>Propulsez Votre Activité</h1>
        <div class="subtitle">dans l'Ère Digitale 🚀</div>
    </div>

    @inertia
    
    <!-- Ajout de schema.org pour le rich snippet -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "StudioWebspark",
        "url": "{{ url('/') }}",
        "description": "Agence web spécialisée dans la création de sites web professionnels pour auto-entrepreneurs",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ url('/search?q={search_term_string}') }}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "StudioWebspark",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('favicon.svg') }}",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+33767175724",
            "contactType": "customer service"
        },
        "sameAs": [
            "https://www.instagram.com/studiowebspark_1"
        ]
    }
    </script>

    <!-- Enregistrement du service worker -->
    <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
          .then(registration => {
            console.log('Service Worker registered');
          })
          .catch(error => {
            console.log('Service Worker registration failed:', error);
          });
      });
    }
    </script>

    <script>
        // Cacher le héros statique une fois que Vue est chargé
        document.addEventListener('DOMContentLoaded', function() {
            // Attendre que Vue ait rendu le contenu
            setTimeout(function() {
                document.body.classList.add('js-loaded');
                
                // Supprimer complètement le héros statique après la transition
                setTimeout(function() {
                    var staticHero = document.querySelector('.static-hero');
                    if (staticHero) {
                        staticHero.parentNode.removeChild(staticHero);
                    }
                }, 300);
            }, 500);
        });
    </script>
</body>

</html>
