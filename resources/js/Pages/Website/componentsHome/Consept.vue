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
                    <h2 class="text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj">
                        Des Sites Web
                        <span class="relative">
                            <span class="relative z-10">Performants et Modernes</span>
                            <div
                                class="absolute bottom-0 left-0 w-full h-3 bg-blue-200 dark:bg-blue-800/50 -z-10 transform -rotate-1">
                            </div>
                        </span>
                    </h2>

                    <p class="mt-8 text-lg text-white/80">
                        Nous créons des sites web optimisés pour la performance et l'expérience utilisateur.
                    </p>

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
                </div>
            </div>

            <!-- Deuxième bloc -->
            <div class="grid grid-cols-1 md:items-center gap-y-12 md:grid-cols-2 md:gap-x-16 mt-20">
                <div class="order-2 md:order-1">
                    <h2 class="text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj">
                        Une Approche
                        <span class="bg-gradient-to-r from-blue-200 to-white bg-clip-text text-transparent">
                            Centrée Client
                        </span>
                    </h2>

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
                                    <div class="flex items-center justify-center w-12 h-12 text-white">
                                        <i class='bx bx-time text-2xl'></i>
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
                                    <div class="flex items-center justify-center w-12 h-12 text-white">
                                        <i class='bx bx-support text-2xl'></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-white">Support Premium</h3>
                                    <p class="text-white/80">Assistance technique 7j/7</p>
                                </div>
                            </div>
                        </div>

                        <!-- Mises à jour avec plus d'espace -->
                        <div class="relative group transform transition-all duration-300 hover:translate-x-2 mb-8">
                            <div class="flex items-center p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-12 h-12 text-white">
                                        <i class='bx bx-refresh text-2xl'></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-white">Mises à jour</h3>
                                    <p class="text-white/80">Révisions illimitées pendant 30j</p>
                                </div>
                            </div>
                        </div>
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
        description: 'Assistance technique 7j/7'
    },
    {
        icon: 'bx bx-refresh',
        title: 'Mises à jour',
        description: 'Révisions illimitées pendant 30j'
    }
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