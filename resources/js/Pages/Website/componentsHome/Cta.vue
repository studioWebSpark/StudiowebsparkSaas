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
                        Offre Spéciale - Lancement 🚀
                    </p>
                </div>

                <!-- Titre principal -->
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 tracking-tight">
                    Votre Site Web Professionnel
                    <span class="block text-blue-300 mt-2">Prêt en 24-48 Heures</span>
                </h2>

                <!-- Sous-titre -->
                <p class="max-w-2xl mx-auto text-lg text-blue-100 mb-10">
                    Démarquez-vous de la concurrence avec un site web optimisé pour convertir vos visiteurs en clients.
                    <span class="font-semibold">Technologies modernes, design sur mesure, résultats garantis.</span>
                </p>

                <!-- Compteur -->
                <div class="flex justify-center mb-10">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg px-6 py-4 text-center">
                            <span class="block text-3xl font-bold text-white">20+</span>
                            <span class="text-sm text-blue-200">Projets livrés</span>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg px-6 py-4 text-center">
                            <span class="block text-3xl font-bold text-white">97%</span>
                            <span class="text-sm text-blue-200">Satisfaction</span>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg px-6 py-4 text-center">
                            <span class="block text-3xl font-bold text-white">24h</span>
                            <span class="text-sm text-blue-200">Délai moyen</span>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                    <!-- Bouton principal -->
                    <a href="/demarrer-projet"
                        class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-gray-900 dark:text-white transition-all duration-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 hover:shadow-md">
                        Démarrer Mon Projet
                        <i
                            class='bx bx-right-arrow-alt ml-2 text-xl transition-transform group-hover:translate-x-1'></i>
                    </a>

                    <!-- Bouton secondaire -->
                    <a href="/tarifs"
                        class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-gray-900 dark:text-white transition-all duration-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 hover:shadow-md">
                        Voir les Tarifs
                        <i
                            class='bx bx-right-arrow-alt ml-2 text-xl transition-transform group-hover:translate-x-1'></i>
                    </a>

                    <!-- Bouton Nous appeler -->
                    <a href="tel:+33767175724"
                        class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-gray-900 dark:text-white transition-all duration-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 hover:shadow-md">
                        Nous appeler
                        <i class='bx bx-phone ml-2 text-xl transition-transform group-hover:rotate-12'></i>
                    </a>
                </div>

                <!-- Partenaires -->
                <div class="mt-16 border-t border-white/10 pt-8">
                    <p class="text-sm font-semibold text-white/80 uppercase text-center mb-8">
                        Nos Partenaires
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
