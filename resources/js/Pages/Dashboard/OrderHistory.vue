<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    orders: {
        type: Object,
        required: true
    }
});

const formatPrice = (price) => {
    return Number(price).toLocaleString('fr-FR');
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
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
    <AppLayout title="Historique des commandes">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">
                            Historique des commandes
                        </h2>

                        <!-- Liste des commandes -->
                        <div class="space-y-6">
                            <div v-for="order in orders.data" :key="order.id"
                                class="bg-white dark:bg-gray-700 border dark:border-gray-600 rounded-lg overflow-hidden">
                                <!-- En-tête de la commande -->
                                <div class="p-4 border-b dark:border-gray-600">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <span class="text-lg font-medium text-gray-900 dark:text-white">
                                                Commande #{{ order.order_number }}
                                            </span>
                                            <span :class="[
                                                'px-3 py-1 rounded-full text-sm font-medium',
                                                getStatusColor(order.status)
                                            ]">
                                                {{ getStatusText(order.status) }}
                                            </span>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ formatDate(order.created_at) }}
                                            </div>
                                            <div class="text-lg font-bold text-green-600 dark:text-green-400">
                                                {{ formatPrice(order.total_amount) }}€
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Détails de la commande -->
                                <div class="p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Informations du projet -->
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">
                                                Détails du projet
                                            </h4>
                                            <div class="space-y-2">
                                                <div>
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                                        Type de projet:
                                                    </span>
                                                    <span class="ml-2 text-gray-900 dark:text-white">
                                                        {{ order.project_type }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                                        Forfait:
                                                    </span>
                                                    <span class="ml-2 text-gray-900 dark:text-white">
                                                        {{ order.forfait_name }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                                        Maintenance:
                                                    </span>
                                                    <span class="ml-2 text-gray-900 dark:text-white">
                                                        {{ order.maintenance_plan }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Options sélectionnées -->
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">
                                                Options sélectionnées
                                            </h4>
                                            <div class="space-y-1">
                                                <div v-for="option in order.selected_options" :key="option.id"
                                                    class="flex items-center">
                                                    <i class='bx bx-check text-green-500 mr-2'></i>
                                                    <span class="text-gray-900 dark:text-white">
                                                        {{ option.name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="p-4 bg-gray-50 dark:bg-gray-600">
                                    <div class="flex justify-end space-x-4">
                                        <Link :href="route('orders.show', order.id)"
                                            class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                        Voir les détails
                                        <i class='bx bx-right-arrow-alt ml-2'></i>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div v-if="orders.links && orders.links.length > 3" class="mt-6">
                            <div class="flex justify-center">
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                    aria-label="Pagination">
                                    <Link v-for="(link, key) in orders.links" :key="key" :href="link.url"
                                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                        :class="[
                                            link.url === null ? 'cursor-not-allowed' : '',
                                            link.active
                                                ? 'z-10 bg-green-50 border-green-500 text-green-600'
                                                : 'bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600'
                                        ]" v-html="link.label" />
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>