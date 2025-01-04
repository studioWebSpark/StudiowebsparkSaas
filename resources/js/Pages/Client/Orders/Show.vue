<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SideBarClient from '@/Pages/Website/componentsDashboard/SideBarClient.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    order: {
        type: Object,
        required: true
    }
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(price);
};

const getStatusClass = (status) => {
    switch (status) {
        case 'pending':
            return 'bg-yellow-100 text-yellow-800';
        case 'completed':
            return 'bg-green-100 text-green-800';
        case 'cancelled':
            return 'bg-red-100 text-red-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
};
</script>

<template>
    <AppLayout title="Détails de la commande">
        <SideBarClient>
            <div class="py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <!-- En-tête -->
                    <div class="mb-6">
                        <Link :href="route('client.orders')"
                            class="text-indigo-600 hover:text-indigo-900 mb-4 inline-flex items-center">
                        <i class='bx bx-arrow-back mr-2'></i>
                        Retour aux commandes
                        </Link>
                        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                            Commande #{{ order.order_number }}
                        </h1>
                    </div>

                    <!-- Détails de la commande -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                        <div class="p-6">
                            <!-- Informations principales -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                        Informations de la commande
                                    </h2>
                                    <div class="space-y-3">
                                        <div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Type de projet</span>
                                            <p class="text-gray-900 dark:text-white">{{ order.project_type }}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Date de
                                                commande</span>
                                            <p class="text-gray-900 dark:text-white">
                                                {{ new Date(order.created_at).toLocaleDateString('fr-FR') }}
                                            </p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Statut</span>
                                            <span :class="[
                                                'px-2 py-1 text-xs rounded-full inline-block mt-1',
                                                getStatusClass(order.status)
                                            ]">
                                                {{ order.status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                        Détails du forfait
                                    </h2>
                                    <div class="space-y-3">
                                        <div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Forfait
                                                sélectionné</span>
                                            <p class="text-gray-900 dark:text-white">{{ order.selected_forfait }}</p>
                                        </div>
                                        <div v-if="order.selected_options && order.selected_options.length">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Options
                                                sélectionnées</span>
                                            <ul class="mt-1 space-y-1">
                                                <li v-for="option in order.selected_options" :key="option.name"
                                                    class="text-gray-900 dark:text-white">
                                                    {{ option.name }} - {{ formatPrice(option.price) }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Montant total -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium text-gray-900 dark:text-white">Total</span>
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ formatPrice(order.total_amount) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </SideBarClient>
    </AppLayout>
</template>