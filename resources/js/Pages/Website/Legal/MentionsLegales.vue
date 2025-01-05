<template>
    <div :class="{ 'dark': isDarkMode }" class="overflow-x-hidden bg-gray-50 dark:bg-gray-900">
        <Header :is-dark-mode="isDarkMode" :is-menu-open="isMenuOpen" :is-mobile="isMobile"
        @toggle-dark-mode="toggleDarkMode" @toggle-menu="toggleMenu"
        @toggle-categories="toggleCategories" @show-categories="showCategories = true"
        @hide-categories="hideCategories" />

    
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- En-tête décoratif -->
        <div class="relative bg-gradient-to-b from-blue-600 to-blue-800 dark:from-blue-900 dark:to-indigo-900">
            <div class="absolute inset-0 bg-grid-white/[0.05] bg-grid-pattern"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <h1 class="text-4xl font-bold text-white text-center">
                    Mentions Légales
                </h1>
                <p class="mt-4 text-blue-100 text-center max-w-2xl mx-auto">
                    Informations légales et réglementaires concernant notre activité et l'utilisation de notre site web
                </p>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <!-- Section Éditeur -->
                    <section class="mb-12">
                        <div class="flex items-center mb-6">
                            <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-lg">
                                <i class='bx bx-user text-2xl text-blue-600 dark:text-blue-400'></i>
                            </div>
                            <h2 class="ml-4 text-2xl font-semibold text-gray-900 dark:text-white">
                                Éditeur du site
                            </h2>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Entreprise</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-white">[Votre Nom] - DevMarketer</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Statut</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-white">Entrepreneur individuel</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">SIRET</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-white">[Votre SIRET]</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Adresse</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-white">[Votre Adresse]</dd>
                                </div>
                            </dl>
                        </div>
                    </section>

                    <!-- Section Hébergement -->
                    <section class="mb-12">
                        <div class="flex items-center mb-6">
                            <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                                <i class='bx bx-server text-2xl text-green-600 dark:text-green-400'></i>
                            </div>
                            <h2 class="ml-4 text-2xl font-semibold text-gray-900 dark:text-white">
                                Hébergement
                            </h2>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <dl class="grid grid-cols-1 gap-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Hébergeur</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-white">[Nom de l'hébergeur]</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Adresse</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-white">[Adresse de l'hébergeur]</dd>
                                </div>
                            </dl>
                        </div>
                    </section>

                    <!-- Autres sections avec le même style -->
                    <section class="mb-12">
                        <div class="flex items-center mb-6">
                            <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-lg">
                                <i class='bx bx-copyright text-2xl text-purple-600 dark:text-purple-400'></i>
                            </div>
                            <h2 class="ml-4 text-2xl font-semibold text-gray-900 dark:text-white">
                                Propriété intellectuelle
                            </h2>
                        </div>
                        <div class="prose dark:prose-invert max-w-none">
                            <p>L'ensemble de ce site relève de la législation française et internationale sur le droit
                                d'auteur et la propriété intellectuelle. Tous les droits de reproduction sont réservés,
                                y compris pour les documents téléchargeables et les représentations iconographiques et
                                photographiques.</p>
                        </div>
                    </section>

                    <!-- Section Contact avec carte interactive -->
                    <section class="mb-12">
                        <div class="flex items-center mb-6">
                            <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                <i class='bx bx-envelope text-2xl text-indigo-600 dark:text-indigo-400'></i>
                            </div>
                            <h2 class="ml-4 text-2xl font-semibold text-gray-900 dark:text-white">
                                Contact
                            </h2>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                        Nous contacter
                                    </h3>
                                    <dl class="space-y-4">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                            <dd class="mt-1 text-gray-900 dark:text-white">contact@devmarketer.fr</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Téléphone
                                            </dt>
                                            <dd class="mt-1 text-gray-900 dark:text-white">[Votre Téléphone]</dd>
                                        </div>
                                    </dl>
                                </div>
                                <div class="flex-1">
                                    <div class="h-48 bg-gray-200 dark:bg-gray-600 rounded-lg overflow-hidden">
                                        <!-- Emplacement pour une carte ou une image -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Pied de page avec date de mise à jour -->
            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                Dernière mise à jour : {{ new Date().toLocaleDateString('fr-FR') }}
                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, currentColor 1px, transparent 0);
    background-size: 32px 32px;
}
</style>

<script setup>
import Footer from '../componentsHome/Footer.vue';
import Header from '../componentsHome/Header.vue';
import { ref, onMounted, onUnmounted } from 'vue';
const isDarkMode = ref(localStorage.getItem('darkMode') === 'true');
const isMenuOpen = ref(false);
const showCategories = ref(false);
const isMobile = ref(false);

// Fonction pour détecter si on est sur mobile
const checkIfMobile = () => {
    isMobile.value = window.innerWidth < 1024;
};

// Initialisation et gestion du redimensionnement
onMounted(() => {
    checkIfMobile();
    window.addEventListener('resize', checkIfMobile);

    // Appliquer le mode sombre au document si nécessaire
    if (isDarkMode.value) {
        document.documentElement.classList.add('dark');
    }
});

onUnmounted(() => {
    window.removeEventListener('resize', checkIfMobile);
});

// Fonctions de toggle
const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    localStorage.setItem('darkMode', isDarkMode.value);

    // Mettre à jour la classe sur l'élément HTML
    if (isDarkMode.value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const toggleCategories = () => {
    showCategories.value = !showCategories.value;
};

const hideCategories = () => {
    showCategories.value = false;
};

defineProps({
    // Vous pouvez ajouter des props si nécessaire
});
</script>