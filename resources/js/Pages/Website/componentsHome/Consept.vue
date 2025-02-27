<template>
    <section class="py-12 bg-white dark:bg-gray-800 sm:py-16 lg:py-20 relative overflow-hidden mb-24">
        <!-- Fond avec grille -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Premier bloc -->
            <div class="grid grid-cols-1 md:items-center gap-y-12 md:grid-cols-2 md:gap-x-16">
                <!-- Zone d'icônes animées avec meilleur positionnement -->
                <div class="relative group">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div class="relative overflow-hidden rounded-xl bg-white/10 backdrop-blur-sm p-8">
                        <div class="flex items-center justify-center h-80 relative">
                            <!-- Icônes avec positions fixes et espacées -->
                            <i class='bx bx-code-block text-8xl text-white animate-float absolute top-4 left-1/4'></i>
                            <i
                                class='bx bx-devices text-7xl text-white/80 animate-float-delayed absolute bottom-4 right-1/4'></i>
                            <i
                                class='bx bx-data text-6xl text-white/60 animate-float-delayed-2 absolute top-1/3 right-8'></i>
                            <i
                                class='bx bx-mobile-alt text-5xl text-white/60 animate-float absolute bottom-1/3 left-8'></i>
                        </div>
                    </div>
                </div>

                <!-- Contenu et boutons -->
                <div>
                    <div class="relative mb-4">
                        <span
                            class="inline-block px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full mb-2">
                            Expertise Web
                        </span>
                        <h2 class="text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj">
                            Des Sites Web
                            <span class="relative">
                                <span class="relative z-10">Performants et Modernes</span>
                                <div
                                    class="absolute bottom-0 left-0 w-full h-3 bg-blue-200 dark:bg-blue-800/50 -z-10 transform -rotate-1">
                                </div>
                            </span>
                        </h2>
                    </div>

                    <p class="mt-8 text-lg text-white/80">
                        Nous créons des sites web optimisés pour la performance et l'expérience utilisateur.
                    </p>

                    <div class="flex items-center justify-center space-x-8 mt-6 mb-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">20+</div>
                            <div class="text-sm text-white/70">Projets construits </div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">97%</div>
                            <div class="text-sm text-white/70">Satisfaction</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">24h</div>
                            <div class="text-sm text-white/70">Délai moyen (selon le projet)</div>
                        </div>
                    </div>

                    <!-- Liste des features avec icônes -->
                    <ul class="mt-8 space-y-6">
                        <li v-for="(feature, index) in features" :key="index"
                            class="relative group transform transition-all duration-300 hover:translate-x-2">
                            <div class="flex items-center p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 text-white group-hover:scale-110 transition-transform">
                                        <i :class="[feature.icon, 'text-2xl group-hover:animate-bounce']"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-white">{{ feature.title }}</h3>
                                    <p class="mt-1.5 text-base text-white/80">{{ feature.description }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="mt-8">
                        <a href="/demarrer-projet"
                            class="inline-flex items-center px-6 py-3 text-base font-medium text-blue-600 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                            Démarrer mon projet
                            <i class='bx bx-right-arrow-alt ml-2'></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- À la fin du premier bloc, avant le deuxième bloc -->
            <div class="mt-12 p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                <h3 class="text-lg font-semibold text-white mb-4 text-center">Technologies que nous utilisons</h3>
                <div class="flex flex-wrap justify-center gap-4">
                    <div v-for="tech in technologies" :key="tech.name"
                        class="flex items-center space-x-2 px-3 py-2 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                        <i :class="[tech.icon, 'text-xl', tech.color]"></i>
                        <span class="text-sm text-white">{{ tech.name }}</span>
                    </div>
                </div>
            </div>

            <!-- Entre les deux blocs principaux -->
            <div class="relative my-16 mx-auto max-w-3xl">
                <div
                    class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl blur-xl opacity-20">
                </div>
                <div class="relative p-8 bg-white/10 backdrop-blur-sm rounded-xl">
                    <i class='bx bxs-quote-alt-left text-4xl text-blue-300 absolute -top-4 -left-2'></i>
                    <p class="text-lg text-white italic">
                        "Notre mission est de rendre le web accessible à tous les entrepreneurs. Nous croyons que chaque
                        entreprise mérite une présence en ligne professionnelle, quelle que soit sa taille."
                    </p>
                    <div class="mt-4 flex items-center">
                        <div class="ml-3">
                            <a href="https://www.linkedin.com/in/mesut-k-6a029b288/" target="_blank"
                                rel="noopener noreferrer"
                                class="text-sm font-medium text-white hover:text-blue-200 transition-colors group flex items-center">
                                Mesut Kircil
                                <i class='bx bxl-linkedin-square text-blue-300 ml-1 group-hover:text-blue-200'></i>
                            </a>
                            <p class="text-xs text-blue-200">Fondateur, StudioWebspark</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deuxième bloc -->
            <div class="grid grid-cols-1 md:items-center gap-y-12 md:grid-cols-2 md:gap-x-16 mt-20">
                <div class="order-2 md:order-1">
                    <div class="relative mb-4">
                        <span
                            class="inline-block px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full mb-2">
                            Service Client
                        </span>
                        <h2 class="text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj">
                            Une Approche
                            <span class="bg-gradient-to-r from-blue-200 to-white bg-clip-text text-transparent">
                                Centrée Client
                            </span>
                        </h2>
                    </div>

                    <p class="mt-8 text-lg text-white/80">
                        Notre priorité est votre satisfaction. Nous travaillons en étroite collaboration avec vous pour
                        créer un site web qui répond parfaitement à vos besoins et objectifs commerciaux.
                    </p>

                    <!-- Services avec meilleur espacement -->
                    <div class="mt-8 space-y-6 mb-12">
                        <!-- Livraison Rapide -->
                        <div class="relative group transform transition-all duration-300 hover:translate-x-2">
                            <div class="flex items-center p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 text-white group-hover:scale-110 transition-transform">
                                        <i class='bx bx-time text-2xl group-hover:animate-bounce'></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-white">Livraison Rapide</h3>
                                    <p class="text-white/80">Site web livré en 24h</p>
                                </div>
                            </div>
                        </div>

                        <!-- Support Premium -->
                        <div class="relative group transform transition-all duration-300 hover:translate-x-2 mb-6">
                            <div class="flex items-center p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 text-white group-hover:scale-110 transition-transform">
                                        <i class='bx bx-support text-2xl group-hover:animate-bounce'></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-white">Support Premium</h3>
                                    <p class="text-white/80">Assistance technique 5/7 jours</p>
                                </div>
                            </div>
                        </div>

                        <!-- Mises à jour avec plus d'espace -->
                        <div class="relative group transform transition-all duration-300 hover:translate-x-2 mb-8">
                            <div class="flex items-center p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 text-white group-hover:scale-110 transition-transform">
                                        <i class='bx bx-refresh text-2xl group-hover:animate-bounce'></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-white">Mises à jour</h3>
                                    <p class="text-white/80">Suivi gratuit pendant 15j</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="tel:+33767175724"
                            class="inline-flex items-center px-6 py-3 text-base font-medium text-blue-600 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                            Nous appeler
                            <i class='bx bx-phone ml-2'></i>
                        </a>
                    </div>
                </div>

                <!-- Zone d'icônes animées droite -->
                <div class="relative order-1 md:order-2 group">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div class="relative overflow-hidden rounded-xl bg-white/10 backdrop-blur-sm p-8">
                        <div class="flex items-center justify-center h-80 relative">
                            <!-- Icônes bien espacées -->
                            <i class='bx bx-user-circle text-8xl text-white animate-float absolute top-4 left-1/4'></i>
                            <i
                                class='bx bx-chat text-7xl text-white/80 animate-float-delayed absolute bottom-4 right-1/4'></i>
                            <i
                                class='bx bx-headphone text-6xl text-white/60 animate-float-delayed-2 absolute top-1/3 right-8'></i>
                            <i class='bx bx-like text-5xl text-white/60 animate-float absolute bottom-1/3 left-8'></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mise à jour du tableau services dans le script -->
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <div class="p-3 bg-white/10 backdrop-blur-sm rounded-lg flex items-center space-x-2">
                    <i class='bx bx-desktop text-2xl text-white'></i>
                    <span class="text-sm text-white">Application web</span>
                </div>
                <div class="p-3 bg-white/10 backdrop-blur-sm rounded-lg flex items-center space-x-2">
                    <i class='bx bx-calendar text-2xl text-white'></i>
                    <span class="text-sm text-white">Réservation</span>
                </div>
                <div class="p-3 bg-white/10 backdrop-blur-sm rounded-lg flex items-center space-x-2">
                    <i class='bx bx-news text-2xl text-white'></i>
                    <span class="text-sm text-white">Blog</span>
                </div>
                <div class="p-3 bg-white/10 backdrop-blur-sm rounded-lg flex items-center space-x-2">
                    <i class='bx bx-building-house text-2xl text-white'></i>
                    <span class="text-sm text-white">Vitrine</span>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const features = [
    {
        icon: 'bx bx-devices',
        title: 'Design Responsive & Mobile First',
        description: 'Sites web optimisés pour tous les appareils'
    },
    {
        icon: 'bx bx-search-alt',
        title: 'Optimisation SEO incluse',
        description: 'Meilleur référencement naturel'
    },
    {
        icon: 'bx bx-rocket',
        title: 'Performance Optimale',
        description: 'Temps de chargement ultra-rapide'
    }
];

const services = [
    {
        icon: 'bx bx-time',
        title: 'Livraison Rapide',
        description: 'Site web livré en 24h'
    },
    {
        icon: 'bx bx-support',
        title: 'Support Premium',
        description: 'Assistance technique 5/7 jours'
    },
    {
        icon: 'bx bx-refresh',
        title: 'Mises à jour',
        description: 'Suivi gratuit pendant 15j'
    }
];

const technologies = [
    { name: 'JavaScript', icon: 'bx bxl-javascript', color: 'text-yellow-400' },
    { name: 'Vue.js', icon: 'bx bxl-vuejs', color: 'text-green-400' },
    { name: 'PHP', icon: 'bx bxl-php', color: 'text-indigo-400' },
    { name: 'Laravel', icon: 'bx bxl-laravel', color: 'text-red-500' },
    { name: 'Tailwind CSS', icon: 'bx bxl-tailwind-css', color: 'text-cyan-400' },

];
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-15px);
    }
}

@keyframes float-delayed {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(15px);
    }
}

@keyframes float-delayed-2 {

    0%,
    100% {
        transform: translateY(-10px);
    }

    50% {
        transform: translateY(10px);
    }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 4s ease-in-out infinite;
}

.animate-float-delayed-2 {
    animation: float-delayed-2 4s ease-in-out infinite;
    animation-delay: 2s;
}

/* Effet de brillance amélioré */
.group:hover .bx {
    filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.8));
    transition: all 0.3s ease;
}

/* Animation des boutons au hover */
.group:hover {
    transform: translateY(-2px);
}
</style>