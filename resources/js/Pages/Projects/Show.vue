<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    project: {
        type: Object,
        required: true
    }
});

const updateForm = ref({
    progress: props.project.progress || 0,
    current_step_description: props.project.current_step || '',
    status: props.project.status || 'pending'
});

const handleProgressChange = (event) => {
    updateForm.value.progress = parseInt(event.target.value);
};

const statusOptions = [
    { value: 'pending', label: 'En attente' },
    { value: 'in_progress', label: 'En cours' },
    { value: 'completed', label: 'Terminé' }
];

const updateProgress = () => {
    router.put(route('projects.update.progress', props.project.id), updateForm.value, {
        preserveScroll: true,
        onSuccess: () => {
            // Notification de succès si nécessaire
        }
    });
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(price);
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
    <AppLayout :title="'Projet - ' + project.client_name">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- En-tête du projet -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                    {{ project.client_name }}
                                </h1>
                                <p v-if="project.company_name" class="text-gray-600 dark:text-gray-400">
                                    {{ project.company_name }}
                                </p>
                            </div>
                            <span
                                :class="['px-3 py-1 rounded-full text-sm font-semibold', getStatusColor(project.status)]">
                                {{ project.status }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informations du projet -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Informations du projet
                            </h2>
                            <dl class="grid grid-cols-1 gap-4">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Type de projet</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2">
                                        {{ project.project_type }}
                                    </dd>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date de début</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2">
                                        {{ project.started_at }}
                                    </dd>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date limite</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2">
                                        {{ project.deadline }}
                                    </dd>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Prix total</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2">
                                        {{ formatPrice(project.total_price) }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Mise à jour de la progression -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                Mise à jour de la progression
                            </h2>
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                                <h3 class="text-lg font-medium mb-4">Progression du projet</h3>

                                <!-- Slider de progression -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Progression : {{ updateForm.progress }}%
                                    </label>
                                    <div class="flex items-center gap-4">
                                        <input type="range" v-model="updateForm.progress" @input="handleProgressChange"
                                            min="0" max="100" step="5"
                                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" />
                                        <span class="text-sm font-medium w-12">
                                            {{ updateForm.progress }}%
                                        </span>
                                    </div>
                                </div>

                                <!-- Barre de progression visuelle -->
                                <div class="w-full bg-gray-200 rounded-full h-4 mb-6 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-4 rounded-full transition-all duration-300"
                                        :style="{ width: `${updateForm.progress}%` }">
                                    </div>
                                </div>

                                <!-- Statut du projet -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Statut du projet
                                    </label>
                                    <select v-model="updateForm.status"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600">
                                        <option v-for="option in statusOptions" :key="option.value"
                                            :value="option.value">
                                            {{ option.label }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Description de l'étape -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Description de l'étape actuelle
                                    </label>
                                    <textarea v-model="updateForm.current_step_description" rows="3"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600"
                                        placeholder="Décrivez l'étape actuelle du projet..."></textarea>
                                </div>

                                <!-- Bouton de mise à jour -->
                                <div class="flex justify-end">
                                    <button @click="updateProgress"
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Mettre à jour la progression
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
/* Style personnalisé pour le slider */
input[type="range"] {
    -webkit-appearance: none;
    @apply bg-gray-200 dark:bg-gray-700 h-2 rounded-lg;
}

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    @apply w-4 h-4 bg-blue-600 rounded-full cursor-pointer;
    border: none;
}

input[type="range"]::-moz-range-thumb {
    @apply w-4 h-4 bg-blue-600 rounded-full cursor-pointer;
    border: none;
}
</style>