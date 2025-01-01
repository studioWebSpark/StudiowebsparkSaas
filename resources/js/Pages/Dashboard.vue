<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    recentOrders: {
        type: Object,
        required: true
    },
    stats: {
        type: Object,
        required: true
    }
});

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
    <AppLayout title="Tableau de bord">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                <!-- Commandes récentes -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Commandes récentes
                            </h2>
                            <Link :href="route('orders.index')"
                                class="text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                            Voir tout
                            <i class='bx bx-right-arrow-alt inline-block ml-1'></i>
                            </Link>
                        </div>

                        <div class="space-y-4">
                            <div v-for="order in recentOrders" :key="order.id"
                                class="border dark:border-gray-700 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <Link :href="route('orders.show', order.id)"
                                            class="text-gray-900 dark:text-white hover:text-green-600 dark:hover:text-green-400">
                                        #{{ order.order_number }}
                                        </Link>
                                        <span :class="[
                                            'px-2 py-1 text-xs rounded-full',
                                            getStatusColor(order.status)
                                        ]">
                                            {{ getStatusText(order.status) }}
                                        </span>
                                    </div>
                                    <span class="font-semibold text-gray-900 dark:text-white">
                                        {{ formatPrice(order.total_amount) }}€
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
