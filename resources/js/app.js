import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import LoadingScreen from "./Components/LoadingScreen.vue";

// Optimisation du LCP
const appName = import.meta.env.VITE_APP_NAME || "Laravel";

// Fonction pour optimiser le LCP
const optimizeLCP = () => {
    // Trouver le titre principal
    const lcpElement = document.querySelector('#main-lcp-element');
    if (lcpElement) {
        // Ajouter les attributs de priorité
        lcpElement.setAttribute('fetchpriority', 'high');
        lcpElement.setAttribute('importance', 'high');
        
        // Notifier le navigateur que c'est un élément important
        if ('LargestContentfulPaint' in window) {
            new PerformanceObserver((entryList) => {
                const entries = entryList.getEntries();
                if (entries.length > 0) {
                    console.log('LCP element:', entries[0].element);
                }
            }).observe({type: 'largest-contentful-paint', buffered: true});
        }
    }
    
    // Cacher le titre injecté tôt
    const earlyTitle = document.getElementById('early-lcp');
    if (earlyTitle) {
        earlyTitle.style.display = 'none';
    }
};

// Exécuter l'optimisation dès que possible
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', optimizeLCP);
} else {
    optimizeLCP();
}

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ 
            render: () => h(App, props),
            // Ajouter un composant global pour l'écran de chargement
            components: { LoadingScreen }
        });
        
        app.use(plugin)
            .use(ZiggyVue)
            .mount(el);
            
        return app;
    },
    progress: {
        // Désactiver la barre de progression par défaut
        color: "#4B5563",
        showSpinner: true,
        // Afficher notre écran de chargement personnalisé
        delay: 250,
        // Personnaliser le comportement de la progression
        render: {
            start(progress) {
                // Afficher notre écran de chargement personnalisé
                const loadingScreen = document.createElement('div');
                loadingScreen.id = 'inertia-loading-screen';
                document.body.appendChild(loadingScreen);
                
                const app = createApp(LoadingScreen);
                app.mount('#inertia-loading-screen');
            },
            progress(progress) {
                // Mise à jour de la progression si nécessaire
            },
            finish(progress) {
                // Supprimer l'écran de chargement
                const loadingScreen = document.getElementById('inertia-loading-screen');
                if (loadingScreen) {
                    setTimeout(() => {
                        loadingScreen.remove();
                    }, 300);
                }
            }
        }
    },
});
