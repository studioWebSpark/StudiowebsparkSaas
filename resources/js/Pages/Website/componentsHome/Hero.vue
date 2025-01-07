<template>
    <div class="relative -mt-36">
        <div class="min-h-screen bg-dot-pattern bg-fixed bg-[#EEF1FF] dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-36">
                <!-- Effet de fond avec gradient et motif -->
                <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
                    <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
                </div>
                <div class="relative px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                    <div class="max-w-3xl mx-auto text-center">
                        <!-- Badge animé -->
                        <div
                            class="inline-flex items-center px-4 py-2 space-x-2 bg-white dark:bg-gray-800 rounded-full shadow-md animate-float">
                            <span class="flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                            <p
                                class="text-sm font-medium bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                Site Web Professionnel en 24h ⚡️
                            </p>
                        </div>

                        <!-- Titre principal avec animation de texte -->
                        <h1 class="mt-8 text-4xl sm:text-5xl lg:text-6xl font-bold">
                            <span class="text-white">
                                Transformez Votre Vision
                            </span>
                            <br>
                            <span class="text-blue-200">
                                en Réalité Digitale
                            </span>
                        </h1>

                        <p class="mt-6 text-lg text-gray-200">
                            Des solutions web sur mesure et abordables pour les entrepreneurs.
                            <br>
                            Un accompagnement personnalisé pour concrétiser vos projets digitaux.
                        </p>

                        <!-- Boutons d'action -->
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-10">
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
                        </div>

                        <!-- Badges de confiance -->
                        <div class="grid grid-cols-2 gap-4 mt-12 sm:grid-cols-4">
                            <div class="relative group">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                                </div>
                                <div
                                    class="relative flex flex-col items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">24h</span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Livraison Express</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center p-4 bg-white rounded-lg dark:bg-gray-800 shadow-sm">
                                <span class="text-2xl font-bold text-green-600 dark:text-green-400">100%</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Satisfaction Client</span>
                            </div>
                            <div class="flex flex-col items-center p-4 bg-white rounded-lg dark:bg-gray-800 shadow-sm">
                                <span class="text-2xl font-bold text-purple-600 dark:text-purple-400">7/7</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Support Disponible</span>
                            </div>
                            <div class="flex flex-col items-center p-4 bg-white rounded-lg dark:bg-gray-800 shadow-sm">
                                <span class="text-2xl font-bold text-orange-600 dark:text-orange-400">30j</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Suivi Gratuit</span>
                            </div>
                        </div>
                    </div>

                    <!-- Grille d'images avec effet de flottement -->
                    <div class="mt-16 md:mt-20">
                        <div class="relative overflow-hidden">
                            <!-- Carrousel -->
                            <div class="flex transition-transform duration-700 ease-out"
                                :style="{ transform: `translateX(-${currentGroup * 100}%)` }">
                                <!-- Premier groupe -->
                                <div class="w-full flex-shrink-0">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                                        <div v-for="service in firstGroupServices" :key="service.title"
                                            class="relative group">
                                            <div
                                                class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg blur opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200">
                                            </div>
                                            <div class="relative rounded-lg shadow-2xl overflow-hidden">
                                                <img class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-[1.01] dark:opacity-90"
                                                    :src="service.image" :alt="service.title" />
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                                    <h3 class="text-white text-lg font-semibold">{{ service.title }}
                                                    </h3>
                                                    <p class="text-gray-200 text-sm">{{ service.description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deuxième groupe -->
                                <div class="w-full flex-shrink-0">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                                        <div v-for="service in secondGroupServices" :key="service.title"
                                            class="relative group">
                                            <div
                                                class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg blur opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200">
                                            </div>
                                            <div class="relative rounded-lg shadow-2xl overflow-hidden">
                                                <img class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-[1.01] dark:opacity-90"
                                                    :src="service.image" :alt="service.title" />
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                                    <h3 class="text-white text-lg font-semibold">{{ service.title }}
                                                    </h3>
                                                    <p class="text-gray-200 text-sm">{{ service.description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Indicateurs -->
                            <div class="flex justify-center mt-8 gap-3">
                                <button v-for="index in 2" :key="index" @click="goToGroup(index - 1)"
                                    class="h-3 rounded-full transition-all duration-300"
                                    :class="[currentGroup === index - 1 ? 'w-8 bg-blue-600' : 'w-3 bg-gray-300']">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const services = ref([
    {
        title: 'Site Vitrine Pro',
        description: 'Design moderne & responsive',
        image: '/images/web.png'
    },
    {
        title: 'Template Personnalisé',
        description: 'Sélection de template',
        image: '/images/template.png'
    },
    {
        title: 'E-commerce Premium',
        description: 'Gestion complète des ventes',
        image: '/images/e-commerce.png'
    },
    {
        title: 'CRM Intégré',
        description: 'Gestion client optimisée',
        image: '/images/crm.png'
    },
    {
        title: 'SEO Expert',
        description: 'Optimisation & visibilité',
        image: '/images/seo.png'
    },
    {
        title: 'Marketing Digital',
        description: 'Stratégie & performance',
        image: '/images/marketing.png'
    }
]);

const currentGroup = ref(0);

// Utilisation de vos services existants
const firstGroupServices = computed(() => services.value.slice(0, 3));
const secondGroupServices = computed(() => services.value.slice(3, 6));

const goToGroup = (index) => {
    currentGroup.value = index;
};

// Défilement automatique
let autoplayInterval = null;

onMounted(() => {
    autoplayInterval = setInterval(() => {
        currentGroup.value = currentGroup.value === 0 ? 1 : 0;
    }, 5000);
});

onUnmounted(() => {
    if (autoplayInterval) clearInterval(autoplayInterval);
});
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
