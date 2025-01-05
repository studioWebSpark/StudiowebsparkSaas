<template>
    <section class="relative py-24 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <!-- Fond avec gradient et motif -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>


        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Contenu principal -->
            <div class="text-center">
                <!-- Badge animé -->
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/50 backdrop-blur-sm mb-8 animate-bounce">
                    <span class="flex h-2 w-2 mr-2">
                        <span
                            class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    <p class="text-sm font-medium text-blue-600 dark:text-blue-300">
                        Offre Limitée 🚀
                    </p>
                </div>

                <!-- Titre principal -->
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
                    Lancez Votre Projet Web
                    <span class="block text-blue-300 mt-2">En 24 Heures</span>
                </h2>

                <!-- Sous-titre -->
                <p class="max-w-2xl mx-auto text-lg text-blue-100 mb-10">
                    Obtenez un site web professionnel, rapide et sécurisé avec notre stack technique moderne :
                    <span class="font-semibold">Vue.js + Laravel + Tailwind CSS</span>
                </p>

                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                    <!-- Bouton principal -->
                    <a href="/demarrer-projet"
                        class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-xl">
                        <span class="relative z-10">Démarrer Mon Projet</span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-700 opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                        <div class="absolute inset-0 bg-grid-white/[0.05]"></div>
                    </a>

                    <!-- Bouton secondaire -->
                    <a href="/tarifs"
                        class="group inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white border-2 border-white/20 rounded-full hover:bg-white/10 transition-all duration-300">
                        Voir les Tarifs
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <!-- Partenaires -->
                <div class="mt-16 border-t border-white/10 pt-8">
                    <p class="text-sm font-semibold text-white/80 uppercase text-center mb-8">
                        Nos Partenaires Technologiques
                    </p>
                    <div class="relative overflow-hidden">
                        <!-- Premier défilement -->
                        <div class="flex space-x-12 animate-scroll">
                            <div v-for="partner in shuffledPartners" :key="partner.name"
                                class="flex flex-col items-center justify-center min-w-[120px] group">
                                <i :class="partner.icon"
                                    class="text-3xl text-white/70 group-hover:text-white transition-all duration-300 group-hover:scale-110">
                                </i>
                                <span
                                    class="mt-2 text-sm text-white/70 group-hover:text-white transition-all duration-300">
                                    {{ partner.name }}
                                </span>
                            </div>
                            <!-- Duplication pour un défilement continu -->
                            <div v-for="partner in shuffledPartners" :key="partner.name + '-duplicate'"
                                class="flex flex-col items-center justify-center min-w-[120px] group">
                                <i :class="partner.icon"
                                    class="text-3xl text-white/70 group-hover:text-white transition-all duration-300 group-hover:scale-110">
                                </i>
                                <span
                                    class="mt-2 text-sm text-white/70 group-hover:text-white transition-all duration-300">
                                    {{ partner.name }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const partners = [
    { name: 'Google Analytics', icon: 'bx bx-line-chart' },
    { name: 'Meta', icon: 'bx bxl-meta' },
    { name: 'Instagram', icon: 'bx bxl-instagram' },
    { name: 'Facebook', icon: 'bx bxl-facebook' },
    { name: 'Search Console', icon: 'bx bx-search' },
    { name: 'Vue.js', icon: 'bx bxl-vuejs' },
    { name: 'Tailwind CSS', icon: 'bx bxl-tailwind-css' },
    { name: 'GitHub', icon: 'bx bxl-github' },
    { name: 'Stripe', icon: 'bx bxl-stripe' },
    { name: 'AWS', icon: 'bx bxl-aws' },
    { name: 'SEO', icon: 'bx bx-search-alt' },
    { name: 'Ads', icon: 'bx bx-trending-up' },
    { name: 'HubSpot', icon: 'bx bx-broadcast' },
    { name: 'Mailchimp', icon: 'bx bx-envelope' },
    { name: 'Semrush', icon: 'bx bx-bar-chart-alt-2' },
    { name: 'Ahrefs', icon: 'bx bx-link' },
    { name: 'Tag Manager', icon: 'bx bx-code-alt' },
    { name: 'Business Suite', icon: 'bx bx-building' },
    { name: 'Pixel Meta', icon: 'bx bx-target-lock' }
];

// Mélanger aléatoirement le tableau des partenaires
const shuffledPartners = [...partners].sort(() => Math.random() - 0.5);
</script>
<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}

@keyframes scroll {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
    }
}

.animate-scroll {
    animation: scroll 10s linear infinite;
}

/* Pause l'animation au survol */
.animate-scroll:hover {
    animation-play-state: paused;
}
</style>
