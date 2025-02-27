<template>

  <Head>
        <title>Tarifs - StudioWebspark | Solutions Web Abordables</title>
        <meta name="description" 
            content="Découvrez nos forfaits de création de sites web professionnels. Des solutions adaptées à tous les budgets avec un excellent rapport qualité-prix." />
        <meta name="keywords" 
            content="tarifs site web, prix site internet, forfaits web, création site web prix" />

        <!-- Meta Tags pour Facebook et Instagram -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Tarifs - StudioWebspark | Solutions Web Abordables" />
        <meta property="og:description" content="Des forfaits web adaptés à votre budget. Site professionnel à partir de X€." />
        <meta property="og:url" content="https://studiowebspark.fr/tarifs" />
        <meta property="og:site_name" content="StudioWebspark" />
        
        <!-- Meta Tags pour TikTok -->
        <meta property="bytedance:description" content="Des forfaits web adaptés à votre budget. Site professionnel à partir de X€." />
    </Head>

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
        <Pricing />
        <ComparisonTable />
        <AdditionalOptions />
        <Footer />
        <CookieConsent />
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from './componentsHome/Header.vue';
import Footer from './componentsHome/Footer.vue';
import ComparisonTable from './componentsTarifs/ComparisonTable.vue';
import AdditionalOptions from './componentsTarifs/AdditionalOptions.vue';
import Pricing from './componentsHome/Pricing.vue';
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

