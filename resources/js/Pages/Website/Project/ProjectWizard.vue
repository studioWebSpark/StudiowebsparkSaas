<template>
    <div :class="{ 'dark': isDarkMode }" class="overflow-x-hidden bg-gray-50 dark:bg-gray-900">
        <Header :is-dark-mode="isDarkMode" :is-menu-open="isMenuOpen" :is-mobile="isMobile"
            :show-categories="showCategories" @toggle-dark-mode="toggleDarkMode" @toggle-menu="toggleMenu"
            @toggle-categories="toggleCategories" @show-categories="showCategories = true"
            @hide-categories="hideCategories" />

        <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
            <!-- Barre de progression responsive -->
            <div class="max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
                <!-- Version Mobile -->
                <div class="lg:hidden">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">
                            Étape {{ currentStep + 1 }}/{{ steps.length }}
                        </span>
                        <span class="text-sm text-gray-600 dark:text-gray-300">
                            {{ steps[currentStep].title }}
                        </span>
                    </div>
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 w-full h-1 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                        <div class="absolute left-0 top-1/2 h-1 bg-blue-600 rounded-full transition-all duration-300"
                            :style="{ width: `${(currentStep / (steps.length - 1)) * 100}%` }">
                        </div>
                    </div>
                </div>

                <!-- Version Desktop -->
                <div class="hidden lg:block">
                    <div class="relative">
                        <div
                            class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 dark:bg-gray-700">
                        </div>
                        <div class="relative flex justify-between">
                            <div v-for="(step, index) in steps" :key="index" class="flex flex-col items-center">
                                <div :class="[
                                    'w-12 h-12 rounded-full flex items-center justify-center relative z-10 transition-all duration-300',
                                    currentStep > index
                                        ? 'bg-green-500'
                                        : currentStep === index
                                            ? 'bg-blue-600 ring-4 ring-blue-100 dark:ring-blue-900'
                                            : 'bg-gray-200 dark:bg-gray-700'
                                ]">
                                    <span v-if="currentStep > index" class="text-white">
                                        <i class='bx bx-check text-xl'></i>
                                    </span>
                                    <span v-else :class="[
                                        'text-base font-medium',
                                        currentStep === index
                                            ? 'text-white'
                                            : 'text-gray-500 dark:text-gray-400'
                                    ]">
                                        {{ index + 1 }}
                                    </span>
                                </div>
                                <span class="mt-3 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ step.title }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu des étapes avec transition -->
            <div class="w-full">
                <div class="max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8">
                    <transition name="fade" mode="out-in" @before-leave="handleBeforeLeave"
                        @after-enter="handleAfterEnter">
                        <component :is="currentComponent" :form-data="formData" @update:form-data="updateFormData"
                            @step-validated="handleStepValidation" @next="nextStep" @previous="previousStep"
                            :key="currentStep" :class="{ 'pointer-events-none': isNavigating }" />
                    </transition>

                    <!-- Navigation -->
                    <div class="mt-8 mb-8 flex justify-between">
                        <button v-if="currentStep > 0" @click="previousStep"
                            class="px-6 py-3 text-base lg:text-lg font-medium text-gray-700 bg-gray-100 border border-transparent rounded-xl shadow-sm hover:bg-gray-200 transition-all duration-200">
                            Précédent
                        </button>
                        <button v-if="currentStep > 0 && currentStep < steps.length - 1" @click="nextStep"
                            class="px-6 py-3 text-base lg:text-lg font-medium text-white bg-blue-600 border border-transparent rounded-xl shadow-sm hover:bg-blue-700 transition-all duration-200">
                            Suivant
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, nextTick, onBeforeUnmount, watch } from 'vue';
import PersonalInfo from './steps/Personalinfo.vue'
import ProjectDetails from './steps/ProjectDetails.vue'
import ForfaitSelection from './steps/ForfaitSelection.vue'
import TemplateSelection from './steps/TemplateSelection.vue'
import OrderSummary from './steps/OrderSummary.vue'
import Header from '../componentsHome/Header.vue'

const steps = [
    { title: 'Informations', component: PersonalInfo },
    { title: 'Projet', component: ProjectDetails },
    { title: 'Forfait & Options', component: ForfaitSelection },
    { title: 'Template', component: TemplateSelection },
    { title: 'Validation', component: OrderSummary }
];

const currentStep = ref(0);
const stepsValidation = ref({});

// Ajout de la computed property pour currentComponent
const currentComponent = computed(() => {
    return steps[currentStep.value].component;
});

// Structure correcte des données
const formData = ref({
    informations: {
        clientType: '',
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        companyName: '',
        siren: '',
        activity: '',
        isValidated: false
    },
    project: {
        projectType: '',
        description: '',
        selectedFeatures: [],
        isValidated: false
    },
    forfait: {
        selectedForfait: null,
        forfaitDetails: null,
        selectedOptions: [],
        maintenancePlan: null,
        isValidated: false
    },
    template: {
        selectedTemplate: null,
        customizations: [],
        isValidated: false
    }
});

// Référence vers le composant actif
const currentStepComponent = ref(null);

// Fonction pour mettre à jour une section spécifique
const updateSection = (section, data) => {
    formData.value[section] = {
        ...formData.value[section],
        ...data,
        isValidated: true // Force la validation quand les données sont mises à jour
    };

    // Log de vérification
    console.log(`Données du formulaire ${section} :`, {
        ...formData.value[section],
        isValidated: true
    });

    // Sauvegarder dans localStorage
    saveToLocalStorage();
};

// Gérer la validation et la navigation
const handleNextStep = async () => {
    const currentSection = steps[currentStep.value].key;

    if (currentStepComponent.value?.validate()) {
        // Mettre à jour isValidated pour la section courante
        formData.value[currentSection].isValidated = true;

        // Sauvegarder et passer à l'étape suivante
        saveToLocalStorage();
        if (currentStep.value < steps.length - 1) {
            currentStep.value++;
        }
    }
};

// Sauvegarder dans le localStorage
const saveToLocalStorage = () => {
    try {
        const dataToSave = {
            ...formData.value,
            currentStep: currentStep.value
        };
        localStorage.setItem('projectWizardData', JSON.stringify(dataToSave));
    } catch (error) {
        console.error('Erreur lors de la sauvegarde:', error);
    }
};

// Charger les données sauvegardées
const loadSavedData = () => {
    try {
        const savedData = localStorage.getItem('projectWizardData');
        if (savedData) {
            const parsedData = JSON.parse(savedData);
            formData.value = {
                ...formData.value,
                ...parsedData
            };
        }
    } catch (error) {
        console.error('Erreur lors du chargement:', error);
    }
};

// Vérifier si toutes les étapes sont validées
const isAllStepsValidated = computed(() => {
    return steps.every(step => formData.value[step.key]?.isValidated === true);
});

// Charger les données au montage
onMounted(() => {
    // Récupérer l'étape depuis l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const stepParam = urlParams.get('step');

    if (stepParam) {
        currentStep.value = parseInt(stepParam);
    }

    loadSavedData();
});

// Watcher pour sauvegarder automatiquement
watch(formData, () => {
    saveToLocalStorage();
}, { deep: true });

const updateFormData = (newData) => {
    formData.value = newData;
};

const handleStepValidation = (isValid) => {
    stepsValidation.value[currentStep.value] = isValid;
};

const isNavigating = ref(false);

const previousStep = () => {
    if (isNavigating.value || currentStep.value <= 0) return;

    isNavigating.value = true;

    // Désactiver temporairement les transitions
    const currentTransition = document.querySelector('.fade-transition');
    if (currentTransition) {
        currentTransition.style.transition = 'none';
    }

    // Changer l'étape
    currentStep.value--;

    // Réactiver les transitions après le changement d'étape
    setTimeout(() => {
        if (currentTransition) {
            currentTransition.style.transition = '';
        }
        isNavigating.value = false;
    }, 100);
};

const nextStep = () => {
    if (isNavigating.value || currentStep.value >= steps.length - 1) return;

    const stepData = {
        0: { key: 'personal', name: 'Personnel' },
        1: { key: 'project', name: 'Projet' },
        2: { key: 'forfait', name: 'Forfait' },
        3: { key: 'template', name: 'Template' }
    }[currentStep.value];

    if (stepData) {
        console.log(`Données du formulaire ${stepData.name} :`, formData.value[stepData.key]);
    }

    isNavigating.value = true;
    currentStep.value++;

    setTimeout(() => {
        isNavigating.value = false;
    }, 100);
};

const submitForm = async () => {
    try {
        // Logique de soumission du formulaire
        console.log('Formulaire soumis:', formData.value)
    } catch (error) {
        console.error('Erreur lors de la soumission:', error)
    }
}



const isDarkMode = ref(localStorage.getItem('darkMode') === 'true');
const isMenuOpen = ref(false);
const showCategories = ref(false);
const isMobile = ref(false);

// Fonction pour détecter si on est sur mobile
const checkIfMobile = () => {
    isMobile.value = window.innerWidth < 1024;
};

// Initialisation et gestion du redimensionnement
onMounted(() => {
    checkIfMobile();
    window.addEventListener('resize', checkIfMobile);

    // Appliquer le mode sombre au document si nécessaire
    if (isDarkMode.value) {
        document.documentElement.classList.add('dark');
    }

    try {
        const savedData = localStorage.getItem('projectWizardData');
        if (savedData) {
            const parsedData = JSON.parse(savedData);
            formData.value = parsedData;

            // Si toutes les étapes sont validées, aller directement à l'étape de validation
            if (parsedData.personal?.isValidated &&
                parsedData.project?.isValidated &&
                parsedData.forfait?.isValidated &&
                parsedData.template?.isValidated) {
                currentStep.value = 4; // Étape de validation
            }
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
    }
});

onUnmounted(() => {
    window.removeEventListener('resize', checkIfMobile);
});

// Fonctions de toggle
const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    localStorage.setItem('darkMode', isDarkMode.value);

    // Mettre à jour la classe sur l'élément HTML
    if (isDarkMode.value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const toggleCategories = () => {
    showCategories.value = !showCategories.value;
};

const hideCategories = () => {
    showCategories.value = false;
};

// Exposer la fonction nextStep aux composants enfants
defineExpose({
    nextStep
})

// Computed property pour contrôler l'affichage du bouton Suivant
const showNextButton = computed(() => {
    switch (currentStep.value) {
        case 0: // PersonalInfo
            return formData.value?.personal?.firstName &&
                formData.value?.personal?.lastName &&
                formData.value?.personal?.email &&
                formData.value?.personal?.phone;
        case 2: // Template
            return formData.value?.template?.selectedForfait;
        default:
            return true;
    }
});

// Référence au composant actuel
const getCurrentComponent = () => {
    switch (currentStep.value) {
        case 0:
            return personalInfoRef;
        case 1:
            return projectDetailsRef;
        case 2:
            return templateSelectionRef;
        case 3:
            return TemplateSelectionRef;
        default:
            return null;
    }
}

// Références aux composants
const personalInfoRef = ref(null);
const projectDetailsRef = ref(null);
const templateSelectionRef = ref(null);
const TemplateSelectionRef = ref(null);

// Vérifier si l'étape actuelle est valide
const isCurrentStepValid = () => {
    switch (currentStep.value) {
        case 0: // PersonalInfo
            return formData.value?.personal?.firstName &&
                formData.value?.personal?.lastName &&
                formData.value?.personal?.email &&
                formData.value?.personal?.phone;
        case 1: // ProjectDetails
            return formData.value?.project?.projectName;
        case 2: // TemplateSelection
            return formData.value?.template?.selectedForfait;
        case 3: // TemplateSelection
            return true; // Optionnel
        default:
            return false;
    }
}

// Gérer la transition entre les composants
const handleBeforeLeave = (el) => {
    el.style.opacity = 0;
};

const handleAfterEnter = (el) => {
    el.style.opacity = 1;
};

// Fonction pour définir la référence du composant
const setComponentRef = (el) => {
    switch (currentStep.value) {
        case 0:
            personalInfoRef.value = el
            break
        case 1:
            projectDetailsRef.value = el
            break
        case 2:
            templateSelectionRef.value = el
            break
        case 3:
            TemplateSelectionRef.value = el
            break
    }
}

// Ajouter un gestionnaire de nettoyage
onBeforeUnmount(() => {
    isNavigating.value = false;
});

</script>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
