<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <form @submit.prevent="validateForm" class="space-y-8">
            <!-- Type de projet -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">
                    Type de projet *
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <button v-for="type in projectTypes" :key="type.id" type="button"
                        @click="localFormData.projectType = type.id; validateField('projectType')"
                        class="relative flex flex-col items-center p-6 border rounded-xl transition-all duration-200 transform hover:scale-105 hover:shadow-lg cursor-pointer"
                        :class="{
                            'border-green-500 bg-green-50 dark:bg-green-900 dark:border-green-400 text-green-700 dark:text-green-300': localFormData.projectType === type.id,
                            'border-gray-200 dark:border-gray-600 hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900': localFormData.projectType !== type.id
                        }">
                        <i :class="['bx text-4xl mb-3', type.icon]"></i>
                        <span class="text-sm font-medium">{{ type.name }}</span>
                        <div v-if="localFormData.projectType === type.id" class="absolute top-2 right-2">
                            <i class='bx bx-check text-green-500 text-xl'></i>
                        </div>
                    </button>
                </div>
                <p v-if="formErrors.projectType && touchedFields.projectType" class="mt-2 text-sm text-red-600">
                    {{ formErrors.projectType }}
                </p>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Description du projet *
                </label>
                <div class="relative">
                    <textarea v-model="localFormData.description" @input="validateField('description')" rows="4"
                        class="mt-1 block w-full rounded-md shadow-sm" :class="{
                            'border-gray-300': !touchedFields.description,
                            'border-red-300': formErrors.description,
                            'border-green-500': isFieldValid.description && touchedFields.description
                        }" placeholder="Décrivez votre projet en détail...">
                    </textarea>
                </div>
                <p v-if="formErrors.description" class="mt-1 text-sm text-red-600">{{ formErrors.description }}</p>
            </div>

            <!-- Fonctionnalités -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">
                    Fonctionnalités souhaitées (optionnel)
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <label v-for="feature in features" :key="feature.id"
                        class="relative flex flex-col items-center p-6 border rounded-xl cursor-pointer transition-all duration-200 transform hover:scale-105 hover:shadow-lg"
                        :class="{
                            'border-green-500 bg-green-50/70 dark:bg-green-900/50 dark:border-green-400 text-green-700 dark:text-green-300': localFormData.selectedFeatures.includes(feature.id),
                            'border-gray-200 dark:border-gray-600 hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/50': !localFormData.selectedFeatures.includes(feature.id)
                        }">
                        <input type="checkbox" v-model="localFormData.selectedFeatures" :value="feature.id"
                            class="sr-only">
                        <div class="flex flex-col items-center w-full">
                            <i :class="['bx text-3xl mb-2', feature.icon]"></i>
                            <span class="text-sm font-medium text-center">{{ feature.name }}</span>
                            <div v-if="localFormData.selectedFeatures.includes(feature.id)"
                                class="absolute top-2 right-2">
                                <i class='bx bx-check text-green-500 text-xl'></i>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </form>
    </div>
</template>
<script setup>
import { ref, computed, watch, onMounted, nextTick } from 'vue';

const props = defineProps({
    formData: {
        type: Object,
        required: true,
        default: () => ({
            project: {
                projectType: '',
                deadline: '',
                description: '',
                selectedFeatures: [],
                isValidated: false
            }
        })
    }
});

const emit = defineEmits(['update:formData', 'stepValidated', 'next']);

// Validation des champs
const formErrors = ref({
    projectType: '',
    deadline: '',
    description: ''
});

const isFieldValid = ref({
    projectType: !!props.formData?.project?.projectType,
    description: !!props.formData?.project?.description,
    selectedFeatures: Array.isArray(props.formData?.project?.selectedFeatures) &&
        props.formData?.project?.selectedFeatures.length > 0,
});

const touchedFields = ref({
    projectType: !!props.formData?.project?.isValidated,
    description: !!props.formData?.project?.isValidated,
    selectedFeatures: !!props.formData?.project?.isValidated,
});

// Modification des types de projets
const projectTypes = [
    { id: 'site-vitrine', name: 'Site Vitrine', icon: 'bx-window-alt' },
    { id: 'e-commerce', name: 'E-commerce', icon: 'bx-store' },
    { id: 'blog', name: 'Blog', icon: 'bx-news' },
    { id: 'application', name: 'Application Web', icon: 'bx-desktop' }
];

// Fonctionnalités générales basées sur tous les forfaits
const features = [
    { id: 'responsive', name: 'Design Responsive', icon: 'bx-devices' },
    { id: 'seo', name: 'Optimisation SEO', icon: 'bx-search-alt' },
    { id: 'contact', name: 'Formulaire de contact', icon: 'bx-envelope' },
    { id: 'social', name: 'Réseaux sociaux', icon: 'bx-share-alt' },
    { id: 'animations', name: 'Animations', icon: 'bx-play-circle' },
    { id: 'blog', name: 'Blog professionnel', icon: 'bx-news' },
    { id: 'newsletter', name: 'Newsletter', icon: 'bx-mail-send' },
    { id: 'stats', name: 'Statistiques & Rapports', icon: 'bx-line-chart' },
    { id: 'multilang', name: 'Multi-langues', icon: 'bx-world' },
    { id: 'maintenance', name: 'Maintenance', icon: 'bx-wrench' },
];

const getInitialData = () => {
    try {
        const savedData = localStorage.getItem('projectWizardData');
        if (savedData) {
            const parsedData = JSON.parse(savedData);
            return parsedData?.project || {
                projectType: '',
                description: '',
                selectedFeatures: [],
                isValidated: false
            };
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
    }
    return {
        projectType: '',
        description: '',
        selectedFeatures: [],
        isValidated: false
    };
};

const localFormData = ref(getInitialData());

const validateField = (field) => {
    touchedFields.value[field] = true;

    switch (field) {
        case 'projectType':
            isFieldValid.value[field] = !!localFormData.value[field];
            formErrors.value[field] = !isFieldValid.value[field] ? 'Veuillez sélectionner un type de projet' : '';
            break;
        case 'description':
            isFieldValid.value[field] = localFormData.value[field].length >= 10;
            formErrors.value[field] = !isFieldValid.value[field] ? 'La description doit contenir au moins 10 caractères' : '';
            break;
    }
};

const isFormComplete = computed(() => {
    return !!localFormData.value.projectType &&
        !!localFormData.value.description &&
        localFormData.value.description.length >= 10;
});

const validateForm = () => {
    const isValid =
        !!localFormData.value.projectType &&
        !!localFormData.value.description &&
        localFormData.value.description.length >= 10;

    localFormData.value.isValidated = isValid;

    emit('update:formData', {
        ...props.formData,
        project: {
            ...localFormData.value,
            isValidated: isValid
        }
    });
};

// Ajouter un watcher pour valider automatiquement quand les champs changent
watch(
    [
        () => localFormData.value.projectType,
        () => localFormData.value.description
    ],
    () => {
        validateForm();
    }
);

// Sauvegarder à chaque modification
watch(localFormData, (newValue) => {
    try {
        const existingData = JSON.parse(localStorage.getItem('projectWizardData') || '{}');
        const dataToSave = {
            ...existingData,
            project: {
                ...newValue,
                lastUpdated: new Date().toISOString()
            }
        };
        localStorage.setItem('projectWizardData', JSON.stringify(dataToSave));
        // Émettre les mises à jour
        emit('update:formData', {
            ...props.formData,
            project: { ...newValue }
        });
    } catch (error) {
        console.error('Erreur dans le watcher:', error);
    }
}, { deep: true });

const saveStepData = () => {
    const stepData = {
        ...props.formData,
        project: {
            ...localFormData.value,
            isValidated: true
        }
    }

    console.log('Données du projet sauvegardées:', stepData.project);
    emit('update:formData', stepData)

    return stepData.project;
}

defineExpose({
    saveStepData
})

onMounted(() => {
    try {
        const savedData = localStorage.getItem('projectWizardData');
        if (savedData) {
            const parsedData = JSON.parse(savedData);
            if (parsedData.project) {
                localFormData.value = {
                    ...localFormData.value,
                    ...parsedData.project
                };
            }
        }
    } catch (error) {
        console.error('❌ Erreur lors de la récupération des données:', error);
    }
});

const handleNext = () => {
    if (!isFormComplete.value) {
        Object.keys(touchedFields.value).forEach(field => {
            touchedFields.value[field] = true;
            validateField(field);
        });
        return;
    }

    try {
        const formDataToEmit = {
            ...props.formData,
            project: {
                ...localFormData.value,
                isValidated: true
            }
        };

        // Sauvegarder dans le localStorage
        const existingData = JSON.parse(localStorage.getItem('projectWizardData') || '{}');
        localStorage.setItem('projectWizardData', JSON.stringify({
            ...existingData,
            project: {
                ...localFormData.value,
                isValidated: true,
                lastUpdated: new Date().toISOString()
            }
        }));

        emit('update:formData', formDataToEmit);
        emit('stepValidated', true);
        emit('next');
    } catch (error) {
        console.error('Erreur lors de la sauvegarde:', error);
    }
};

// Définition des recommandations de forfaits selon le type de projet
const forfaitRecommendations = {
    'e-commerce': {
        recommended: 'premium',
        minimum: 'standard',
        message: 'Pour un site e-commerce performant, nous recommandons le forfait Premium. Le forfait Standard est également disponible avec les fonctionnalités essentielles.'
    },
    'application': {
        recommended: 'premium',
        minimum: 'standard',
        message: 'Pour une application web professionnelle, nous recommandons le forfait Premium. Le forfait Standard est également disponible avec les fonctionnalités de base.'
    },
    'blog': {
        recommended: 'standard',
        message: 'Pour un blog professionnel, nous recommandons le forfait Standard qui offre un excellent rapport qualité-prix.'
    },
    'site-vitrine': {
        recommended: 'starter',
        message: 'Pour un site vitrine, le forfait Starter est un excellent point de départ, mais vous pouvez opter pour plus de fonctionnalités avec nos autres forfaits.'
    }
};

// Modifier le watch pour le type de projet
watch(() => localFormData.value.projectType, (newType) => {
    if (newType) {
        const recommendation = forfaitRecommendations[newType];
        if (recommendation) {
            localStorage.setItem('projectRecommendation', JSON.stringify(recommendation));
        }
    }
});
</script>