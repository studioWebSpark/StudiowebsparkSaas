<template>
    <div class="min-h-screen bg-white dark:bg-gray-900">
        <Header :is-dark-mode="isDarkMode" :is-menu-open="isMenuOpen" :is-mobile="isMobile"
            @toggle-dark-mode="toggleDarkMode" @toggle-menu="toggleMenu" @toggle-categories="toggleCategories"
            @mouseover-services="handleMouseOver" @mouseleave-services="handleMouseLeave" />

        <CategoriesMenu v-if="showCategories" :is-dark-mode="isDarkMode" @mouseover="handleMouseOver"
            @mouseleave="handleMouseLeave" />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 ">
            <div class="max-w-xl px-8 mx-auto text-center md:px-0 ">
                <span class="text-base font-semibold tracking-wide text-indigo-600 dark:text-indigo-400 uppercase">
                    Service : Création de Sites Web
                </span>
                <h2 class="mt-4 text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl xl:text-5xl font-pj">
                    Des Solutions Web Professionnelles
                </h2>
                <p class="mt-4 text-lg font-normal text-gray-600 dark:text-gray-300 font-pj mb-14">
                    Développement sur mesure de sites web modernes et performants
                </p>

            </div>

            <!-- Types de sites -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        Site Vitrine
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Présentez votre entreprise avec élégance et professionnalisme.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Design personnalisé
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Responsive design
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Optimisation SEO
                        </li>
                    </ul>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        Site E-commerce
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Vendez vos produits en ligne avec une boutique performante.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Gestion des produits
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Paiement sécurisé
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Suivi des commandes
                        </li>
                    </ul>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        Application Web
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Solutions sur mesure pour vos besoins spécifiques.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Développement personnalisé
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Interface intuitive
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Évolutivité garantie
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Notre processus -->
        <Process />
        <!-- CTA -->
        <Cta />

        <Footer />

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Header from '../componentsHome/Header.vue';
import Footer from '../componentsHome/Footer.vue';
import CategoriesMenu from '../componentsHome/CategoriesMenu.vue';
import Cta from '../componentsAbout/Cta.vue';
import Process from '../componentsAbout/Process.vue';

const isDarkMode = ref(localStorage.getItem('darkMode') === 'true');
const isMenuOpen = ref(false);
const isMobile = ref(false);
const showCategories = ref(false);

onMounted(() => {
    if (isDarkMode.value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
});

const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    localStorage.setItem('darkMode', isDarkMode.value);

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
