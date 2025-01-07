<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import { defineProps } from 'vue';
import SideBar from './Website/componentsDashboard/SideBar.vue';

const props = defineProps({
    recentOrders: {
        type: Array,
        default: () => []
    },
    stats: {
        type: Object,
        default: () => ({
            total_orders: 0,
            total_amount: 0,
            pending_orders: 0
        })
    },
    orderStatuses: {
        type: Object,
        default: () => ({
            pending: 'En attente',
            completed: 'Payée'
        })
    },
    isAdmin: {
        type: Boolean,
        default: false
    },
    team: {
        type: Object,
        required: false,
        default: () => ({})
    },
    jetstream: {
        type: Object,
        required: true
    },
    auth: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <AppLayout title="Tableau de bord">
        <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
            <SideBar />

            <!-- Contenu principal -->
            <div class="flex-1 w-full overflow-x-hidden">
                <div class="p-4 sm:p-6 lg:p-8">
                    <!-- En-tête du dashboard -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-4 sm:p-6 mt-12">
                        <div class="text-center mb-6">
                            <i class='bx bxs-dashboard text-3xl sm:text-4xl text-green-600 dark:text-green-400'></i>
                            <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mt-3">
                                Bienvenue dans votre tableau de bord
                            </h1>
                        </div>

                        

                        <!-- Section des raccourcis -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Gestion des commandes -->
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <i class='bx bx-shopping-bag text-2xl text-blue-600 dark:text-blue-400 mb-3'></i>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                    Gestion des commandes
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Suivez et gérez toutes vos commandes et paiements.
                                </p>
                            </div>

                            <!-- Gestion des clients -->
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <i class='bx bx-user text-2xl text-purple-600 dark:text-purple-400 mb-3'></i>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                    Gestion des clients
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Accédez aux informations de vos clients.
                                </p>
                            </div>

                            <!-- Paramètres -->
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <i class='bx bx-cog text-2xl text-gray-600 dark:text-gray-400 mb-3'></i>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                    Paramètres
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Configurez les paramètres et les accès.
                                </p>
                            </div>
                        </div>

                        <!-- Message d'aide -->
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Besoin d'aide ? Contactez le support.
                            </p>
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
