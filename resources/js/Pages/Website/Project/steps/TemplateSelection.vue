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
            <div class="text-sm text-green-600 dark:text-green-400 mb-4">
                {{ forfaitMessage }}
            </div>

            <!-- Filtres -->
            <div class="flex flex-wrap gap-4 justify-center sm:justify-start">
                <button v-for="category in availableCategories" :key="category" @click="selectedCategory = category"
                    :class="[
                        'px-4 py-2 rounded-full text-sm font-medium transition-colors',
                        selectedCategory === category
                            ? 'bg-green-600 text-white'
                            : 'bg-gray-100 text-gray-700 hover:bg-green-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'
                    ]">
                    {{ category }}
                </button>
            </div>

            <!-- Grille des templates -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                <div v-for="template in availableTemplates" :key="template.id" class="relative group">
                    <!-- Card du template -->
                    <div :class="[
                        'relative rounded-lg border-2 overflow-hidden transition-all cursor-pointer h-full',
                        isTemplateSelected(template.id)
                            ? 'border-green-500 ring-2 ring-green-500'
                            : 'border-gray-200 dark:border-gray-700 hover:border-green-300'
                    ]">
                        <!-- Image du template avec overlay -->
                        <div class="aspect-w-16 aspect-h-9 bg-gray-100 relative">
                            <img :src="template.image" :alt="template.name" class="object-cover w-full h-full">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all flex items-center justify-center">
                                <button @click="openPreview(template)"
                                    class="opacity-0 group-hover:opacity-100 bg-green-600 text-white px-4 py-2 rounded-lg transform scale-95 group-hover:scale-100 transition-all hover:bg-green-700">
                                    Aperçu
                                </button>
                            </div>
                        </div>

                        <!-- Informations du template -->
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ template.name }}
                                </h3>
                                <span v-if="template.isPro"
                                    class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                    PRO
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                {{ template.description }}
                            </p>
                            <button @click="selectTemplate(template)"
                                class="w-full px-4 py-2 text-sm font-medium rounded-lg transition-colors" :class="[
                                    isTemplateSelected(template.id)
                                        ? 'bg-green-600 text-white hover:bg-green-700'
                                        : 'bg-gray-100 text-gray-700 hover:bg-green-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'
                                ]">
                                {{ isTemplateSelected(template.id) ? 'Sélectionné' : 'Sélectionner' }}
                            </button>
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
                    <div class="fixed inset-0 bg-black bg-opacity-95" />
                </TransitionChild>

                <div class="fixed inset-0">
                    <div class="absolute inset-0 flex items-center justify-center p-0">
                        <TransitionChild enter="ease-out duration-300" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="ease-in duration-200"
                            leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                            <DialogPanel class="w-screen h-screen transform bg-transparent transition-all relative">
                                <!-- Boutons de contrôle -->
                                <div class="absolute top-6 right-6 z-50 flex items-center space-x-4">
                                    <button @click="selectTemplate(selectedTemplate)"
                                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center">
                                        <i class='bx bx-check mr-2'></i>
                                        {{ isTemplateSelected(selectedTemplate?.id) ? 'Sélectionné' : 'Sélectionner' }}
                                    </button>
                                    <button @click="closePreview"
                                        class="p-2 bg-white rounded-full shadow-lg hover:bg-gray-100 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Container de l'image avec zoom -->
                                <div class="h-screen w-screen flex items-center justify-center p-8">
                                    <div class="relative group w-full h-full">
                                        <img :src="selectedTemplate?.image" :alt="selectedTemplate?.name"
                                            class="w-full h-full object-contain rounded-lg transform transition-transform duration-300"
                                            :class="{ 'scale-150': isZoomed }" @click="toggleZoom">

                                        <!-- Informations du template -->
                                        <div v-show="!isZoomed"
                                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-8 text-white">
                                            <div class="max-w-4xl mx-auto">
                                                <h3 class="text-2xl font-semibold mb-2">
                                                    {{ selectedTemplate?.name }}
                                                    <span v-if="selectedTemplate?.isPro"
                                                        class="ml-2 px-2 py-1 text-xs font-medium bg-green-600 rounded-full">
                                                        PRO
                                                    </span>
                                                </h3>
                                                <p class="text-lg opacity-90">
                                                    {{ selectedTemplate?.description }}
                                                </p>
                                                <p class="mt-2 text-sm opacity-75">
                                                    Cliquez sur l'image pour zoomer/dézoomer
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Nouvelle section pour le template sélectionné -->
        <div v-if="selectedTemplates.length > 0" class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                Template Sélectionné
            </h2>

            <div class="flex items-start space-x-6">
                <!-- Aperçu du template -->
                <div class="relative group flex-shrink-0 w-1/3">
                    <img :src="selectedTemplateDetails?.thumbnail || selectedTemplateDetails?.image"
                        :alt="selectedTemplateDetails?.name" class="w-full h-auto rounded-lg object-cover">

                    <button @click="openPreview(selectedTemplateDetails)"
                        class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all">
                        <span
                            class="opacity-0 group-hover:opacity-100 px-4 py-2 bg-green-600 text-white rounded-lg transform scale-95 group-hover:scale-100 transition-all">
                            Voir l'aperçu
                        </span>
                    </button>
                </div>

                <!-- Informations du template -->
                <div class="flex-grow">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ selectedTemplateDetails?.name }}
                            <span v-if="selectedTemplateDetails?.isPro"
                                class="ml-2 px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200 rounded-full">
                                PRO
                            </span>
                        </h3>
                        <button @click="removeTemplate(selectedTemplateDetails)"
                            class="text-gray-400 hover:text-red-500 transition-colors">
                            <i class='bx bx-x text-xl'></i>
                        </button>
                    </div>

                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        {{ selectedTemplateDetails?.description }}
                    </p>

                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <i class='bx bx-category-alt mr-2'></i>
                        <span>{{ selectedTemplateDetails?.category }}</span>
                    </div>
                </div>
            </div>
        </div>
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
const isZoomed = ref(false);
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
    isValidated: false
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

    // Mettre à jour la sélection
    localFormData.value = {
        selectedTemplates: [template.id],
        isValidated: true
    };

    // Émettre la mise à jour
    emit('update:formData', {
        ...props.formData,
        template: {
            selectedTemplates: [template.id],
            isValidated: true
        }
    });

    console.log('Template sélectionné:', {
        template: template.name,
        formData: localFormData.value
    });

    closePreview();
};

const openPreview = (template) => {
    selectedTemplate.value = template;
    isPreviewOpen.value = true;
};

const closePreview = () => {
    isPreviewOpen.value = false;
    isZoomed.value = false;
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

const toggleZoom = () => {
    isZoomed.value = !isZoomed.value;
};

const canSelectTemplate = (template) => {
    if (!template) return false;

    const maxTemplates = getMaxTemplates.value;
    const currentSelected = localFormData.value.selectedTemplates.length;

    return currentSelected < maxTemplates || isTemplateSelected(template.id);
};

// Computed property pour les templates sélectionnés
const selectedTemplates = computed(() => {
    return localFormData.value.selectedTemplates || [];
});

// Computed property pour obtenir les détails du template sélectionné
const selectedTemplateDetails = computed(() => {
    const selectedId = selectedTemplates.value[0]; // On prend le premier car on ne permet qu'une sélection
    return availableTemplates.value.find(template => template.id === selectedId);
});

// Fonction pour supprimer le template sélectionné
const removeTemplate = (template) => {
    if (!template) return;

    localFormData.value = {
        selectedTemplates: [],
        isValidated: false
    };

    emit('update:formData', {
        ...props.formData,
        template: {
            selectedTemplates: [],
            isValidated: false
        }
    });
};

watch(forfaitInfo, (newValue) => {
    console.log('=== INFORMATIONS DU FORFAIT ===');
    console.log('Forfait sélectionné:', newValue.selectedForfait);
    console.log('Détails du forfait:', newValue.forfaitDetails);
    console.log('Templates disponibles:', availableTemplates.value.length);
    console.log('==============================');
}, { immediate: true });

// S'assurer que le watcher synchronise correctement les données
watch(() => props.formData?.template, (newValue) => {
    if (newValue) {
        localFormData.value = {
            selectedTemplates: newValue.selectedTemplates || [],
            isValidated: newValue.isValidated || false
        };
    }
}, { deep: true, immediate: true });

// Modifier la méthode validate
const validate = () => {
    const isValid = localFormData.value.selectedTemplates.length > 0;

    // Mettre à jour isValidated
    localFormData.value.isValidated = isValid;

    // Émettre la mise à jour
    emit('update:formData', {
        ...props.formData,
        template: {
            ...localFormData.value,
            isValidated: isValid
        }
    });

    console.log('Validation du template:', {
        selectedTemplates: localFormData.value.selectedTemplates,
        isValidated: isValid
    });

    return isValid;
};

// Exposer la méthode de validation
defineExpose({
    validate
});
</script>

<style scoped>
.scale-150 {
    transform: scale(1.5);
}

/* Ajout de styles pour une meilleure gestion du zoom */
img {
    transition: transform 0.3s ease;
}

img:hover {
    cursor: zoom-in;
}

img.scale-150:hover {
    cursor: zoom-out;
}

/* Style pour le scrollbar en mode zoom */
.overflow-auto {
    scrollbar-width: thin;
    scrollbar-color: rgba(155, 155, 155, 0.5) transparent;
}

.overflow-auto::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.overflow-auto::-webkit-scrollbar-track {
    background: transparent;
}

.overflow-auto::-webkit-scrollbar-thumb {
    background-color: rgba(155, 155, 155, 0.5);
    border-radius: 3px;
}

/* Ajuster le style pour le mode plein écran */
.h-screen {
    height: 100vh;
}

.w-screen {
    width: 100vw;
}

/* Optimiser l'affichage de l'image */
.object-contain {
    object-fit: contain;
    max-width: 100%;
    max-height: 100%;
}

/* Améliorer la lisibilité du gradient */
.from-black {
    --tw-gradient-from: rgb(0 0 0 / 0.8);
    --tw-gradient-to: transparent;
}

/* Ajout de styles pour l'aperçu du template sélectionné */
.group:hover .group-hover\:bg-opacity-40 {
    --tw-bg-opacity: 0.4;
}

.group:hover .group-hover\:opacity-100 {
    opacity: 1;
}

.group:hover .group-hover\:scale-100 {
    --tw-scale-x: 1;
    --tw-scale-y: 1;
    transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
}

/* Ajustements pour grands écrans */
@media (min-width: 1536px) {
    .grid-cols-5 {
        grid-template-columns: repeat(5, minmax(0, 1fr));
    }
}

/* Ajustements pour la hauteur des cards */
.aspect-w-16.aspect-h-9 {
    position: relative;
    padding-bottom: 56.25%;
    /* 16:9 ratio */
}

.aspect-w-16.aspect-h-9 img {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    object-fit: cover;
}

/* Amélioration de la lisibilité sur grands écrans */
@media (min-width: 1920px) {
    .text-xl {
        font-size: 1.5rem;
    }

    .text-lg {
        font-size: 1.25rem;
    }

    .text-sm {
        font-size: 1rem;
    }
}
</style>