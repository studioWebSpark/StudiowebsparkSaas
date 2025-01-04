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
            <!-- Dashboard -->
            <Link :href="route('client.dashboard')"
                class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('client.dashboard') }">
            <i class='bx bx-home text-2xl'></i>
            <span :class="{ 'hidden': !isSidebarOpen }">Tableau de bord</span>
            </Link>

            <!-- Projets -->
            <Link :href="route('client.projects')"
                class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('client.projects') }">
            <i class='bx bx-folder text-2xl'></i>
            <span :class="{ 'hidden': !isSidebarOpen }">Mes Projets</span>
            </Link>

            <!-- Commandes -->
            <Link :href="route('client.orders')"
                class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('client.orders') }">
            <i class='bx bx-shopping-bag text-2xl'></i>
            <span :class="{ 'hidden': !isSidebarOpen }">Mes Commandes</span>
            </Link>

            <!-- Support -->
            <Link :href="route('client.support')"
                class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="{ 'bg-gray-100 dark:bg-gray-700': route().current('client.support') }">
            <i class='bx bx-help-circle text-2xl'></i>
            <span :class="{ 'hidden': !isSidebarOpen }">Support</span>
            </Link>

            <!-- Déconnexion -->
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