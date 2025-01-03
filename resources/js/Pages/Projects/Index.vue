<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';

import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    projects: {
        type: Array,
        required: true
    },
    successfulPayments: {
        type: Number,
        required: true
    },
    totalAmount: {
        type: Number,
        required: true
    }
});

const isSidebarOpen = ref(true);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const updateProjectStatus = (projectId, newStatus) => {
    router.put(route('projects.update-status', projectId), {
        status: newStatus
    });
};

const getStatusColor = (status) => {
    const colors = {
        'pending': 'bg-yellow-100 text-yellow-800',
        'in_progress': 'bg-blue-100 text-blue-800',
        'completed': 'bg-green-100 text-green-800'
    };
    return colors[status] || 'bg-gray-100 text-gray-800';
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
                                                                {{ project.order?.total_amount?.toLocaleString() }} €
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                {{ project.order?.paid_at }}
                                                            </td>
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                <div class="flex items-center justify-end space-x-3">
                                                                    <select :value="project.status"
                                                                        @change="updateProjectStatus(project.id, $event.target.value)"
                                                                        class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-sm">
                                                                        <option value="pending">En attente</option>
                                                                        <option value="in_progress">Début du projet
                                                                        </option>
                                                                        <option value="completed">Finalisation du projet
                                                                        </option>
                                                                    </select>

                                                                    <span
                                                                        :class="['px-2 py-1 rounded-full text-xs', getStatusColor(project.status)]">
                                                                        {{ project.status === 'pending' ? 'En attente' :
                                                                            project.status === 'in_progress' ? 'En cours' :
                                                                                project.status === 'completed' ? 'Terminé' :
                                                                        project.status }}
                                                                    </span>

                                                                    <Link v-if="project.id"
                                                                        :href="route('projects.show', project.id)"
                                                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">
                                                                    Détails
                                                                    </Link>
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
