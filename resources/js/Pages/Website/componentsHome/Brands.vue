<template>
    <section class="py-12 bg-white sm:py-16 lg:py-20 dark:bg-gray-800 relative overflow-hidden">
        <!-- Effet de fond subtil -->
        <div class="absolute inset-0 dark:opacity-20">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-800 dark:to-gray-900">
            </div>
        </div>

        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 relative">
            <div class="xl:flex xl:items-center xl:justify-between">
                <div class="xl:shrink-0">
                    <h2 class="text-xl font-bold text-center text-gray-900 xl:text-left font-pj dark:text-white">
                        Plus de
                        <span class="text-blue-600 dark:text-blue-400">1000+</span>
                        entreprises
                        <br class="hidden xl:block" />
                        nous font confiance
                    </h2>
                </div>

                <!-- Logos avec effet de hover et animation -->
                <div
                    class="grid items-center grid-cols-2 gap-x-8 gap-y-8 mt-8 xl:mt-0 lg:grid-cols-4 place-items-center">
                    <div v-for="(brand, index) in brands" :key="index"
                        class="relative group transition-all duration-300 hover:scale-105">
                        <!-- Effet de brillance au hover -->
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/0 via-blue-500/10 to-blue-500/0 
                                  opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-500"></div>

                        <!-- Logo -->
                        <div class="relative bg-white dark:bg-gray-700 rounded-lg p-6 shadow-sm 
                                  group-hover:shadow-md transition-all duration-300">
                            <img :src="brand.logo" :alt="brand.name" class="object-contain w-auto h-8 mx-auto filter dark:brightness-200 dark:contrast-0 
                                        transition-all duration-300 group-hover:brightness-110" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bannière de statistiques -->
            <div class="mt-16 grid grid-cols-2 gap-8 md:grid-cols-4 xl:mt-24">
                <div v-for="(stat, index) in stats" :key="index" class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 to-indigo-500/5 
                              rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 bg-white dark:bg-gray-700 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ stat.label }}
                        </dt>
                        <dd class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                            {{ stat.value }}
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const brands = [
    {
        name: 'Vertex',
        logo: 'https://cdn.rareblocks.xyz/collection/clarity/images/brands/1/logo-vertex.svg'
    },
    {
        name: 'Squarestone',
        logo: 'https://cdn.rareblocks.xyz/collection/clarity/images/brands/1/logo-squarestone.svg'
    },
    {
        name: 'Martino',
        logo: 'https://cdn.rareblocks.xyz/collection/clarity/images/brands/1/logo-martino.svg'
    },
    {
        name: 'Waverio',
        logo: 'https://cdn.rareblocks.xyz/collection/clarity/images/brands/1/logo-waverio.svg'
    }
];

const stats = [
    { label: 'Clients Actifs', value: '1000+' },
    { label: 'Projets Livrés', value: '500+' },
    { label: 'Taux de Satisfaction', value: '99%' },
    { label: 'Support Client', value: '24/7' }
];
</script>

<style scoped>
/* Animation de défilement pour les logos (optionnel) */
@keyframes slide {
    from {
        transform: translateX(0);
    }

    to {
        transform: translateX(-100%);
    }
}

.animate-slide {
    animation: slide 20s linear infinite;
}

/* Effet de brillance */
.shine {
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    background-size: 200% 100%;
    animation: shine 1.5s infinite;
}

@keyframes shine {
    100% {
        background-position: 200% center;
    }
}
</style>