<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    order: {
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
    <AppLayout :title="`Commande #${order.order_number}`">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- En-tête avec navigation -->
                <div class="mb-6 flex items-center justify-between">
                    <Link :href="route('orders.index')"
                        class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <i class='bx bx-arrow-left mr-2'></i>
                    Retour aux commandes
                    </Link>
                    <span :class="[
                        'px-4 py-2 rounded-full text-sm font-medium',
                        getStatusColor(order.status)
                    ]">
                        {{ getStatusText(order.status) }}
                    </span>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg overflow-hidden">
                    <!-- En-tête de la commande -->
                    <div class="border-b border-gray-200 dark:border-gray-700 p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                                    Commande #{{ order.order_number }}
                                </h1>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Passée le {{ formatDate(order.created_at) }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Montant total</p>
                                <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                    {{ formatPrice(order.total_amount) }}€
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Contenu principal -->
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations client -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    Informations client
                                </h2>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Nom complet</p>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ order.first_name }} {{ order.last_name }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Téléphone</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.phone }}</p>
                                    </div>
                                    <div v-if="order.company_name">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Entreprise</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.company_name }}
                                        </p>
                                    </div>
                                    <div v-if="order.siren">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">SIREN</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.siren }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Détails du projet -->
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    Détails du projet
                                </h2>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Type de projet</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.project_type }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Description</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{
                                            order.project_description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Forfait et options -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    Forfait et options
                                </h2>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Forfait sélectionné</p>
                                        <div class="flex justify-between items-center mt-1">
                                            <p class="font-medium text-gray-900 dark:text-white">
                                                {{ order.forfait_name }}
                                            </p>
                                            <p class="font-semibold text-green-600 dark:text-green-400">
                                                {{ formatPrice(order.forfait_price) }}€
                                            </p>
                                        </div>
                                    </div>

                                    <div v-if="order.selected_options?.length">
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Options sélectionnées
                                        </p>
                                        <ul class="space-y-2">
                                            <li v-for="option in order.selected_options" :key="option.id"
                                                class="flex items-center justify-between p-2 bg-white dark:bg-gray-600 rounded">
                                                <span class="font-medium text-gray-900 dark:text-white">
                                                    {{ option.name }}
                                                </span>
                                                <span class="text-green-600 dark:text-green-400">
                                                    {{ formatPrice(option.price) }}€
                                                </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Plan de maintenance</p>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ order.maintenance_plan }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Template sélectionné -->
                            <div v-if="order.template_name" class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    Template sélectionné
                                </h2>
                                <div class="space-y-2">
                                    <p class="font-medium text-gray-900 dark:text-white">
                                        {{ order.template_name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pied de page -->
                    <div class="border-t border-gray-200 dark:border-gray-700 p-6">
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <p>Paiement {{ order.status === 'completed' ? 'effectué' : 'en attente' }}</p>
                                <p v-if="order.paid_at">
                                    Payé le {{ formatDate(order.paid_at) }}
                                </p>
                            </div>
                            <Link :href="route('orders.index')"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Retour à la liste
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>