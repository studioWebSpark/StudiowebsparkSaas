<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import SideBar from '../Website/componentsDashboard/SideBar.vue';

const props = defineProps({
    orders: {
        type: Array,
        required: true
    },
    stats: {
        type: Object,
        required: true
    }
});

const isSidebarOpen = ref(true);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const formatPrice = (price) => {
    return Number(price).toLocaleString('fr-FR');
};

const getStatusColor = (status) => {
    switch (status) {
        case 'completed':
            return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300';
        case 'pending':
            return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300';
        case 'cancelled':
            return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300';
        default:
            return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300';
    }
};

const getStatusText = (status) => {
    switch (status) {
        case 'completed':
            return 'Payée';
        case 'pending':
            return 'En attente';
        case 'cancelled':
            return 'Annulée';
        default:
            return status;
    }
};
</script>

<template>
    <AppLayout title="Commandes">
        <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
            <SideBar />

            <!-- Contenu principal -->
            <div class="flex-1 w-full overflow-x-hidden">
                <div class="p-4 sm:p-6 lg:p-8">
                    <!-- En-tête -->
                    <div class="mb-6 mt-12" >
                        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 dark:text-white">
                            Gestion des commandes
                        </h1>
                        <p class="mt-2 text-sm sm:text-base text-gray-600 dark:text-gray-400">
                            Consultez et gérez toutes vos commandes
                        </p>
                    </div>

                    <!-- Stats rapides -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total commandes</h3>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ stats.total_orders }}</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Montant total</h3>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{
                                formatPrice(stats.total_amount) }}€</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">En attente</h3>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ stats.pending_orders }}
                            </p>
                        </div>
                    </div>

                    <!-- Tableau des commandes -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-4 py-3 sm:px-6 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300">
                                            Numéro
                                        </th>
                                        <th
                                            class="px-4 py-3 sm:px-6 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300">
                                            Client
                                        </th>
                                        <th
                                            class="px-4 py-3 sm:px-6 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300">
                                            Date
                                        </th>
                                        <th
                                            class="px-4 py-3 sm:px-6 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300">
                                            Statut
                                        </th>
                                        <th
                                            class="px-4 py-3 sm:px-6 text-left text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-300">
                                            Montant
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="order in orders" :key="order.id"
                                        class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-4 py-3 sm:px-6 whitespace-nowrap text-sm">
                                            <Link :href="route('orders.show', order.id)"
                                                class="text-green-600 hover:text-green-700 dark:text-green-400">
                                            #{{ order.order_number }}
                                            </Link>
                                        </td>
                                        <td class="px-4 py-3 sm:px-6 whitespace-nowrap text-sm">
                                            {{ order.client_name }}
                                        </td>
                                        <td class="px-4 py-3 sm:px-6 whitespace-nowrap text-sm">
                                            {{ order.created_at }}
                                        </td>
                                        <td class="px-4 py-3 sm:px-6 whitespace-nowrap">
                                            <span :class="[
                                                'px-2 py-1 text-xs rounded-full',
                                                getStatusColor(order.status)
                                            ]">
                                                {{ getStatusText(order.status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 sm:px-6 whitespace-nowrap text-sm font-medium">
                                            {{ formatPrice(order.total_amount) }}€
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>