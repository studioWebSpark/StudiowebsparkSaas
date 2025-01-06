<template>
    <div class="overflow-x-hidden relative">
        <!-- Fond global avec motif -->
        <div class="fixed inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <!-- Contenu avec position relative -->
        <div class="relative">
            <Header :is-dark-mode="isDarkMode" :is-menu-open="isMenuOpen" :is-mobile="isMobile"
                :show-categories="showCategories" @toggle-dark-mode="toggleDarkMode" @toggle-menu="toggleMenu"
                @toggle-categories="toggleCategories" @show-categories="showCategories = true"
                @hide-categories="hideCategories" />

            <Vision />
            <Market />
            <MarketEvo />
            <Solution />
            <Process />
            <Cta />
            <Footer />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from './componentsHome/Header.vue';
import Cta from './componentsHome/Cta.vue';
import Market from './componentsAbout/Market.vue';
import MarketEvo from './componentsAbout/MarketEvo.vue';
import Process from './componentsAbout/Process.vue';
import Solution from './componentsAbout/Solution.vue';
import Vision from './componentsAbout/Vision.vue';
import Footer from './componentsHome/Footer.vue';

const isDarkMode = ref(localStorage.getItem('darkMode') === 'true');
const isMenuOpen = ref(false);
const isMobile = ref(false);
const showCategories = ref(false);

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

    if (isDarkMode.value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

// Ajout des fonctions manquantes pour la gestion des catégories
const toggleCategories = () => {
    showCategories.value = !showCategories.value;
};

const hideCategories = () => {
    showCategories.value = false;
};
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
