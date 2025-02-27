<template>

<Head>
        <title>Support - StudioWebspark | Aide et FAQ</title>
        <meta name="description"
            content="Besoin d'aide ? Consultez notre FAQ et nos options de support. Notre équipe est là pour vous accompagner dans votre projet web." />
        <meta name="keywords" content="support studiowebspark, aide site web, faq web, assistance technique" />

        <!-- Meta Tags pour Facebook et Instagram -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Support et FAQ - StudioWebspark" />
        <meta property="og:description"
            content="Questions fréquentes et support technique pour votre site web. Notre équipe est à votre écoute." />
        <meta property="og:url" content="https://studiowebspark.fr/support" />
        <meta property="og:site_name" content="StudioWebspark" />

        <!-- Meta Tags pour TikTok -->
        <meta property="bytedance:description"
            content="Questions fréquentes et support technique pour votre site web. Notre équipe est à votre écoute." />
    </Head>

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

            <HeroSupport />
            <FaqSection />
            <ContactOptions />
            <Footer />
            <CookieConsent />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from './componentsHome/Header.vue';
import HeroSupport from './componentsSupport/HeroSupport.vue';
import ContactOptions from './componentsSupport/ContactOptions.vue';
import FaqSection from './componentsSupport/FaqSection.vue';
import Footer from './componentsHome/Footer.vue';
import CookieConsent from '@/Components/CookieConsent.vue';

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

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
