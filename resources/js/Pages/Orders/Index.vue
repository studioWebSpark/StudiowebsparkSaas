<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

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
                        class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white">
                    <i class='bx bx-shopping-bag text-2xl'></i>
                    <span :class="{ 'hidden': !isSidebarOpen }">Commandes</span>
                    </Link>
                    <Link :href="route('projects.index')"
                        class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white">
                    <i class='bx bx-briefcase-alt text-2xl'></i>
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
                    <!-- Statistiques -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                                    <i class='bx bx-shopping-bag text-2xl text-green-600 dark:text-green-400'></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total des commandes</p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                        {{ stats.total_orders }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                                    <i class='bx bx-euro text-2xl text-blue-600 dark:text-blue-400'></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Montant total</p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                        {{ formatPrice(stats.total_amount) }}€
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                                    <i class='bx bx-time text-2xl text-yellow-600 dark:text-yellow-400'></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">En attente</p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                        {{ stats.pending_orders }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Liste des commandes -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Toutes les commandes
                                </h2>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="border-b dark:border-gray-700">
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                N° Commande
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Client
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Date
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Statut
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Montant
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <tr v-for="order in orders" :key="order.id"
                                            class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <Link :href="route('orders.show', order.id)"
                                                    class="text-green-600 hover:text-green-700 dark:text-green-400">
                                                #{{ order.order_number }}
                                                </Link>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ order.client_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ order.created_at }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span :class="[
                                                    'px-2 py-1 text-xs rounded-full',
                                                    getStatusColor(order.status)
                                                ]">
                                                    {{ getStatusText(order.status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap font-medium">
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
        </div>
    </AppLayout>
</template>