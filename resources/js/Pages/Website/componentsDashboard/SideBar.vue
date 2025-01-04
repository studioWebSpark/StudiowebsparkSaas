<template>
    <div :class="[
        'transition-all duration-300 ease-in-out',
        'bg-white dark:bg-gray-800 shadow-xl',
        'h-screen fixed left-0 top-0 z-30',
        isSidebarOpen ? 'w-64' : 'w-20'
    ]">
        <!-- Toggle Button -->
        <button @click="toggleSidebar"
            class="absolute -right-3 top-10 bg-white dark:bg-gray-800 rounded-full p-1 shadow-md">
            <i :class="[
                'bx text-xl',
                isSidebarOpen ? 'bx-chevron-left' : 'bx-chevron-right'
            ]"></i>
        </button>

        <!-- Menu Items -->
        <nav class="mt-20 px-4">
            <Link :href="route('admin.dashboard')"
                class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white': route().current('admin.dashboard') }">
            <i class='bx bxs-dashboard text-2xl'></i>
            <span :class="{ 'hidden': !isSidebarOpen }">Tableau de bord</span>
            </Link>

            <Link :href="route('orders.index')"
                class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white': route().current('orders.index') }">
            <i class='bx bx-shopping-bag text-2xl'></i>
            <span :class="{ 'hidden': !isSidebarOpen }">Commandes</span>
            </Link>

            <Link :href="route('admin.projects.index')"
                class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white': route().current('admin.projects.index') }">
            <i class='bx bx-briefcase text-2xl'></i>
            <span :class="{ 'hidden': !isSidebarOpen }">Projets</span>
            </Link>

            <Link :href="route('statistics.index')"
                class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white': route().current('statistics.index') }">
            <i class='bx bx-bar-chart-alt-2 text-2xl'></i>
            <span :class="{ 'hidden': !isSidebarOpen }">Statistiques</span>
            </Link>

            <Link :href="route('clients.index')"
                class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white': route().current('clients.index') }">
            <i class='bx bx-user text-2xl'></i>
            <span :class="{ 'hidden': !isSidebarOpen }">Clients</span>
            </Link>

            <!-- Déconnexion en bas de la sidebar -->
            <div class="absolute bottom-8 left-0 w-full px-4">
                <button @click="logout"
                    class="flex items-center space-x-3 w-full py-3 px-4 rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                    <i class='bx bx-log-out text-2xl'></i>
                    <span :class="{ 'hidden': !isSidebarOpen }">Déconnexion</span>
                </button>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div :class="[
        'transition-all duration-300 ease-in-out',
        'flex-1',
        isSidebarOpen ? 'ml-64' : 'ml-20'
    ]">
        <slot></slot>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const isSidebarOpen = ref(true);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<style scoped>
.router-link-active {
    @apply bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white;
}
</style>