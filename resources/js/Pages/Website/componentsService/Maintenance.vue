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
