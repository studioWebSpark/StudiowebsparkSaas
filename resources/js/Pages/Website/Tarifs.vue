<template>
    <div :class="{ 'dark': isDarkMode }" class="overflow-x-hidden bg-gray-50 dark:bg-gray-900">
        <Header 
            :is-dark-mode="isDarkMode" 
            :is-menu-open="isMenuOpen"
            :is-mobile="isMobile"
            @toggle-dark-mode="toggleDarkMode"
            @toggle-menu="toggleMenu"
            @toggle-categories="toggleCategories" 
        />
        <!-- ... reste du template ... -->
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from './componentsHome/Header.vue';

const isDarkMode = ref(false);
const isMenuOpen = ref(false);
const showCategories = ref(false);
const isMobile = ref(false);

// Fonction pour détecter si on est sur mobile
const checkIfMobile = () => {
    isMobile.value = window.innerWidth < 1024; // 1024px est la breakpoint lg de Tailwind
};

// Initialisation et gestion du redimensionnement
onMounted(() => {
    checkIfMobile();
    window.addEventListener('resize', checkIfMobile);
});

onUnmounted(() => {
    window.removeEventListener('resize', checkIfMobile);
});

function toggleDarkMode() {
    isDarkMode.value = !isDarkMode.value;
}

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value;
}

function toggleCategories() {
    showCategories.value = !showCategories.value;
}

function hideCategories() {
    showCategories.value = false;
}
</script>

