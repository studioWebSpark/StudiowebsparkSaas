<template>
    <!-- Overlay pour mobile -->
    <div v-if="isMobileMenuOpen" @click="closeMobileMenu"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 z-20 md:hidden">
    </div>

    <!-- Sidebar -->
    <div :class="[
        'transition-all duration-300 ease-in-out',
        'bg-white dark:bg-gray-800 shadow-xl',
        'fixed z-30',
        'md:h-screen',
        isMobileMenuOpen ? 'inset-0' : '-left-64 md:left-0',
        'md:w-64'
    ]">
        <!-- En-tête mobile avec toggle -->
        <div class="flex items-center justify-between p-4">
            <h2 class="text-xl font-semibold dark:text-white">Menu Admin</h2>
            <!-- Toggle pour mobile -->
            <button @click="closeMobileMenu" class="p-2 md:hidden">
                <i class='bx bx-x text-2xl'></i>
            </button>
        </div>

        <!-- Menu Items dans un conteneur scrollable -->
        <div class="flex flex-col h-[calc(100%-80px)]"> <!-- Ajustement de la hauteur pour le footer -->
            <nav class="flex-1 mt-6 px-4 overflow-y-auto">
                <Link :href="route('admin.dashboard')"
                    class="flex items-center space-x-3 mb-4 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                    :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('admin.dashboard') }">
                <i class='bx bxs-dashboard text-xl md:text-2xl'></i>
                <span>Tableau de bord</span>
                </Link>

                <Link :href="route('orders.index')"
                    class="flex items-center space-x-3 mb-4 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                    :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('orders.index') }">
                <i class='bx bx-shopping-bag text-xl md:text-2xl'></i>
                <span>Commandes</span>
                </Link>

                <Link :href="route('admin.projects.index')"
                    class="flex items-center space-x-3 mb-4 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                    :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('admin.projects.index') }">
                <i class='bx bx-briefcase text-xl md:text-2xl'></i>
                <span>Projets</span>
                </Link>

                <Link :href="route('statistics.index')"
                    class="flex items-center space-x-3 mb-4 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                    :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('statistics.index') }">
                <i class='bx bx-bar-chart-alt-2 text-xl md:text-2xl'></i>
                <span>Statistiques</span>
                </Link>
            </nav>

            <!-- Footer avec toggle et déconnexion -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Menu Admin</span>
                    <!-- Toggle pour desktop -->
                    <button @click="toggleSidebar"
                        class="hidden md:block p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        <i class='bx bx-chevron-left text-xl transition-transform'
                            :class="{ 'rotate-180': !isSidebarOpen }"></i>
                    </button>
                </div>

                <!-- Bouton déconnexion -->
                <button @click="logout"
                    class="flex items-center space-x-3 w-full py-3 px-4 rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                    <i class='bx bx-log-out text-xl md:text-2xl'></i>
                    <span>Déconnexion</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Bouton menu mobile -->
    <button @click="openMobileMenu"
        class="fixed top-4 left-4 z-20 md:hidden bg-white dark:bg-gray-800 p-2 rounded-lg shadow-lg">
        <i class='bx bx-menu text-2xl'></i>
    </button>

    <!-- Main Content -->
    <div :class="[
        'transition-all duration-300 ease-in-out',
        'min-h-screen',
        'md:ml-64',
        { 'md:ml-20': !isSidebarOpen }
    ]">
        <div class="p-4 md:p-8">
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
    if (window.innerWidth >= 768 && isMobileMenuOpen.value) {
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