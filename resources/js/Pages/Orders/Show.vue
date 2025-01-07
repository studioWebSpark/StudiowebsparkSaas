<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import SideBar from '../Website/componentsDashboard/SideBar.vue';

const props = defineProps({
    order: {
        type: Object,
        required: true
    },
    orderStatus: {
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

const includedOptionsByForfait = {
    premium: ['ecommerce', 'logoPhotos', 'socialMedia', 'Dashboard'],
    standard: ['logoPhotos', 'socialMedia'],
    starter: []
};

const optionNames = {
    ecommerce: 'E-commerce',
    logoPhotos: 'Logo et Photos',
    socialMedia: 'Réseaux Sociaux',
    Dashboard: 'Dashboard'
};

const getIncludedOptions = (forfaitType) => {
    return includedOptionsByForfait[forfaitType.toLowerCase()] || [];
};

const getAdditionalOptions = (forfaitType, selectedOptions) => {
    const included = new Set(includedOptionsByForfait[forfaitType.toLowerCase()] || []);
    return (selectedOptions || []).filter(option => !included.has(option.id));
};

const getOptionName = (optionId) => {
    return optionNames[optionId] || optionId;
};
</script>

<template>
    <AppLayout :title="`Détail de la commande #${order.order_number}`">
        <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
            <SideBar />

            <!-- Contenu principal -->
            <div class="flex-1 w-full overflow-x-hidden">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <!-- En-tête -->


                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mt-12">
                            <!-- En-tête de la commande -->
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                    Commande #{{ order.order_number }}
                                </h2>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Passée le {{ order.created_at }}
                                    <span :class="[
                                        'px-4 py-2 rounded-full text-sm font-semibold',
                                        getStatusColor(order.status)
                                    ]">
                                        {{ orderStatus[order.status] }}
                                    </span>
                                </p>

                            </div>

                            <!-- Informations client -->
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    Informations client
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Type de client</p>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ order.client_type === 'individual' ? 'Particulier' : 'Professionnel' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Nom complet</p>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ order.first_name }} {{ order.last_name }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Email</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Téléphone</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.phone }}</p>
                                    </div>
                                    <div v-if="order.company_name">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Entreprise</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.company_name }}
                                        </p>
                                    </div>
                                    <div v-if="order.activity">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Activité</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.activity }}</p>
                                    </div>
                                    <div v-if="order.siren">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">SIREN</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.siren }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Détails du projet -->
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    Détails du projet
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Type de projet</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.project_type }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Description</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{
                                            order.project_description }}</p>
                                    </div>
                                    <div v-if="order.selected_features && order.selected_features.length">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Fonctionnalités
                                            sélectionnées</p>
                                        <ul class="mt-2 space-y-2">
                                            <li v-for="feature in order.selected_features" :key="feature"
                                                class="flex items-center text-gray-900 dark:text-white">
                                                <i class='bx bx-check text-green-500 mr-2'></i>
                                                {{ feature }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Forfait et options -->
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    Forfait et options
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Forfait sélectionné</p>
                                        <div class="flex items-center justify-between mt-1">
                                            <p class="font-medium text-gray-900 dark:text-white">{{
                                                order.selected_forfait }}
                                            </p>
                                            <p class="font-semibold text-green-600 dark:text-green-400">
                                                {{ formatPrice(order.forfait_price) }}€
                                            </p>
                                        </div>
                                    </div>

                                    <div v-if="order.selected_options && order.selected_options.length">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Options supplémentaires</p>
                                        <ul class="mt-2 space-y-2">
                                            <li v-for="option in order.selected_options" :key="option.id"
                                                class="flex items-center justify-between">
                                                <span class="flex items-center text-gray-900 dark:text-white">
                                                    <i class='bx bx-plus text-blue-500 mr-2'></i>
                                                    {{ option.name }}
                                                </span>
                                                <span class="font-medium text-green-600 dark:text-green-400">
                                                    {{ formatPrice(option.price) }}€
                                                </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div v-if="order.maintenance_plan">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Plan de maintenance</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ order.maintenance_plan
                                            }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Template -->
                            <div v-if="order.template_name" class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    Template
                                </h3>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Template sélectionné</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ order.template_name }}</p>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="p-6">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total</h3>
                                    <p class="text-xl font-bold text-green-600 dark:text-green-400">
                                        {{ formatPrice(order.total_amount) }}€
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>