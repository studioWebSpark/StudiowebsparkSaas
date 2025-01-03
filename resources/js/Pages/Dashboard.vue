<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

// Vérifiez que la route est disponible
console.log('Route clients.index:', route('clients.index')); // Pour déboguer

const isSidebarOpen = ref(true);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};
</script>

<template>
    <AppLayout title="Tableau de bord">
        <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Sidebar -->
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
                    <Link :href="route('dashboard')"
                        class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class='bx bxs-dashboard text-2xl'></i>
                    <span :class="{ 'hidden': !isSidebarOpen }">Tableau de bord</span>
                    </Link>

                    <Link :href="route('orders.index')"
                        class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class='bx bx-shopping-bag text-2xl'></i>
                    <span :class="{ 'hidden': !isSidebarOpen }">Commandes</span>
                    </Link>

                    <Link :href="route('projects.index')"
                        class="flex items-center w-full space-x-3 mb-6 py-3 px-4 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class='bx bx-briefcase text-2xl'></i>
                    <span :class="{ 'hidden': !isSidebarOpen }">Projets</span>
                    </Link>

                    <Link href="#"
                        class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class='bx bx-cog text-2xl'></i>
                    <span :class="{ 'hidden': !isSidebarOpen }">Paramètres</span>
                    </Link>
                </nav>
            </div>

            <!-- Main Content -->
            <div :class="[
                'transition-all duration-300 ease-in-out',
                'flex-1',
                isSidebarOpen ? 'ml-64' : 'ml-20'
            ]">
                <div class="py-12 px-6">
                    <!-- Page d'accueil du Dashboard -->
                    <div class="max-w-7xl mx-auto">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">
                            <div class="text-center mb-8">
                                <i class='bx bxs-dashboard text-5xl text-green-600 dark:text-green-400'></i>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-4">
                                    Bienvenue dans votre espace administrateur
                                </h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-2">
                                    Gérez vos commandes et clients en toute simplicité
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                                <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <i class='bx bx-shopping-bag text-3xl text-blue-600 dark:text-blue-400 mb-4'></i>
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        Gestion des commandes
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        Suivez et gérez toutes vos commandes. Consultez les statistiques et l'état des
                                        paiements.
                                    </p>
                                </div>

                                <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <i class='bx bx-user text-3xl text-purple-600 dark:text-purple-400 mb-4'></i>
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        Gestion des clients
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        Accédez aux informations de vos clients et gérez leurs profils.
                                    </p>
                                </div>

                                <div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <i class='bx bx-cog text-3xl text-gray-600 dark:text-gray-400 mb-4'></i>
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        Paramètres
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        Configurez les paramètres de votre tableau de bord et gérez les accès.
                                    </p>
                                </div>
                            </div>

                            <div class="mt-12 text-center">
                                <p class="text-gray-600 dark:text-gray-400">
                                    Besoin d'aide ? Consultez notre documentation ou contactez le support.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.sidebar-enter-active,
.sidebar-leave-active {
    transition: transform 0.3s ease;
}

.sidebar-enter-from,
.sidebar-leave-to {
    transform: translateX(-100%);
}
</style>
