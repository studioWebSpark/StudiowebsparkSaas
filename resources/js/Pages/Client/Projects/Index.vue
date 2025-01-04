<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SideBarClient from '@/Pages/Website/componentsDashboard/SideBarClient.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    projects: Array
});

const getStatusLabel = (status) => {
    const labels = {
        'pending': 'En attente',
        'development': 'En développement',
        'finalizing': 'Finalisation',
        'production': 'En production',
        'completed': 'Terminé'
    };
    return labels[status] || status;
};

const getStatusClass = (status) => {
    const classes = {
        'pending': 'bg-yellow-100 text-yellow-800',
        'development': 'bg-blue-100 text-blue-800',
        'finalizing': 'bg-purple-100 text-purple-800',
        'production': 'bg-indigo-100 text-indigo-800',
        'completed': 'bg-green-100 text-green-800'
    };
    return classes[status] || 'bg-gray-100 text-gray-800';
};

const getProgressByStatus = (status) => {
    const progress = {
        'pending': 0,
        'development': 25,
        'finalizing': 50,
        'production': 75,
        'completed': 100
    };
    return progress[status] || 0;
};
</script>

<template>
    <AppLayout title="Mes Projets">
        <SideBarClient>
            <div class="py-12 px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-xl font-semibold mb-6">Mes projets</h2>

                        <!-- Version desktop -->
                        <div class="hidden sm:block">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            N° Commande
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Type
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Statut
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr v-for="project in projects" :key="project.id">
                                        <td class="px-6 py-4">#{{ project.order_number }}</td>
                                        <td class="px-6 py-4">{{ project.project_type }}</td>
                                        <td class="px-6 py-4">
                                            <span :class="[
                                                'px-2 py-1 text-xs rounded-full',
                                                getStatusClass(project.status)
                                            ]">
                                                {{ getStatusLabel(project.status) }}
                                            </span>
                                        </td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Version mobile -->
                        <div class="sm:hidden space-y-4">
                            <div v-for="project in projects" :key="project.id"
                                class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-medium">#{{ project.order_number }}</p>
                                        <p class="text-sm text-gray-500">{{ project.project_type }}</p>
                                    </div>
                                    <span :class="[
                                        'px-2 py-1 text-xs rounded-full',
                                        getStatusClass(project.status)
                                    ]">
                                        {{ getStatusLabel(project.status) }}
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