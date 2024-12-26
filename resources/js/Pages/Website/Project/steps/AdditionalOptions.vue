<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 sm:mb-6">
            Choisissez votre template
        </h2>

        <div v-if="!localFormData.selectedForfait" class="text-center p-8">
            <p class="text-gray-600 dark:text-gray-400">
                Veuillez d'abord sélectionner un forfait pour voir les templates disponibles
            </p>
        </div>

        <div v-else class="space-y-6">
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
                <div v-for="template in availableTemplates" :key="template.id" :class="[
                    'relative rounded-lg border-2 overflow-hidden transition-all',
                    isTemplateSelected(template.id)
                        ? 'border-blue-500 ring-2 ring-blue-500'
                        : 'border-gray-200 dark:border-gray-700 hover:border-blue-300'
                ]">

                    <!-- Image du template -->
                    <div class="aspect-w-16 aspect-h-9 bg-gray-100">
                        <img :src="template.image" :alt="template.name" class="object-cover">
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

                        <!-- Bouton de sélection -->
                        <button @click="selectTemplate(template)" :disabled="!canSelectTemplate(template)" :class="[
                            'mt-4 w-full rounded-lg px-4 py-3 text-sm font-semibold transition-colors',
                            isTemplateSelected(template.id)
                                ? 'bg-blue-600 text-white hover:bg-blue-700'
                                : canSelectTemplate(template)
                                    ? 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                                    : 'bg-gray-100 text-gray-400 cursor-not-allowed'
                        ]">
                            {{ isTemplateSelected(template.id) ? 'Sélectionné' : 'Sélectionner' }}
                        </button>
                    </div>

                    <!-- Indicateur de sélection -->
                    <div v-if="isTemplateSelected(template.id)"
                        class="absolute top-2 right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                        <i class='bx bx-check text-white'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue'

const props = defineProps({
    formData: {
        type: Object,
        required: true
    }
})

const emit = defineEmits(['update:formData', 'stepValidated'])

const selectedCategory = ref('Tous')

const templates = [
    {
        id: 'template1',
        name: 'Business Basic',
        description: 'Template professionnel pour petites entreprises',
        image: '/templates/business-basic.jpg',
        category: 'Business',
        isPro: false
    },
    // ... Ajoutez plus de templates ici
]

const localFormData = ref({
    selectedTemplates: [],
    ...props.formData.template
})

const availableCategories = computed(() => {
    return ['Tous', 'Business', 'E-commerce', 'Portfolio', 'Blog']
})

const availableTemplates = computed(() => {
    let filtered = templates

    if (selectedCategory.value !== 'Tous') {
        filtered = filtered.filter(t => t.category === selectedCategory.value)
    }

    // Filtrer selon le forfait sélectionné
    switch (props.formData.selectedForfait) {
        case 'starter':
            return filtered.filter(t => !t.isPro).slice(0, 3)
        case 'standard':
            return filtered.slice(0, 5)
        case 'premium':
            return filtered
        default:
            return []
    }
})

const canSelectTemplate = (template) => {
    if (!props.formData.selectedForfait) return false

    const currentSelected = localFormData.value.selectedTemplates.length

    switch (props.formData.selectedForfait) {
        case 'starter':
            return currentSelected < 3 || isTemplateSelected(template.id)
        case 'standard':
            const proTemplatesSelected = localFormData.value.selectedTemplates
                .filter(id => templates.find(t => t.id === id)?.isPro)
                .length
            if (template.isPro) {
                return (proTemplatesSelected < 2 || isTemplateSelected(template.id)) && currentSelected < 5
            }
            return currentSelected < 5 || isTemplateSelected(template.id)
        case 'premium':
            return true
        default:
            return false
    }
}

const isTemplateSelected = (templateId) => {
    return localFormData.value.selectedTemplates.includes(templateId)
}

const selectTemplate = (template) => {
    if (!canSelectTemplate(template)) return

    const index = localFormData.value.selectedTemplates.indexOf(template.id)
    if (index === -1) {
        localFormData.value.selectedTemplates.push(template.id)
    } else {
        localFormData.value.selectedTemplates.splice(index, 1)
    }
}

const validateForm = () => {
    const formDataToEmit = {
        ...props.formData,
        options: {
            ...localFormData.value,
            isValidated: true
        }
    }

    // Log détaillé des options additionnelles
    console.log('Données du formulaire Options :', {
        previousData: props.formData?.options,
        currentData: {
            selectedOptions: localFormData.value.selectedOptions,
            customRequests: localFormData.value.customRequests,
            isValidated: true
        },
        totals: {
            numberOfOptions: localFormData.value.selectedOptions?.length || 0,
            totalPrice: calculateTotal()
        },
        changes: {
            optionsChanged: JSON.stringify(props.formData?.options?.selectedOptions) !==
                JSON.stringify(localFormData.value.selectedOptions),
            requestsChanged: props.formData?.options?.customRequests !==
                localFormData.value.customRequests
        }
    });

    emit('update:formData', formDataToEmit)
    emit('stepValidated', true)
}

watch(localFormData, (newValue) => {
    try {
        // Sauvegarder dans le localStorage
        const dataToSave = {
            ...JSON.parse(localStorage.getItem('projectWizardData') || '{}'),
            personal: {
                ...newValue,
                lastUpdated: new Date().toISOString()
            }
        };
        localStorage.setItem('projectWizardData', JSON.stringify(dataToSave));

        // Validation des champs
        Object.keys(touchedFields.value).forEach(field => {
            if (touchedFields.value[field]) {
                validateField(field);
            }
        });
    } catch (error) {
        console.error('Erreur dans le watcher:', error);
    }
}, { deep: true });

const saveStepData = () => {
    const stepData = {
        ...props.formData,
        options: {
            ...localFormData.value,
            isValidated: true
        }
    }

    console.log('Options additionnelles sauvegardées:', {
        options: stepData.options.selectedOptions,
        requests: stepData.options.customRequests,
        notes: stepData.options.additionalNotes
    });

    emit('update:formData', stepData)

    return stepData.options;
}

defineExpose({
    saveStepData
})

onMounted(() => {
    try {
        // Récupération des données du localStorage
        const savedData = localStorage.getItem('projectWizardData');
        if (savedData) {
            const parsedData = JSON.parse(savedData);
            if (parsedData.options) {
                localFormData.value = {
                    ...localFormData.value,
                    ...parsedData.options
                };
                console.log('Données options récupérées du localStorage:', parsedData.options);
            }
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des données options:', error);
    }
});

const handleNext = () => {
    if (!isFormComplete.value) {
        Object.keys(touchedFields.value).forEach(field => {
            validateField(field);
        });
        return;
    }

    // Log détaillé des données des options additionnelles
    console.log('Données du formulaire Options :', {
        previousData: props.formData?.options,
        currentData: {
            additionalOptions: localFormData.value.additionalOptions,
            customizations: localFormData.value.customizations,
            isValidated: true
        }
    });

    const formDataToEmit = {
        ...props.formData,
        options: {
            ...localFormData.value,
            isValidated: true
        }
    };

    emit('update:formData', formDataToEmit);
    emit('stepValidated', true);
    emit('next');
};
</script>