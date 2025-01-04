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
import { usePage, router } from '@inertiajs/vue3';
import PersonalInfo from './steps/Personalinfo.vue'
import ProjectDetails from './steps/ProjectDetails.vue'
import ForfaitSelection from './steps/ForfaitSelection.vue'
import TemplateSelection from './steps/TemplateSelection.vue'
import OrderSummary from './steps/OrderSummary.vue'
import Header from '../componentsHome/Header.vue'
import { loadStripe } from '@stripe/stripe-js';

const page = usePage();
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
    personal: null,
    project: null,
    forfait: null,
    template: null
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
    const validations = {
        personal: formData.value.personal?.isValidated === true,
        project: formData.value.project?.isValidated === true,
        forfait: formData.value.forfait?.isValidated === true,
        template: formData.value.template?.isValidated === true
    };

    console.log('Validation détaillée:', validations);

    return Object.values(validations).every(v => v === true);
});

// Charger les données au montage
onMounted(() => {
    // Récupérer l'étape depuis l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const stepParam = urlParams.get('step');

    // Si pas de données sauvegardées, forcer l'étape 0
    const savedData = localStorage.getItem('projectWizardData');
    if (!savedData) {
        currentStep.value = 0;
        router.visit('/demarrer-projet?step=0', {
            replace: true,
            preserveState: true
        });
        return;
    }

    // Si des données existent, permettre la navigation
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
    formData.value = {
        ...formData.value,
        ...newData,
        template: {
            ...formData.value.template,
            ...newData.template,
            isValidated: newData.template?.isValidated ?? formData.value.template?.isValidated
        }
    };

    console.log('Mise à jour formData:', {
        template: formData.value.template,
        isValidated: formData.value.template.isValidated
    });
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

    debugValidation(); // Afficher les informations de debug

    if (!isCurrentStepValid()) {
        // Message d'erreur plus spécifique
        const stepName = steps[currentStep.value];
        alert(`Veuillez compléter tous les champs requis de l'étape "${stepName}" avant de continuer.`);
        return;
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
    const currentStepData = formData.value;

    switch (currentStep.value) {
        case 0: // PersonalInfo
            const personalData = currentStepData?.personal;
            if (!personalData) return false;

            // Validation de base pour tous les types de clients
            const baseValidation =
                personalData.firstName &&
                personalData.lastName &&
                personalData.email &&
                personalData.phone &&
                personalData.clientType;

            // Validation supplémentaire pour les professionnels
            if (personalData.clientType === 'professional') {
                const sirenRequired = !personalData.disableSiren;
                return baseValidation && (!sirenRequired || personalData.siren);
            }

            return baseValidation;

        case 1: // ProjectDetails
            const projectData = currentStepData?.project;
            if (!projectData) return false;

            // Vérifier uniquement le type de projet et la description
            return !!projectData.projectType &&
                !!projectData.description &&
                projectData.description.length >= 10;

        case 2: // ForfaitSelection
            const forfaitData = currentStepData?.forfait;
            return !!forfaitData && !!forfaitData.selectedForfait;

        case 3: // TemplateSelection
            const templateData = currentStepData?.template;
            return !!templateData &&
                Array.isArray(templateData.selectedTemplates) &&
                templateData.selectedTemplates.length > 0;

        case 4: // OrderSummary
            return true;

        default:
            return false;
    }
};

// Fonction de debug améliorée
const debugValidation = () => {
    const currentStepData = formData.value;
    const stepValidation = {
        étapeCourante: currentStep.value,
        nomÉtape: steps[currentStep.value],
        données: currentStepData,
        validation: {
            résultat: isCurrentStepValid(),
            détails: {}
        }
    };

    // Ajouter des détails spécifiques selon l'étape
    switch (currentStep.value) {
        case 1: // ProjectDetails
            stepValidation.validation.détails = {
                projectType: !!currentStepData?.project?.projectType,
                description: !!currentStepData?.project?.description,
                descriptionLength: currentStepData?.project?.description?.length >= 10
            };
            break;
        // Ajouter d'autres cas si nécessaire
    }

    console.log('État de validation:', stepValidation);
};

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

// Ajouter ces constantes au début du script
const includedOptionsByForfait = {
    premium: ['ecommerce', 'logoPhotos', 'socialMedia', 'Dashboard'],
    standard: ['logoPhotos', 'socialMedia'],
    starter: []
};

const templateOptions = [
    {
        id: 'logoPhotos',
        name: 'Création de logo + Photos Pro',
        description: 'Design professionnel de votre identité visuelle',
        price: 99,
        icon: 'bx-image'
    },
    {
        id: 'socialMedia',
        name: 'Réseaux Sociaux',
        description: 'Création Conseil et gestion de vos réseaux sociaux',
        price: 179,
        icon: 'bx-share-alt'
    },
    {
        id: 'Dashboard',
        name: 'Dashboard (CRM)',
        description: 'Suivi détaillé de vos performances',
        price: 299,
        icon: 'bx-line-chart'
    },
    {
        id: 'ecommerce',
        name: 'E-commerce',
        description: 'Solution complète de vente en ligne',
        price: 299,
        icon: 'bx-store'
    }
];

const maintenancePlans = [
    {
        id: 'basic',
        name: 'Basic',
        price: 49,
        features: [
            'Mises à jour de sécurité',
            'Sauvegardes mensuelles',
            'Support email'
        ]
    },
    {
        id: 'pro',
        name: 'Pro',
        price: 99,
        features: [
            'Mises à jour de sécurité',
            'Sauvegardes hebdomadaires',
            'Support prioritaire 24/7',
            'Optimisation des performances'
        ]
    }
];

// Ajouter une computed property pour vérifier l'état global
const currentStepValidationStatus = computed(() => {
    return {
        isValid: isCurrentStepValid(),
        stepName: steps[currentStep.value],
        currentStep: currentStep.value
    };
});

// Ajouter une fonction de debug détaillée
const debugAllSteps = () => {
    console.group('État de validation des étapes');

    // Vérification des informations personnelles
    console.log('1. Informations Personnelles:', {
        données: formData.value.personal,
        validé: formData.value.personal?.isValidated,
        champs: {
            clientType: !!formData.value.personal?.clientType,
            firstName: !!formData.value.personal?.firstName,
            lastName: !!formData.value.personal?.lastName,
            email: !!formData.value.personal?.email,
            phone: !!formData.value.personal?.phone,
            siren: formData.value.personal?.clientType === 'professional' ? !!formData.value.personal?.siren : 'Non requis'
        }
    });

    // Vérification du projet
    console.log('2. Détails du Projet:', {
        données: formData.value.project,
        validé: formData.value.project?.isValidated,
        champs: {
            projectType: !!formData.value.project?.projectType,
            description: !!formData.value.project?.description,
            descriptionLength: formData.value.project?.description?.length
        }
    });

    // Vérification du forfait
    console.log('3. Forfait:', {
        données: formData.value.forfait,
        validé: formData.value.forfait?.isValidated,
        champs: {
            selectedForfait: !!formData.value.forfait?.selectedForfait,
            forfaitDetails: !!formData.value.forfait?.forfaitDetails
        }
    });

    // Vérification du template
    console.log('4. Template:', {
        données: formData.value.template,
        validé: formData.value.template?.isValidated,
        champs: {
            selectedTemplates: formData.value.template?.selectedTemplates?.length > 0
        }
    });

    // État global
    console.log('État Global:', {
        étapeCourante: currentStep.value,
        toutesÉtapesValides: isAllStepsValidated.value,
        peutProcéderAuPaiement: currentStep.value === steps.length - 1 && isAllStepsValidated.value
    });

    console.groupEnd();
};

// Ajouter un appel à debugAllSteps dans la dernière étape
watch(() => currentStep.value, (newStep) => {
    if (newStep === steps.length - 1) {
        debugAllSteps();
    }
});

// Ajouter une méthode pour réinitialiser le wizard
const resetWizard = () => {
    // Nettoyer le localStorage
    localStorage.removeItem('projectWizardData');
    localStorage.removeItem('currentStep');
    localStorage.removeItem('formData');
    localStorage.removeItem('personal');
    localStorage.removeItem('project');
    localStorage.removeItem('requirements');
    localStorage.removeItem('payment');

    // Réinitialiser l'état du composant
    currentStep.value = 1;
    formData.value = {
        project: null,
        personal: null,
        template: null,
        forfait: null
    };

    // Forcer le rechargement du composant
    if (window.location.pathname.includes('demarrer-projet')) {
        window.location.reload();
    }
};

// Surveiller les props de la page pour la réinitialisation
watch(() => page.props.resetWizard, (shouldReset) => {
    if (shouldReset) {
        resetWizard();
    }
});

// Ajouter un listener pour le message de réinitialisation
onMounted(() => {
    if (page.props.resetWizard) {
        resetWizard();
    }
});

// Dans votre gestionnaire de paiement Stripe
const handleStripeSuccess = async (response) => {
    try {
        const result = await axios.post('/stripe/success', {
            session_id: response.session_id
        });

        if (result.data.success && result.data.shouldResetWizard) {
            resetWizard();
            // Rediriger vers la page de confirmation ou dashboard
            router.push({ name: 'dashboard' });
        }
    } catch (error) {
        console.error('Erreur lors du traitement du paiement:', error);
    }
};

const handlePayment = async () => {
    try {
        // 1. Récupérer toutes les données du wizard
        const wizardData = {
            personal: formData.value.personal.données,
            project: formData.value.project.données,
            forfait: formData.value.forfait.données,
            template: formData.value.template.données
        };

        console.log('Données du wizard avant paiement:', wizardData);

        // 2. Créer la session Stripe
        const response = await axios.post('/stripe/create-session', {
            amount: totalAmount.value,
            projectWizardData: JSON.stringify(wizardData)
        });

        const { sessionId } = response.data;
        console.log('Session Stripe créée:', sessionId);

        // 3. Rediriger vers Stripe
        const stripe = await loadStripe(import.meta.env.VITE_STRIPE_KEY);
        const result = await stripe.redirectToCheckout({
            sessionId: sessionId
        });

        if (result.error) {
            console.error('Erreur Stripe:', result.error);
        }

    } catch (error) {
        console.error('Erreur lors du paiement:', error);
    }
};

// Ajouter ces méthodes à la suite de vos méthodes existantes
const resetWizardState = () => {
    console.group('Réinitialisation du wizard');
    console.log('1. État avant réinitialisation:', {
        localStorage: localStorage.getItem('projectWizardData'),
        currentStep: currentStep.value,
        formData: formData.value
    });

    // Vider le localStorage
    localStorage.removeItem('projectWizardData');
    localStorage.removeItem('currentStep');
    localStorage.removeItem('wizardState');

    // Réinitialiser les états de validation
    formData.value = {
        personal: { isValidated: false },
        project: { isValidated: false },
        forfait: { isValidated: false },
        template: { isValidated: false }
    };

    // Remettre à l'étape 1
    currentStep.value = 1;

    console.log('2. État après réinitialisation:', {
        localStorage: localStorage.getItem('projectWizardData'),
        currentStep: currentStep.value,
        formData: formData.value
    });
    console.groupEnd();
};

// Ajouter ce watcher avec vos autres watchers existants
watch(() => page.props.shouldReset, (shouldReset) => {
    if (shouldReset) {
        console.log('Déclenchement de la réinitialisation');
        resetWizardState();
    }
});

// Supprimer toute vérification de commande existante
const validateStep = (stepData) => {
    if (currentStep.value === 0) {
        formData.value.personal = stepData;
    } else if (currentStep.value === 1) {
        formData.value.project = stepData;
    } else if (currentStep.value === 2) {
        formData.value.forfait = stepData;
    } else if (currentStep.value === 3) {
        formData.value.template = stepData;
    }

    nextStep();
};

// Permettre de recommencer une nouvelle commande
const startNewOrder = () => {
    formData.value = {
        personal: null,
        project: null,
        forfait: null,
        template: null
    };
    currentStep.value = 0;
};

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