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
        <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
            <SideBar />
            <div class="py-12 px-6">
                <!-- Votre contenu existant -->
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
