<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">
            Détails de votre projet
        </h2>

        <div class="space-y-6">
            <!-- Type de projet -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Type de projet
                </label>
                <select v-model="localFormData.projectType"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                    <option value="site-vitrine">Site Vitrine</option>
                    <option value="e-commerce">E-commerce</option>
                    <option value="blog">Blog</option>
                    <option value="application">Application Web</option>
                    <option value="autre">Autre</option>
                </select>
            </div>

            <!-- Délai -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Délai souhaité
                </label>
                <select v-model="localFormData.deadline"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                    <option value="urgent">Urgent 24h</option>
                    <option value="normal">Normal 3 jours</option>
                    <option value="flexible">Flexible 5 jours</option>
                    <option value="non-urgent">Non urgent (1 semaine)</option>
                </select>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Description du projet
                </label>
                <textarea v-model="localFormData.description" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600"
                    placeholder="Décrivez votre projet en détail..."></textarea>
            </div>

            <!-- Fonctionnalités souhaitées -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Fonctionnalités souhaitées
                </label>
                <div class="space-y-2">
                    <label class="flex items-center" v-for="feature in features" :key="feature.id">
                        <input type="checkbox" v-model="localFormData.selectedFeatures" :value="feature.id"
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ feature.name }}</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    formData: {
        type: Object,
        required: true
    }
})

const emit = defineEmits(['update:formData'])

const features = [
    { id: 'responsive', name: 'Site Responsive' },
    { id: 'seo', name: 'Optimisation SEO' },
    { id: 'contact', name: 'Formulaire de contact' },
    { id: 'newsletter', name: 'Newsletter' },
    { id: 'blog', name: 'Section Blog' },
    { id: 'social', name: 'Intégration réseaux sociaux' },
    { id: 'multilang', name: 'Multi-langues' }
]

const localFormData = ref({
    projectType: '',
    budget: '',
    deadline: '',
    description: '',
    selectedFeatures: [],
    ...props.formData.project
})

watch(localFormData, (newValue) => {
    emit('update:formData', { project: newValue })
}, { deep: true })
</script>