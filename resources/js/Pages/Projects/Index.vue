<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';

import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import SideBar from '../Website/componentsDashboard/SideBar.vue';

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
        <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
            <SideBar />

            <!-- Contenu principal -->
            <div class="flex-1 w-full overflow-x-hidden mt-14">
                <div class="p-4 sm:p-6 lg:p-8">
                    <!-- Stats Cards - Ajout uniquement de cette section -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
                        <!-- Total Projets -->
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Projets</h3>
                                <i class='bx bx-folder text-xl text-blue-500'></i>
                            </div>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ projects.length }}
                            </p>
                        </div>

                        <!-- En Attente -->
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    {{ PROJECT_STATUSES.pending.label }}
                                </h3>
                                <i class='bx bx-time text-xl text-gray-500'></i>
                            </div>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ projects.filter(p => p.project_status?.status === 'pending').length }}
                            </p>
                        </div>

                        <!-- En Développement -->
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    {{ PROJECT_STATUSES.development.label }}
                                </h3>
                                <i class='bx bx-code-alt text-xl text-blue-500'></i>
                            </div>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ projects.filter(p => p.project_status?.status === 'development').length }}
                            </p>
                        </div>

                        <!-- En Production -->
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    {{ PROJECT_STATUSES.production.label }}
                                </h3>
                                <i class='bx bx-loader text-xl text-purple-500'></i>
                            </div>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ projects.filter(p => p.project_status?.status === 'production').length }}
                            </p>
                        </div>

                        <!-- Terminés -->
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    {{ PROJECT_STATUSES.completed.label }}
                                </h3>
                                <i class='bx bx-check-circle text-xl text-green-500'></i>
                            </div>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ projects.filter(p => p.project_status?.status === 'completed').length }}
                            </p>
                        </div>
                    </div>

                    <div class="max-w-full">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="p-4 sm:p-6">
                                <div class="flex flex-col">
                                    <div class="overflow-x-auto">
                                        <div class="inline-block min-w-full align-middle">
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
                                                                {{ project.order?.paid_at ? new
                                                                    Date(project.order.paid_at).toLocaleString('fr-FR', {
                                                                        year: 'numeric',
                                                                        month: '2-digit',
                                                                        day: '2-digit',
                                                                        hour: '2-digit',
                                                                        minute: '2-digit'
                                                                    }) : '' }}
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
