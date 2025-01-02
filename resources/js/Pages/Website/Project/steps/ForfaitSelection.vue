<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="max-w-[1920px] mx-auto px-8 py-16">
            <!-- Section Forfaits -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white">
                    Choisissez votre forfait
                </h2>
                <p class="mt-6 text-xl text-gray-600 dark:text-gray-300">
                    Des solutions adaptées à vos besoins
                </p>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    * TVA non applicable, art. 293 B du CGI
                </p>
            </div>

            <!-- Ajouter après le titre -->
            <div v-if="projectRecommendation" class="text-center mb-8">
                <p class="text-lg text-green-600 dark:text-green-400 font-medium">
                    {{ projectRecommendation.message }}
                </p>
            </div>

            <!-- Grille des forfaits -->
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 mb-24">
                <div v-for="forfait in filteredForfaits" :key="forfait.id" :class="[
                    'relative flex flex-col rounded-xl border-2 p-8 xl:p-10 bg-white dark:bg-[#1E293B] transition-all duration-200 transform hover:scale-105 hover:shadow-lg',
                    forfait.disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer',
                    forfait.recommended ? 'border-green-500 ring-2 ring-green-500' : 'border-gray-200 dark:border-gray-700',
                    localFormData.selectedForfait === forfait.id ? 'border-green-500 bg-green-50 dark:bg-green-900/50' : '',
                    'hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/50'
                ]" @click="selectForfait(forfait)">

                    <!-- Ajouter un badge "Recommandé" -->
                    <div v-if="forfait.recommended"
                        class="absolute -top-4 left-1/2 transform -translate-x-1/2 px-4 py-1 bg-green-500 text-white rounded-full text-sm font-medium">
                        Recommandé
                    </div>

                    <!-- Badge -->
                    <div :class="[
                        'absolute top-0 right-8 px-4 py-1 rounded-b-lg text-sm font-medium text-white',
                        forfait.popular ? 'bg-green-500' : 'bg-green-700'
                    ]">
                        {{ forfait.badge }}
                    </div>

                    <!-- En-tête du forfait -->
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                            {{ forfait.name }}
                        </h3>
                        <div class="flex items-baseline justify-center gap-x-2">
                            <span class="text-5xl font-bold text-gray-900 dark:text-white">{{ forfait.price }}€</span>
                            <span class="text-gray-500 dark:text-gray-400">HT</span>
                        </div>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm">
                            {{ forfait.description }}
                        </p>
                    </div>

                    <!-- Contenu principal -->
                    <div class="flex flex-col flex-grow">
                        <div class="flex-grow">
                            <p class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Ce qui est inclus :</p>
                            <ul class="space-y-4">
                                <li v-for="feature in forfait.features" :key="feature" class="flex items-start gap-x-3">
                                    <i class='bx bx-check text-green-400 text-xl'></i>
                                    <span class="text-gray-600 dark:text-gray-300 text-sm">{{ feature }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Bouton de sélection -->
                        <button @click.stop="selectForfait(forfait)"
                            class="mt-8 w-full rounded-lg px-4 py-3 text-sm font-semibold transition-all duration-200"
                            :class="[
                                localFormData.selectedForfait === forfait.id
                                    ? 'bg-green-600 text-white hover:bg-green-700'
                                    : 'bg-gray-100 text-gray-700 hover:bg-green-100 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600'
                            ]">
                            {{ localFormData.selectedForfait === forfait.id ? 'Sélectionné' : 'Sélectionner' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Options additionnelles -->
            <transition enter-active-class="transition ease-out duration-300"
                enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-200" leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95">
                <div v-if="localFormData.selectedForfait" class="space-y-8">
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 sm:mb-6">
                            Options et fonctionnalités
                        </h2>

                        <div class="grid grid-cols-1 gap-4 sm:gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            <div v-for="option in availableOptions" :key="option.id"
                                class="relative flex items-center p-4 border rounded-lg transition-all duration-200"
                                :class="[
                                    option.included || isSelected(option.id)
                                        ? 'border-green-500 bg-green-50 dark:bg-green-900/10'
                                        : 'border-gray-200 dark:border-gray-700 hover:border-green-300'
                                ]">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="text-base font-medium text-gray-900 dark:text-white">
                                            {{ option.name }}
                                        </h3>
                                        <div class="flex items-center space-x-2">
                                            <!-- Badge pour les options incluses ou sélectionnées -->
                                            <span v-if="option.included || isSelected(option.id)"
                                                class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-400">
                                                {{ option.included ? 'Inclus' : 'Sélectionné' }}
                                            </span>
                                            <!-- Prix pour les options non incluses et non sélectionnées -->
                                            <span v-else class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ option.price }}€
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ option.description }}
                                    </p>
                                </div>

                                <!-- Bouton de sélection uniquement pour les options non incluses -->
                                <button v-if="!option.included" @click="toggleOption(option)"
                                    :disabled="option.disabled" class="ml-4 p-2 rounded-lg transition-colors" :class="[
                                        isSelected(option.id)
                                            ? 'bg-green-100 text-green-600 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400'
                                            : option.disabled
                                                ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-800 dark:text-gray-600'
                                                : 'bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700'
                                    ]">
                                    <i class='bx text-xl' :class="[
                                        isSelected(option.id) ? 'bx-check' : 'bx-plus'
                                    ]">
                                    </i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <!-- Messages d'erreur -->
            <div class="mt-4">
                <p v-if="formErrors.selectedForfait && touchedFields.selectedForfait" class="text-red-600 text-sm">
                    {{ formErrors.selectedForfait }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import { includedOptionsByForfait, templateOptions } from '../constants'

const props = defineProps({
    formData: {
        type: Object,
        required: true,
        default: () => ({
            template: {
                selectedForfait: null,
                forfaitDetails: null,
                selectedOptions: [],
                maintenancePlan: null,
                isValidated: false
            }
        })
    }
})

const emit = defineEmits(['update:formData', 'stepValidated', 'next'])

const getInitialData = () => {
    try {
        const savedData = localStorage.getItem('projectWizardData');
        if (savedData) {
            const parsedData = JSON.parse(savedData);
            return parsedData?.forfait || {
                selectedForfait: null,
                forfaitDetails: null,
                selectedOptions: [],
                maintenancePlan: null,
                isValidated: false
            };
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
    }
    return {
        selectedForfait: null,
        forfaitDetails: null,
        selectedOptions: [],
        maintenancePlan: null,
        isValidated: false
    };
};


// État local du formulaire
const localFormData = ref({
    selectedForfait: props.formData?.selectedForfait || null,
    forfaitDetails: props.formData?.forfaitDetails || null,
    includedOptions: [],
    selectedOptions: [],
    maintenancePlan: props.formData?.maintenancePlan || null,
    isValidated: false
});

const touchedFields = ref({
    selectedForfait: !!props.formData?.template?.isValidated,
    maintenancePlan: !!props.formData?.template?.isValidated,
    selectedOptions: !!props.formData?.template?.isValidated
})

const formErrors = ref({
    selectedForfait: '',
    maintenancePlan: '',
    selectedOptions: ''
})

const isFieldValid = ref({
    selectedForfait: !!props.formData?.template?.selectedForfait,
    maintenancePlan: !!props.formData?.template?.maintenancePlan,
    selectedOptions: true // Optionnel
})

const validateField = (field) => {
    touchedFields.value[field] = true;

    switch (field) {
        case 'selectedForfait':
            isFieldValid.value[field] = !!localFormData.value[field];
            formErrors.value[field] = !isFieldValid.value[field] ? 'Veuillez sélectionner un forfait' : '';
            break;
        case 'maintenancePlan':
            // La maintenance est optionnelle, donc toujours valide
            isFieldValid.value[field] = true;
            formErrors.value[field] = '';
            break;
        case 'selectedOptions':
            // Les options sont facultatives
            isFieldValid.value[field] = true;
            formErrors.value[field] = '';
            break;
    }
};

const isFormValid = computed(() => true);

const validateForm = () => {
    // Valider tous les champs
    validateField('selectedForfait');
    validateField('maintenancePlan');

    if (!isFormValid.value) {
        return false;
    }

    // Créer l'objet de données validé
    const validatedData = {
        selectedForfait: localFormData.value.selectedForfait,
        forfaitDetails: localFormData.value.forfaitDetails,
        selectedOptions: localFormData.value.selectedOptions,
        maintenancePlan: localFormData.value.maintenancePlan,
        isValidated: true, // Forcer à true
        lastUpdated: new Date().toISOString()
    };

    // Mettre à jour le formData avec les données validées
    const formDataToEmit = {
        ...props.formData,
        forfait: validatedData,
        project: {
            ...props.formData?.project,
            isValidated: true
        },
        template: {
            ...props.formData?.template,
            isValidated: true
        }
    };

    // Mettre à jour l'état local
    localFormData.value = {
        ...localFormData.value,
        isValidated: true
    };

    // Émettre les données mises à jour
    emit('update:formData', formDataToEmit);



    emit('stepValidated', true);
    return true;
};

// Ajouter un watcher pour la validation automatique
watch(
    () => localFormData.value.selectedForfait,
    (newValue) => {
        if (newValue) {
            validateField('selectedForfait');
            localFormData.value.isValidated = true; // Mettre à jour isValidated quand un forfait est sélectionné
        }
    }
);

// Fonction pour calculer le total des options
const calculateOptionsTotal = () => {
    return (localFormData.value.selectedOptions || []).reduce((total, optionId) => {
        const option = TemplateSelection.find(opt => opt.id === optionId);
        return total + (option?.price || 0);
    }, 0);
};

// Fonction pour calculer le prix de la maintenance
const calculateMaintenancePrice = () => {
    if (!localFormData.value.maintenancePlan) return 0;
    const plan = maintenancePlans.find(p => p.id === localFormData.value.maintenancePlan);
    return plan?.price || 0;
};

// Fonction pour calculer le total global
const calculateTotal = () => {
    const forfaitPrice = localFormData.value.forfaitDetails?.price || 0;
    const optionsTotal = calculateOptionsTotal();
    const maintenancePrice = calculateMaintenancePrice();
    return forfaitPrice + optionsTotal + maintenancePrice;
};

const forfaits = [
    {
        id: 'starter',
        name: 'Starter',
        price: 990,
        badge: 'Essentiel',
        description: 'Idéal pour les petites entreprises qui souhaitent établir leur présence en ligne.',
        popular: false,
        features: [
            'Site vitrine 3 pages (Accueil, À propos, Contact)',
            'Design responsive moderne',
            'Optimisation SEO de base',
            'Support 15 jours',
            'Délai de livraison : 1-2 jours',
            'Hébergement (optionnel)'
        ]
    },
    {
        id: 'standard',
        name: 'Standard',
        price: 1990,
        badge: 'Populaire',
        description: 'Solution complète pour une présence web professionnelle et impactante.',
        popular: true,
        features: [
            'Application web 5-7 pages personnalisées',
            'Design premium responsive avec animations',
            'SEO avancé + Suivi de base',
            'Support 30 jours',
            'Délai de livraison : 3-4 jours',
            'Intégration réseaux sociaux',
            'Statistiques Réseaux sociaux + Rapport mensuel',
            'Formulaire de contact personnalisé multi-pages',
            'Hébergement (optionnel)',
        ]
    },
    {
        id: 'premium',
        name: 'Premium',
        price: 2990,
        badge: 'Sur-mesure',
        description: 'Solution premium tout inclus avec accompagnement personnalisé pour une présence web exceptionnelle et des résultats garantis.',
        popular: false,
        features: [
            'Application web 10-12 pages personnalisées avec E-commerce inclus',
            'Design exclusif sur-mesure avec animations premium',
            'SEO Expert + Suivi mensuel personnalisé',
            'Support prioritaire illimité 60 jours',
            'Délai de livraison : 5-7 jours',
            'Stratégie de contenu personnalisée',
            'Blog professionnel + Newsletter automatisée',
            'Maintenance 3 mois offerte',
            'Audit marketing initial offert',
            'Stratégie de contenu personnalisée',
            'Système de formulaires avancé',
            'Hébergement premium 1 an offert'
        ]
    }
]

const TemplateSelection = [
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
]

const maintenancePlans = [
    {
        id: 'basic',
        name: 'Essentiel',
        description: 'Maintenance de base annuelle',
        price: 79,
        features: [
            'Mises à jour de sécurité',
            'Sauvegardes mensuelles',
            'Support par email',
            'Temps de réponse sous 72h',
            'Modifications mineures'
        ]
    },
    {
        id: 'pro',
        name: 'Professionnel',
        description: 'Maintenance complète annuelle',
        price: 159,
        features: [
            'Mises à jour prioritaires',
            'Sauvegardes hebdomadaires',
            'Support prioritaire',
            'Temps de réponse sous 24h',
            'Modifications illimitées'
        ]
    }
]

const selectForfait = (forfait) => {
    if (forfait.disabled) return;

    localFormData.value.selectedForfait = forfait.id;
    localFormData.value.forfaitDetails = forfait;

    // Réinitialiser les options
    localFormData.value.selectedOptions = [];

    // Récupérer toutes les options incluses pour ce forfait
    const includedOptionsIds = includedOptionsByForfait[forfait.id] || [];

    // Créer un tableau des options incluses avec tous leurs détails
    const includedOptions = TemplateSelection
        .filter(option => includedOptionsIds.includes(option.id))
        .map(option => ({
            id: option.id,
            name: option.name,
            description: option.description,
            price: 0,
            icon: option.icon,
            included: true
        }));

    // Ajouter les options incluses aux options sélectionnées
    localFormData.value.selectedOptions = includedOptions;

    // Mettre à jour le formData parent avec toutes les informations
    emit('update:formData', {
        ...props.formData,
        forfait: {
            ...localFormData.value,
            selectedForfait: forfait.id,
            forfaitDetails: forfait,
            selectedOptions: includedOptions,
            includedOptionsIds: includedOptionsIds // Ajouter les IDs des options incluses
        }
    });

    // Log de vérification (temporaire)
    console.log('Options incluses:', includedOptions);
};

// Computed property pour les options disponibles
const availableOptions = computed(() => {
    if (!localFormData.value.selectedForfait) return TemplateSelection;

    return TemplateSelection.map(option => {
        const isIncluded = includedOptionsByForfait[localFormData.value.selectedForfait]?.includes(option.id);
        return {
            ...option,
            included: isIncluded,
            disabled: isIncluded || (
                localFormData.value.selectedForfait === 'starter' &&
                ['ecommerce', 'Dashboard'].includes(option.id)
            ),
            price: isIncluded ? 0 : option.price
        };
    });
});

// Computed property pour les options incluses
const includedOptions = computed(() => {
    if (!localFormData.value.selectedForfait) return [];

    const includedIds = includedOptionsByForfait[localFormData.value.selectedForfait] || [];
    return TemplateSelection
        .filter(option => includedIds.includes(option.id))
        .map(option => ({
            ...option,
            included: true,
            price: 0
        }));
});

// Fonction pour vérifier si une option est incluse
const isOptionIncluded = (optionId) => {
    return includedOptionsByForfait[localFormData.value.selectedForfait]?.includes(optionId) || false;
};

// Modifier la fonction toggleOption
const toggleOption = (option) => {
    // Ne pas permettre la modification des options incluses
    if (isOptionIncluded(option.id)) return;

    const index = localFormData.value.selectedOptions.findIndex(opt => opt.id === option.id);

    if (index === -1) {
        // Ajouter l'option additionnelle
        localFormData.value.selectedOptions.push({
            ...option,
            included: false
        });
    } else {
        // Retirer l'option seulement si elle n'est pas incluse
        localFormData.value.selectedOptions = localFormData.value.selectedOptions.filter(
            opt => opt.id !== option.id || isOptionIncluded(opt.id)
        );
    }

    emit('update:formData', {
        ...props.formData,
        forfait: localFormData.value
    });
};

const isOptionDisabled = (optionId) => {
    // Pour le forfait Starter, désactiver Dashboard et E-commerce
    if (localFormData.value.selectedForfait === 'starter') {
        return ['Dashboard', 'ecommerce'].includes(optionId);
    }
    return false;
};

// Fonction pour vérifier si une option est sélectionnée
const isSelected = (optionId) => {
    return localFormData.value.selectedOptions.some(opt => opt.id === optionId);
};

const isMaintenancePlanDisabled = (planId) => {
    // Désactive l'autre plan si un plan est inclus dans le forfait
    if (localFormData.value.selectedForfait === 'standard') {
        return planId === 'pro'; // Désactive le plan Pro si Standard est sélectionné
    }
    if (localFormData.value.selectedForfait === 'premium') {
        return planId === 'basic'; // Désactive le plan Basic si Premium est sélectionné
    }
    return false;
};

const selectMaintenancePlan = (plan) => {
    if (isMaintenancePlanDisabled(plan.id)) return;

    localFormData.value.maintenancePlan =
        localFormData.value.maintenancePlan === plan.id ? null : plan.id;

    emit('update:formData', {
        ...props.formData,
        forfait: localFormData.value
    });
};

const handlePrevious = () => {
    try {
        // Sauvegarder l'état actuel
        const currentState = {
            forfait: localFormData.value.selectedForfait,
            options: localFormData.value.selectedOptions,
            maintenance: localFormData.value.maintenancePlan
        };



        // Mettre à jour le formData avant de revenir en arrière
        const formDataToEmit = {
            template: {
                ...props.formData?.template,
                ...localFormData.value,
                isValidated: false // On réinitialise la validation
            }
        };

        // Émettre la mise à jour des données
        emit('update:formData', formDataToEmit);

        // Émettre l'événement de retour
        emit('previous');

        // Log de confirmation
        console.log('Navigation vers l\'étape précédente...');
    } catch (error) {
        console.error('Erreur lors du retour à l\'étape précédente:', error);
    }
};

const saveStepData = () => {
    try {
        const stepData = {
            ...props.formData,
            template: {
                ...localFormData.value,
                isValidated: true
            }
        }

        emit('update:formData', stepData)
        emit('stepValidated', true)
        return stepData.template
    } catch (error) {
        console.error('Erreur lors de la sauvegarde:', error)
        return {
            selectedForfait: null,
            forfaitDetails: null,
            selectedOptions: [],
            maintenancePlan: null,
            isValidated: false
        }
    }
}

defineExpose({
    saveStepData
})

onMounted(() => {
    try {
        const savedData = localStorage.getItem('projectWizardData');
        if (savedData) {
            const parsedData = JSON.parse(savedData);
            if (parsedData.forfait) {
                localFormData.value = {
                    ...localFormData.value,
                    ...parsedData.forfait
                };

                // Restaurer les détails du forfait si un forfait est sélectionné
                if (localFormData.value.selectedForfait) {
                    const selectedForfait = forfaits.find(f => f.id === localFormData.value.selectedForfait);
                    if (selectedForfait) {
                        localFormData.value.forfaitDetails = selectedForfait;
                    }
                }
            }
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
    }
});

watch(localFormData, (newValue) => {
    try {
        const existingData = JSON.parse(localStorage.getItem('projectWizardData') || '{}');
        const dataToSave = {
            ...existingData,
            forfait: {
                ...newValue,
                lastUpdated: new Date().toISOString()
            }
        };
        localStorage.setItem('projectWizardData', JSON.stringify(dataToSave));

        // Émettre les mises à jour
        emit('update:formData', {
            ...props.formData,
            forfait: { ...newValue }
        });
    } catch (error) {
        console.error('Erreur dans le watcher:', error);
    }
}, { deep: true });

const handleNext = () => {
    try {
        const formDataToEmit = {
            ...props.formData,
            forfait: {
                ...localFormData.value,
                isValidated: true
            }
        };

        // Sauvegarder dans le localStorage
        const existingData = JSON.parse(localStorage.getItem('projectWizardData') || '{}');
        localStorage.setItem('projectWizardData', JSON.stringify({
            ...existingData,
            forfait: {
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

// Ajouter un watcher pour le changement de forfait
watch(() => localFormData.value.selectedForfait, (newForfait) => {
    if (newForfait === 'starter') {
        // Retirer Dashboard et E-commerce des options sélectionnées
        localFormData.value.selectedOptions = localFormData.value.selectedOptions.filter(
            opt => !['Dashboard', 'ecommerce'].includes(opt.id)
        );
    }
});

// Dans la partie script, après les props
const projectRecommendation = ref(null);

// Dans onMounted, après la récupération des données existantes
onMounted(() => {
    try {
        // Récupérer la recommandation
        const recommendation = localStorage.getItem('projectRecommendation');
        if (recommendation) {
            projectRecommendation.value = JSON.parse(recommendation);
        }
    } catch (error) {
        console.error('Erreur lors de la récupération de la recommandation:', error);
    }
});

// Ajouter une computed property pour les forfaits filtrés
const filteredForfaits = computed(() => {
    return forfaits.map(forfait => ({
        ...forfait,
        recommended: projectRecommendation.value?.recommended === forfait.id,
        disabled: projectRecommendation.value?.minimum &&
            isLowerThanMinimum(forfait.id, projectRecommendation.value.minimum)
    }));
});

// Fonction pour vérifier si un forfait est inférieur au minimum requis
const isLowerThanMinimum = (forfaitId, minimumForfait) => {
    const forfaitLevels = {
        'starter': 1,
        'standard': 2,
        'premium': 3
    };
    return forfaitLevels[forfaitId] < forfaitLevels[minimumForfait];
};

</script>

<style scoped>
/* Ajouter des styles pour une transition plus fluide */
.border {
    transition: all 0.2s ease-in-out;
}

.bg-green-50 {
    transition: background-color 0.2s ease-in-out;
}
</style>