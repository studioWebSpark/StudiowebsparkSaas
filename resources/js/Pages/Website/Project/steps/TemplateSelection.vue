<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 sm:mb-6">
            Choisissez votre template
        </h2>

        <div v-if="!hasForfait" class="text-center p-8">
            <p class="text-gray-600 dark:text-gray-400">
                Veuillez d'abord sélectionner un forfait pour voir les templates disponibles
            </p>
        </div>

        <div v-else class="space-y-6">
            <div class="text-sm text-blue-600 dark:text-blue-400 mb-4">
                {{ forfaitMessage }}
            </div>

            <!-- Filtres -->
            <div class="flex flex-wrap gap-4">
                <button v-for="category in availableCategories" :key="category" @click="selectedCategory = category"
                    :class="[
                        'px-4 py-2 rounded-full text-sm font-medium transition-colors',
                        selectedCategory === category
                            ? 'bg-blue-600 text-white'
                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                    ]">
                    {{ category }}
                </button>
            </div>

            <!-- Grille des templates -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="template in availableTemplates" :key="template.id" class="relative group">
                    <!-- Card du template -->
                    <div :class="[
                        'relative rounded-lg border-2 overflow-hidden transition-all cursor-pointer',
                        isTemplateSelected(template.id)
                            ? 'border-blue-500 ring-2 ring-blue-500'
                            : 'border-gray-200 dark:border-gray-700 hover:border-blue-300'
                    ]">
                        <!-- Image du template avec overlay au hover -->
                        <div class="aspect-w-16 aspect-h-9 bg-gray-100 relative group">
                            <img :src="template.image" :alt="template.name" class="object-cover w-full h-full"
                                @click="openPreview(template)">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all flex items-center justify-center">
                                <button
                                    class="opacity-0 group-hover:opacity-100 bg-white text-gray-900 px-4 py-2 rounded-lg transform scale-95 group-hover:scale-100 transition-all">
                                    Aperçu
                                </button>
                            </div>
                        </div>

                        <!-- Informations du template -->
                        <div class="p-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ template.name }}
                                </h3>
                                <span v-if="template.isPro"
                                    class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    PRO
                                </span>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ template.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de prévisualisation -->
        <TransitionRoot appear :show="isPreviewOpen" as="template">
            <Dialog as="div" @close="closePreview" class="relative z-50">
                <TransitionChild enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                    leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-90" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-start justify-center p-4">
                        <TransitionChild enter="ease-out duration-300" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="ease-in duration-200"
                            leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                            <DialogPanel class="w-full max-w-5xl transform bg-transparent transition-all">
                                <!-- Bouton fermer en haut à droite -->
                                <button @click="closePreview"
                                    class="absolute top-4 right-4 z-50 p-2 bg-white rounded-full shadow-lg hover:bg-gray-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <!-- Container de l'image avec zoom -->
                                <div class="relative overflow-auto max-h-[85vh] rounded-lg">
                                    <div class="group relative">
                                        <img :src="selectedTemplate?.image" :alt="selectedTemplate?.name"
                                            class="w-full h-auto rounded-lg transform transition-transform duration-300 cursor-zoom-in"
                                            :class="{ 'scale-150': isZoomed }" @click="toggleZoom">

                                        <!-- Overlay avec informations -->
                                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 text-white transform transition-opacity duration-300"
                                            :class="{ 'opacity-0': isZoomed }">
                                            <h3 class="text-xl font-semibold mb-2">
                                                {{ selectedTemplate?.name }}
                                            </h3>
                                            <p class="text-sm opacity-90 mb-4">
                                                {{ selectedTemplate?.description }}
                                            </p>
                                            <button @click="selectTemplate(selectedTemplate)"
                                                :disabled="!canSelectTemplate(selectedTemplate)"
                                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                                                Sélectionner ce template
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Dialog, DialogPanel, TransitionRoot, TransitionChild } from '@headlessui/vue';

const props = defineProps({
    formData: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['update:formData']);

const selectedCategory = ref('Tous');
const isPreviewOpen = ref(false);
const selectedTemplate = ref(null);

const templates = [
    {
        id: 'template1',
        name: 'Business Basic',
        description: 'Template professionnel pour petites entreprises',
        image: 'https://placehold.co/600x400/e2e8f0/475569?text=Template+Business',
        category: 'Business',
        isPro: false
    },
    {
        id: 'template2',
        name: 'E-commerce Pro',
        description: 'Solution complète pour boutique en ligne',
        image: 'https://placehold.co/600x400/e2e8f0/475569?text=Template+E-commerce',
        category: 'E-commerce',
        isPro: true
    },
    {
        id: 'template3',
        name: 'Portfolio Creative',
        description: 'Mise en page moderne pour artistes',
        image: 'https://placehold.co/600x400/e2e8f0/475569?text=Template+Portfolio',
        category: 'Portfolio',
        isPro: false
    },
    {
        id: 'template4',
        name: 'Blog Standard',
        description: 'Design épuré pour les blogueurs',
        image: 'https://placehold.co/600x400/e2e8f0/475569?text=Template+Blog',
        category: 'Blog',
        isPro: false
    },
    {
        id: 'template5',
        name: 'Restaurant Premium',
        description: 'Template spécialisé pour restaurants',
        image: 'https://placehold.co/600x400/e2e8f0/475569?text=Template+Restaurant',
        category: 'Business',
        isPro: true
    }
];

const localFormData = ref({
    selectedTemplates: [],
    ...props.formData
});

const availableCategories = computed(() => {
    return ['Tous', ...new Set(templates.map(t => t.category))];
});

const forfaitInfo = computed(() => {
    return props.formData?.forfait || {};
});

const hasForfait = computed(() => {
    return forfaitInfo.value.selectedForfait && forfaitInfo.value.forfaitDetails;
});

const availableTemplates = computed(() => {
    if (!hasForfait.value) return [];

    let filtered = templates;

    if (selectedCategory.value !== 'Tous') {
        filtered = filtered.filter(t => t.category === selectedCategory.value);
    }

    // Filtrer selon le forfait sélectionné
    switch (forfaitInfo.value.selectedForfait) {
        case 'starter':
            return filtered.filter(t => !t.isPro).slice(0, 3);
        case 'standard':
            return filtered.slice(0, 5);
        case 'premium':
            return filtered;
        default:
            return [];
    }
});

const forfaitMessage = computed(() => {
    if (!hasForfait.value) return '';

    switch (forfaitInfo.value.selectedForfait) {
        case 'starter':
            return 'Forfait Starter : 3 templates disponibles';
        case 'standard':
            return 'Forfait Standard : 5 templates disponibles';
        case 'premium':
            return 'Forfait Premium : Tous les templates disponibles';
        default:
            return '';
    }
});

const isTemplateSelected = (templateId) => {
    return localFormData.value.selectedTemplates.includes(templateId);
};

const selectTemplate = (template) => {
    if (!template) return;

    const index = localFormData.value.selectedTemplates.indexOf(template.id);
    if (index === -1) {
        localFormData.value.selectedTemplates.push(template.id);
    } else {
        localFormData.value.selectedTemplates.splice(index, 1);
    }

    emit('update:formData', {
        ...props.formData,
        template: localFormData.value
    });
};

const openPreview = (template) => {
    selectedTemplate.value = template;
    isPreviewOpen.value = true;
};

const closePreview = () => {
    isPreviewOpen.value = false;
    selectedTemplate.value = null;
};

const getMaxTemplates = computed(() => {
    switch (props.formData.selectedForfait) {
        case 'starter': return 3;
        case 'standard': return 5;
        case 'premium': return 8;
        default: return 0;
    }
});

const isZoomed = ref(false);

const toggleZoom = () => {
    isZoomed.value = !isZoomed.value;
};

const canSelectTemplate = (template) => {
    if (!template) return false;

    const maxTemplates = getMaxTemplates.value;
    const currentSelected = localFormData.value.selectedTemplates.length;

    return currentSelected < maxTemplates || isTemplateSelected(template.id);
};

watch(forfaitInfo, (newValue) => {
    console.log('=== INFORMATIONS DU FORFAIT ===');
    console.log('Forfait sélectionné:', newValue.selectedForfait);
    console.log('Détails du forfait:', newValue.forfaitDetails);
    console.log('Templates disponibles:', availableTemplates.value.length);
    console.log('==============================');
}, { immediate: true });
</script>

<style scoped>
.cursor-zoom-in {
    cursor: zoom-in;
}

.cursor-zoom-out {
    cursor: zoom-out;
}

/* Ajout d'une transition fluide pour le zoom */
.scale-150 {
    transform: scale(1.5);
    cursor: zoom-out;
}
</style>