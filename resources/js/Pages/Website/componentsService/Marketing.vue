<template>
    <div class="min-h-screen bg-white dark:bg-gray-900">
        <Header :is-dark-mode="isDarkMode" :is-menu-open="isMenuOpen" :is-mobile="isMobile"
            @toggle-dark-mode="toggleDarkMode" @toggle-menu="toggleMenu" @toggle-categories="toggleCategories"
            @mouseover-services="handleMouseOver" @mouseleave-services="handleMouseLeave" />

        <CategoriesMenu v-if="showCategories" :is-dark-mode="isDarkMode" @mouseover="handleMouseOver"
            @mouseleave="handleMouseLeave" />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="max-w-xl px-8 mx-auto text-center md:px-0">
                <span class="text-base font-semibold tracking-wide text-indigo-600 dark:text-indigo-400 uppercase">
                    Service : Marketing Digital
                </span>
                <h2 class="mt-4 text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl xl:text-5xl font-pj">
                    Boostez votre Visibilité en Ligne
                </h2>
                <p class="mt-4 text-lg font-normal text-gray-600 dark:text-gray-300 font-pj mb-14">
                    Stratégies marketing personnalisées pour développer votre présence digitale
                </p>
            </div>

            <!-- Services marketing -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        SEO
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Optimisez votre visibilité sur les moteurs de recherche.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Audit SEO complet
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Optimisation on-page
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Suivi des performances
                        </li>
                    </ul>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        Réseaux Sociaux
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Développez votre communauté et votre engagement.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Stratégie social media
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Création de contenu
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Gestion des campagnes
                        </li>
                    </ul>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        Publicité en Ligne
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Campagnes publicitaires ciblées et performantes.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Google Ads
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Facebook Ads
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Analyse des résultats
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Notre approche -->
            <ProcessMarket />

            <!-- CTA -->
            <Cta />
        </div>

        <Footer />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Header from '../componentsHome/Header.vue';
import Footer from '../componentsHome/Footer.vue';
import CategoriesMenu from '../componentsHome/CategoriesMenu.vue';
import Cta from '../componentsAbout/Cta.vue';
import ProcessMarket from '../componentsService/ProcessMarket.vue';


const isDarkMode = ref(localStorage.getItem('darkMode') === 'true');
const isMenuOpen = ref(false);
const isMobile = ref(false);
const showCategories = ref(false);

// Initialiser le mode sombre au chargement
onMounted(() => {
    // Appliquer le mode sombre au document si nécessaire
    if (isDarkMode.value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
});

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

const handleMouseOver = () => {
    showCategories.value = true;
};

const handleMouseLeave = () => {
    showCategories.value = false;
};
</script>