<template>
    <!-- Overlay pour mobile -->
    <div v-if="isMobileMenuOpen" @click="closeMobileMenu"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 z-20 lg:hidden">
    </div>

    <!-- Sidebar -->
    <div :class="[
        'transition-all duration-300 ease-in-out',
        'bg-white dark:bg-gray-800 shadow-xl',
        'fixed z-30',
        'h-screen',
        // Mobile: pleine largeur quand ouvert, caché quand fermé
        isMobileMenuOpen ? 'inset-0 lg:left-0' : '-left-full lg:left-0',
        // Desktop: largeur adaptative
        'lg:w-auto',
        // Largeur minimale sur desktop
        isSidebarOpen ? 'lg:w-64' : 'lg:w-20'
    ]">
        <!-- En-tête avec toggle -->
        <div class="flex items-center justify-between p-4">
            <h2 class="text-xl font-semibold dark:text-white" :class="{ 'lg:hidden': !isSidebarOpen }">
                Espace Client
            </h2>
            <!-- Toggle pour mobile -->
            <button @click="closeMobileMenu" class="p-2 lg:hidden">
                <i class='bx bx-x text-2xl'></i>
            </button>
            <!-- Toggle pour desktop -->
            <button @click="toggleSidebar"
                class="hidden lg:block p-2 absolute -right-3 top-10 bg-white dark:bg-gray-800 rounded-full shadow-md">
                <i class='bx text-xl transition-transform duration-300'
                    :class="[isSidebarOpen ? 'bx-chevron-left' : 'bx-chevron-right']"></i>
            </button>
        </div>

        <!-- Menu Items -->
        <nav class="mt-6 px-4">
            <!-- Dashboard -->
            <Link :href="route('client.dashboard')"
                class="flex items-center mb-4 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('client.dashboard') }">
            <i class='bx bx-home text-xl'></i>
            <span :class="['ml-3', { 'lg:hidden': !isSidebarOpen }]">Tableau de bord</span>
            </Link>

            <!-- Projets -->
            <Link :href="route('client.projects')"
                class="flex items-center mb-4 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('client.projects') }">
            <i class='bx bx-folder text-xl'></i>
            <span :class="['ml-3', { 'lg:hidden': !isSidebarOpen }]">Mes Projets</span>
            </Link>

            <!-- Commandes -->
            <Link :href="route('client.orders')"
                class="flex items-center mb-4 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('client.orders') }">
            <i class='bx bx-shopping-bag text-xl'></i>
            <span :class="['ml-3', { 'lg:hidden': !isSidebarOpen }]">Mes Commandes</span>
            </Link>

            <!-- Support -->
            <Link :href="route('client.support')"
                class="flex items-center mb-4 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('client.support') }">
            <i class='bx bx-help-circle text-xl'></i>
            <span :class="['ml-3', { 'lg:hidden': !isSidebarOpen }]">Support</span>
            </Link>

            <!-- Déconnexion -->
            <button @click="logout"
                class="flex items-center w-full py-3 px-4 rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                <i class='bx bx-log-out text-xl'></i>
                <span :class="['ml-3', { 'lg:hidden': !isSidebarOpen }]">Déconnexion</span>
            </button>
        </nav>
    </div>

    <!-- Bouton menu mobile -->
    <button @click="openMobileMenu"
        class="fixed top-4 left-4 z-20 lg:hidden bg-white dark:bg-gray-800 p-2 rounded-lg shadow-lg">
        <i class='bx bx-menu text-2xl'></i>
    </button>

    <!-- Main Content -->
    <div :class="[
        'transition-all duration-300 ease-in-out',
        'min-h-screen',
        'lg:ml-64',
        { 'lg:ml-20': !isSidebarOpen }
    ]">
        <div class="p-4 lg:p-8">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const isMobileMenuOpen = ref(false);
const isSidebarOpen = ref(true);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const openMobileMenu = () => {
    isMobileMenuOpen.value = true;
    document.body.style.overflow = 'hidden';
};

const closeMobileMenu = () => {
    isMobileMenuOpen.value = false;
    document.body.style.overflow = '';
};

const handleResize = () => {
    if (window.innerWidth >= 1024 && isMobileMenuOpen.value) {
        closeMobileMenu();
    }
};

onMounted(() => {
    window.addEventListener('resize', handleResize);
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', handleResize);
});

const logout = () => {
    router.post(route('logout'));
};
</script>

<style scoped>
/* Animation de la sidebar */
.sidebar-enter-active,
.sidebar-leave-active {
    transition: transform 0.3s ease-in-out;
}

.sidebar-enter-from,
.sidebar-leave-to {
    transform: translateX(-100%);
}

/* Styles pour les liens actifs */
.router-link-active {
    @apply bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white;
}

/* Amélioration de l'accessibilité pour le focus */
a:focus,
button:focus {
    @apply outline-none ring-2 ring-offset-2 ring-green-500;
}

/* Empêcher le défilement du body quand le menu mobile est ouvert */
:root {
    overflow-x: hidden;
}
</style>