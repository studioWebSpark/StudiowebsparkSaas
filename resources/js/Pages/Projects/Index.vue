<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';

import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    projects: {
        type: Array,
        required: true
    },
    errors: {
        type: Object,
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

const projects = ref(props.projects);

const isSidebarOpen = ref(true);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

// Définir les statuts avec leurs détails
const PROJECT_STATUSES = {
    pending: {
        label: 'En attente',
        class: 'bg-gray-50 text-gray-800 border-gray-300 hover:bg-gray-100',
        gradientClass: 'from-gray-300 to-gray-400'
    },
    development: {
        label: 'En développement',
        class: 'bg-blue-50 text-blue-800 border-blue-300 hover:bg-blue-100',
        gradientClass: 'from-blue-400 to-blue-500'
    },
    production: {
        label: 'En production',
        class: 'bg-purple-50 text-purple-800 border-purple-300 hover:bg-purple-100',
        gradientClass: 'from-purple-400 to-purple-500'
    },
    completed: {
        label: 'Terminé',
        class: 'bg-green-50 text-green-800 border-green-300 hover:bg-green-100',
        gradientClass: 'from-green-400 to-green-500'
    }
};

// Stocker les statuts localement
const storedStatuses = ref({});

// Fonction pour récupérer le statut stocké
const getStoredStatus = (orderNumber) => {
    return storedStatuses.value[orderNumber] || 'pending';
};

// Fonction pour récupérer la progression stockée
const getStoredProgress = (orderNumber) => {
    return PROJECT_STATUSES[getStoredStatus(orderNumber)]?.progress || 0;
};

const updateProjectStatus = async (project, newStatus) => {
    try {
        const orderNumber = project.order.order_number;

        const response = await axios.patch(`/projects/${orderNumber}/status`, {
            status: newStatus,
            description: `Statut mis à jour vers : ${PROJECT_STATUSES[newStatus].label}`
        });

        if (response.data.success && response.data.project_status) {
            // Stocker le nouveau statut
            storedStatuses.value[orderNumber] = response.data.project_status.status;

            // Mettre à jour l'état du projet
            project.project_status = response.data.project_status;
        }
    } catch (error) {
        console.error('Erreur détaillée:', error.response?.data);
        console.error('Status:', error.response?.status);
        alert('Une erreur est survenue lors de la mise à jour du statut');
    }
};

// Au chargement, initialiser les statuts stockés
onMounted(async () => {
    try {
        const response = await axios.get('/api/project-statuses');
        storedStatuses.value = response.data.reduce((acc, status) => {
            acc[status.order_number] = status.status;
            return acc;
        }, {});
    } catch (error) {
        console.error('Erreur lors du chargement des statuts:', error);
    }
});

const getStatusColor = (status) => {
    const colors = {
        'pending': 'bg-yellow-100 text-yellow-800',
        'development': 'bg-blue-100 text-blue-800',
        'production': 'bg-orange-100 text-orange-800',
        'completed': 'bg-green-100 text-green-800'
    };
    return colors[status] || 'bg-gray-100 text-gray-800';
};

const getStatusLabel = (status) => {
    const labels = {
        'pending': 'En attente',
        'development': 'En cours de développement',

        'production': 'En production',
        'completed': 'Terminé'
    };
    return labels[status] || status;
};

const updateProgress = async (project, progress) => {
    try {
        await axios.patch(route('admin.projects.update-progress', project.order.id), {
            progress: Math.min(100, Math.max(0, parseInt(progress)))
        });

        window.location.reload();
    } catch (error) {
        console.error('Erreur lors de la mise à jour de la progression:', error);
        alert('Une erreur est survenue lors de la mise à jour de la progression');
    }
};

// Fonction utilitaire pour formater les montants
const formatAmount = (amount) => {
    if (!amount) return '0,00';

    // Convertir en nombre si c'est une chaîne
    const numAmount = typeof amount === 'string' ? parseFloat(amount) : amount;

    // Formater avec le séparateur de milliers et 2 décimales
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(numAmount);
};

// Fonction pour parser les montants avant envoi à l'API
const parseAmount = (amount) => {
    if (typeof amount === 'string') {
        // Enlever les espaces et remplacer la virgule par un point
        return parseFloat(amount.replace(/\s/g, '').replace(',', '.'));
    }
    return amount;
};
</script>

<template>
    <AppLayout title="Projets">
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
                        class="flex items-center space-x-3 mb-6 py-3 px-4 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white">
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
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div
                                                class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-700 sm:rounded-lg">
                                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                                        <tr>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                                N° Commande
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                                Client
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                                Type de projet
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                                Forfait
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                                Montant
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                                Date de paiement
                                                            </th>
                                                            <th scope="col"
                                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                                État
                                                            </th>
                                                            <th scope="col" class="relative px-6 py-3">
                                                                <span class="sr-only">Actions</span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody
                                                        class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                                        <tr v-for="project in projects"
                                                            :key="project.order.order_number">
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                {{ project.order?.order_number }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                <div
                                                                    class="text-sm font-medium text-gray-900 dark:text-white">
                                                                    {{ project.client_name }}
                                                                </div>
                                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                                    {{ project.order?.email }}
                                                                </div>
                                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                                    {{ project.order?.phone }}
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                <div class="text-sm text-gray-900 dark:text-white">
                                                                    {{ project.order?.project_type }}
                                                                </div>
                                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                                    {{ project.order?.template_name }}
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                {{ project.order?.selected_forfait }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                {{
                                                                    formatAmount(parseAmount(project.order?.total_amount))
                                                                }} €
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                {{ project.order?.paid_at }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="flex flex-col space-y-3">
                                                                    <!-- Status Selector avec Progress -->
                                                                    <div class="relative group">
                                                                        <select
                                                                            :value="project.project_status?.status || getStoredStatus(project.order.order_number)"
                                                                            @change="updateProjectStatus(project, $event.target.value)"
                                                                            :class="[
                                                                                'rounded-md border-gray-300 text-sm',
                                                                                PROJECT_STATUSES[project.project_status?.status || getStoredStatus(project.order.order_number)].class
                                                                            ]">
                                                                            <option
                                                                                v-for="(details, status) in PROJECT_STATUSES"
                                                                                :key="status" :value="status">
                                                                                {{ details.label }}
                                                                            </option>
                                                                        </select>

                                                                        <!-- Barre de progression -->
                                                                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700"
                                                                            :data-project-id="project.id">
                                                                            <div class="progress-bar h-2.5 rounded-full transition-all duration-300"
                                                                                :style="{ width: `${project.project_status?.progress || getStoredProgress(project.order.order_number)}%` }"
                                                                                :class="{
                                                                                    'bg-gray-600': project.project_status?.status === 'pending',
                                                                                    'bg-blue-600': project.project_status?.status === 'development',
                                                                                    'bg-purple-600': project.project_status?.status === 'production',
                                                                                    'bg-green-600': project.project_status?.status === 'completed'
                                                                                }"></div>
                                                                        </div>

                                                                        <!-- Pourcentage -->
                                                                        <span class="text-sm text-gray-600">
                                                                            {{ project.project_status?.progress ||
                                                                            getStoredProgress(project.order.order_number)
                                                                            }}%
                                                                        </span>
                                                                    </div>
                                                                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style scoped>
/* Styles pour le select */
select {
    background-image: none;
    /* Supprime l'icône par défaut */
}



/* Animation de la barre de progression */
.progress-transition {
    transition: width 0.5s ease-out;
}

/* Style pour l'input number */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}
</style>
