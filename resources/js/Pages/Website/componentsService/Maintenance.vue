<template>
    <div class="min-h-screen">
        <div class="fixed inset-0 bg-blue-600 dark:bg-blue-900 -z-10">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>
        <Header :is-dark-mode="isDarkMode" :is-menu-open="isMenuOpen" :is-mobile="isMobile"
            @toggle-dark-mode="toggleDarkMode" @toggle-menu="toggleMenu" @toggle-categories="toggleCategories"
            @mouseover-services="handleMouseOver" @mouseleave-services="handleMouseLeave" />

        <CategoriesMenu v-if="showCategories" :is-dark-mode="isDarkMode" @mouseover="handleMouseOver"
            @mouseleave="handleMouseLeave" />

        <!-- Titre et description -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="max-w-xl px-8 mx-auto text-center md:px-0">
                <span class="text-base font-semibold tracking-wide text-white uppercase">
                    Service : Maintenance & Support
                </span>
                <h2 class="mt-4 text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj">
                    Assurez la Pérennité de Votre Site
                </h2>
                <p class="mt-4 text-lg font-normal text-white/90 font-pj mb-14">
                    Solutions de maintenance professionnelles pour garantir performance et sécurité
                </p>
            </div>

            <!-- Services de maintenance avec fond blanc semi-transparent -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        Maintenance Technique
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Surveillance et optimisation des performances.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Mises à jour régulières
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Sauvegardes automatisées
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Monitoring 24/7
                        </li>
                    </ul>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        Sécurité & Protection
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Protection contre les menaces et vulnérabilités.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Audit de sécurité
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Protection anti-malware
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Correctifs de sécurité
                        </li>
                    </ul>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        Support & Assistance
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Accompagnement personnalisé et réactif.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Support technique dédié
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Temps de réponse garanti
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-400">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            Rapports mensuels
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <ProcessMaintenance />

        <Cta />

        <Footer />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Header from '../componentsHome/Header.vue';
import Footer from '../componentsHome/Footer.vue';
import CategoriesMenu from '../componentsHome/CategoriesMenu.vue';
import Cta from '../componentsHome/Cta.vue';
import ProcessMaintenance from '../componentsService/ProcessMaintenance.vue';

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
<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
