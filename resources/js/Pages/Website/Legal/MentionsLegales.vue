<template>
    <div class="overflow-x-hidden relative">
        <!-- Fond global avec motif -->
        <div class="fixed inset-0 bg-blue-600">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="relative">
            <Header :is-dark-mode="isDarkMode" :is-menu-open="isMenuOpen" :is-mobile="isMobile"
                :show-categories="showCategories" @toggle-dark-mode="toggleDarkMode" @toggle-menu="toggleMenu"
                @toggle-categories="toggleCategories" @show-categories="showCategories = true"
                @hide-categories="hideCategories" />

            <!-- En-tête -->
            <div class="relative py-24">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-4xl font-bold text-white text-center">
                        Mentions Légales
                    </h1>
                    <p class="mt-4 text-white/90 text-center max-w-2xl mx-auto">
                        Informations légales et réglementaires concernant notre activité
                    </p>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] overflow-hidden">
                    <div class="p-8">
                        <!-- Section Éditeur -->
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <div class="p-3 bg-white/10 rounded-[32px]">
                                    <i class='bx bx-user text-2xl text-white'></i>
                                </div>
                                <h2 class="ml-4 text-2xl font-semibold text-white">
                                    Éditeur du site
                                </h2>
                            </div>
                            <div class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] p-6">
                                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-white/70">Entreprise</dt>
                                        <dd class="mt-1 text-white">StudioWebSpark</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-white/70">Statut</dt>
                                        <dd class="mt-1 text-white">Entrepreneur individuel</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-white/70">SIRET</dt>
                                        <dd class="mt-1 text-white">90476131900022</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-white/70">Adresse</dt>
                                        <dd class="mt-1 text-white">Les Merles 62219 Longuenesse</dd>
                                    </div>
                                </dl>
                            </div>
                        </section>

                        <!-- Section Hébergement -->
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <div class="p-3 bg-white/10 rounded-[32px]">
                                    <i class='bx bx-server text-2xl text-white'></i>
                                </div>
                                <h2 class="ml-4 text-2xl font-semibold text-white">
                                    Hébergement
                                </h2>
                            </div>
                            <div class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] p-6">
                                <dl class="grid grid-cols-1 gap-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-white/70">Hébergeur</dt>
                                        <dd class="mt-1 text-white">[Nom de l'hébergeur]</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-white/70">Adresse</dt>
                                        <dd class="mt-1 text-white">[Adresse de l'hébergeur]</dd>
                                    </div>
                                </dl>
                            </div>
                        </section>

                        <!-- Section Propriété intellectuelle -->
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <div class="p-3 bg-white/10 rounded-[32px]">
                                    <i class='bx bx-copyright text-2xl text-white'></i>
                                </div>
                                <h2 class="ml-4 text-2xl font-semibold text-white">
                                    Propriété intellectuelle
                                </h2>
                            </div>
                            <div class="prose prose-invert max-w-none text-white/90">
                                <p>L'ensemble de ce site relève de la législation française et internationale sur le
                                    droit
                                    d'auteur et la propriété intellectuelle. Tous les droits de reproduction sont
                                    réservés,
                                    y compris pour les documents téléchargeables et les représentations iconographiques
                                    et
                                    photographiques.</p>
                            </div>
                        </section>

                        <!-- Section Contact -->
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <div class="p-3 bg-white/10 rounded-[32px]">
                                    <i class='bx bx-envelope text-2xl text-white'></i>
                                </div>
                                <h2 class="ml-4 text-2xl font-semibold text-white">
                                    Contact
                                </h2>
                            </div>
                            <div class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-medium text-white mb-4">
                                            Nous contacter
                                        </h3>
                                        <dl class="space-y-4">
                                            <div>
                                                <dt class="text-sm font-medium text-white/70">Email</dt>
                                                <dd class="mt-1 text-white">studiowebspark@gmail.com</dd>
                                            </div>
                                            <div>
                                                <dt class="text-sm font-medium text-white/70">Téléphone</dt>
                                                <dd class="mt-1 text-white">+33 7 67 17 57 24</dd>
                                            </div>
                                        </dl>
                                    </div>
                                    <div class="flex-1">
                                        <div class="h-48 bg-white/10 rounded-[32px] overflow-hidden">
                                            <!-- Emplacement pour une carte ou une image -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </div>
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