<template>
    <section class="py-12 bg-white dark:bg-gray-800 sm:py-16 lg:py-20 relative overflow-hidden">
        <!-- Effet de fond -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Premier bloc -->
            <div class="grid grid-cols-1 md:items-center gap-y-12 md:grid-cols-2 md:gap-x-16">
                <!-- Image avec effet -->
                <div class="relative group">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div class="relative overflow-hidden rounded-xl">
                        <img class="w-full transition-transform duration-700 group-hover:scale-105"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/features-v2/5/illustration.png"
                            alt="Illustration développement web" />
                    </div>
                </div>

                <!-- Contenu -->
                <div>
                    <h2 class="text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj dark:text-white">
                        Des Sites Web
                        <span class="relative">
                            <span class="relative z-10">Performants et Modernes</span>
                            <div
                                class="absolute bottom-0 left-0 w-full h-3 bg-blue-200 dark:bg-blue-800/50 -z-10 transform -rotate-1">
                            </div>
                        </span>
                    </h2>

                    <p class="mt-8 text-lg text-white/80 dark:text-gray-300">
                        Nous créons des sites web optimisés pour la performance et l'expérience utilisateur.
                        Notre approche combine design moderne et technologies de pointe pour garantir votre succès en
                        ligne.
                    </p>

                    <div class="h-px w-32 mt-8 bg-gradient-to-r from-blue-500 to-indigo-500"></div>

                    <ul class="mt-8 space-y-6">
                        <li v-for="(feature, index) in features" :key="index" class="relative group">
                            <div
                                class="absolute -inset-4 bg-white/10 dark:bg-blue-900/10 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300">
                            </div>
                            <div
                                class="relative flex items-center p-4 bg-white/10 backdrop-blur-sm dark:bg-gray-800/50 rounded-xl shadow-sm group-hover:shadow-md transition-all duration-300">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 text-white dark:text-blue-400">
                                        <i :class="feature.icon" class="text-2xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-white dark:text-white">
                                        {{ feature.title }}
                                    </h3>
                                    <p class="mt-1.5 text-base text-white/80 dark:text-gray-300">
                                        {{ feature.description }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Deuxième bloc -->
            <div class="grid grid-cols-1 md:items-center gap-y-12 md:grid-cols-2 md:gap-x-16 mt-20">
                <div class="order-2 md:order-1">
                    <h2 class="text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj dark:text-white">
                        Une Approche
                        <span class="bg-gradient-to-r from-blue-200 to-white bg-clip-text text-transparent">
                            Centrée Client
                        </span>
                    </h2>

                    <p class="mt-8 text-lg text-white/80 dark:text-gray-300">
                        Notre priorité est votre satisfaction. Nous travaillons en étroite collaboration avec vous pour
                        créer
                        un site web qui répond parfaitement à vos besoins et objectifs commerciaux.
                    </p>

                    <div class="mt-8 grid gap-6">
                        <div v-for="(service, index) in services" :key="index" class="relative group">
                            <div
                                class="absolute -inset-4 bg-white/10 dark:bg-blue-900/10 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300">
                            </div>
                            <div
                                class="relative flex items-center p-4 bg-white/10 backdrop-blur-sm dark:bg-gray-800/50 rounded-xl shadow-sm group-hover:shadow-md transition-all duration-300">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 text-white dark:text-blue-400">
                                        <i :class="service.icon" class="text-2xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-white dark:text-white">
                                        {{ service.title }}
                                    </h3>
                                    <p class="mt-1 text-white/80 dark:text-gray-300">
                                        {{ service.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image avec effet -->
                <div class="relative order-1 md:order-2 group">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div class="relative overflow-hidden rounded-xl">
                        <img class="w-full transition-transform duration-700 group-hover:scale-105"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/features/1/illustration.png"
                            alt="Illustration approche client" />
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
</style>