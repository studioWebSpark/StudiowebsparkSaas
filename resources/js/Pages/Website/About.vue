<template>
    <div :class="{ 'dark': isDarkMode }" class="overflow-x-hidden bg-gray-50 dark:bg-gray-900">
        <Header 
            :is-dark-mode="isDarkMode" 
            :is-menu-open="isMenuOpen"
            :is-mobile="isMobile"
            :show-categories="showCategories"
            @toggle-dark-mode="toggleDarkMode"
            @toggle-menu="toggleMenu"
            @toggle-categories="toggleCategories"
            @show-categories="showCategories = true"
            @hide-categories="hideCategories"
        />
        <!-- ... reste du contenu ... -->
    </div>

    <History />
    <Team />
    <Values />
    <Tech />
    <Stats />
    <Testimonial />
    <Footer />
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from './componentsHome/Header.vue';
import History from './componentsAbout/History.vue';
import Team from './componentsAbout/Team.vue';
import Values from './componentsAbout/Values.vue';
import Tech from './componentsAbout/Tech.vue';
import Stats from './componentsAbout/Stats.vue';
import Testimonial from './componentsAbout/Testimonial.vue';
import Footer from './componentsHome/Footer.vue';

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
</script>
