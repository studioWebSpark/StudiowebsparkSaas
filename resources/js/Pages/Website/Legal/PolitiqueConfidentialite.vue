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
                        Politique de Confidentialité
                    </h1>
                    <p class="mt-4 text-white/90 text-center max-w-2xl mx-auto">
                        Comment nous protégeons et utilisons vos données personnelles
                    </p>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] overflow-hidden">
                    <div class="p-8">
                        <!-- Introduction -->
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <div class="p-3 bg-white/10 rounded-[32px]">
                                    <i class='bx bx-shield text-2xl text-white'></i>
                                </div>
                                <h2 class="ml-4 text-2xl font-semibold text-white">
                                    Introduction
                                </h2>
                            </div>
                            <div class="text-white/90">
                                <p>La protection de vos données personnelles est une priorité pour nous...</p>
                            </div>
                        </section>

                        <!-- Données collectées -->
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <div class="p-3 bg-white/10 rounded-[32px]">
                                    <i class='bx bx-data text-2xl text-white'></i>
                                </div>
                                <h2 class="ml-4 text-2xl font-semibold text-white">
                                    Données collectées
                                </h2>
                            </div>
                            <div class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex items-start space-x-4">
                                        <div class="p-3 bg-white/10 rounded-[32px]">
                                            <i class='bx bx-user text-xl text-white'></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-white">
                                                Données d'identification
                                            </h3>
                                            <p class="mt-1 text-sm text-white/70">
                                                Nom, prénom, email
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-4">
                                        <div class="p-3 bg-white/10 rounded-[32px]">
                                            <i class='bx bx-phone text-xl text-white'></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-white">
                                                Données de contact
                                            </h3>
                                            <p class="mt-1 text-sm text-white/70">
                                                Adresse, téléphone
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-4">
                                        <div class="p-3 bg-white/10 rounded-[32px]">
                                            <i class='bx bx-network-chart text-xl text-white'></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-white">
                                                Données de connexion
                                            </h3>
                                            <p class="mt-1 text-sm text-white/70">
                                                Adresse IP, logs
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-4">
                                        <div class="p-3 bg-white/10 rounded-[32px]">
                                            <i class='bx bx-cookie text-xl text-white'></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-white">
                                                Cookies
                                            </h3>
                                            <p class="mt-1 text-sm text-white/70">
                                                Préférences, statistiques
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Vos droits -->
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <div class="p-3 bg-white/10 rounded-[32px]">
                                    <i class='bx bx-check-shield text-2xl text-white'></i>
                                </div>
                                <h2 class="ml-4 text-2xl font-semibold text-white">
                                    Vos droits
                                </h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div v-for="(droit, index) in droits" :key="index"
                                    class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] p-6">
                                    <h3 class="font-medium text-white mb-2">{{ droit.titre }}</h3>
                                    <p class="text-white/90">{{ droit.description }}</p>
                                </div>
                            </div>
                        </section>

                        <!-- Contact -->
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <div class="p-3 bg-white/10 rounded-[32px]">
                                    <i class='bx bx-envelope text-2xl text-white'></i>
                                </div>
                                <h2 class="ml-4 text-2xl font-semibold text-white">
                                    Nous contacter
                                </h2>
                            </div>
                            <div class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] p-6">
                                <p class="text-white/90 mb-4">
                                    Pour exercer vos droits ou pour toute question concernant vos données personnelles :
                                </p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="text-sm font-medium text-white/70">Email</h3>
                                        <p class="mt-2 text-white">studiowebspark@gmail.com</p>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-white/70">Adresse</h3>
                                        <p class="mt-2 text-white">Les Merles 62219 Longuenesse</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Pied de page -->
                <div class="mt-8 text-center text-sm text-white/70">
                    Dernière mise à jour : {{ new Date().toLocaleDateString('fr-FR') }}
                </div>
            </div>
        </div>
        <Footer />
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Header from '../componentsHome/Header.vue';
import Footer from '../componentsHome/Footer.vue';

const droits = [
    {
        titre: "Droit d'accès",
        description: "Vous pouvez accéder à vos données personnelles"
    },
    {
        titre: "Droit de rectification",
        description: "Vous pouvez demander la correction de vos données"
    },
    {
        titre: "Droit à l'effacement",
        description: "Vous pouvez demander la suppression de vos données"
    },
    {
        titre: "Droit à la portabilité",
        description: "Vous pouvez récupérer vos données dans un format structuré"
    },
    {
        titre: "Droit d'opposition",
        description: "Vous pouvez vous opposer au traitement de vos données"
    },
    {
        titre: "Droit de limitation",
        description: "Vous pouvez demander la limitation du traitement"
    }
];
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