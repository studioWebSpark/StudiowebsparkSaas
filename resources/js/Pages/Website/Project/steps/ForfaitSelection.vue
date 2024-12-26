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

            <!-- Grille des forfaits -->
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 mb-24">
                <div v-for="forfait in forfaits" :key="forfait.id"
                    class="relative flex flex-col rounded-xl border-2 p-8 xl:p-10 bg-white dark:bg-[#1E293B] transition-all duration-200 transform hover:scale-105 hover:shadow-lg cursor-pointer"
                    :class="[
                        forfait.popular ? 'border-green-500' : 'border-gray-200 dark:border-gray-700',
                        localFormData.selectedForfait === forfait.id ? 'border-green-500 bg-green-50' : '',
                        'hover:border-green-500 hover:bg-green-50'
                    ]" @click="selectForfait(forfait)">

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
                                class="relative rounded-xl border-2 p-3 sm:p-4 transition-all duration-200" :class="[
                                    option.disabled ? 'border-gray-200 opacity-50' :
                                        ['Dashboard', 'ecommerce'].includes(option.id) ?
                                            (isSelected(option.id) ? 'border-green-500 bg-green-50 cursor-pointer' : 'border-gray-200 hover:border-green-500 hover:bg-green-50 cursor-pointer') :
                                            option.included ? 'border-green-500 bg-green-50' :
                                                isSelected(option.id) ? 'border-green-500 bg-green-50 cursor-pointer' :
                                                    'border-gray-200 hover:border-green-500 hover:bg-green-50 cursor-pointer'
                                ]">
                                <div class="flex flex-col items-center">
                                    <!-- Icône -->
                                    <div class="flex-shrink-0 mb-4">
                                        <i :class="[
                                            'bx text-2xl sm:text-3xl',
                                            option.icon,
                                            option.included || isSelected(option.id) ? 'text-green-500' : 'text-gray-400'
                                        ]"></i>
                                    </div>

                                    <!-- Contenu -->
                                    <div class="text-center w-full">
                                        <h3 class="text-base sm:text-lg font-medium text-gray-900 dark:text-white">
                                            {{ option.name }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            {{ option.description }}
                                        </p>

                                        <!-- Badge et Prix -->
                                        <div class="mt-2">
                                            <span v-if="option.disabled" class="text-gray-500 text-sm">
                                                {{ option.disabledMessage }}
                                            </span>
                                            <span
                                                v-else-if="option.included && !['Dashboard', 'ecommerce'].includes(option.id)"
                                                class="inline-flex flex-col items-center">
                                                <span
                                                    class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class='bx bx-check mr-1'></i>
                                                    Inclus
                                                </span>
                                            </span>
                                            <span v-else class="text-green-600 dark:text-green-400 font-medium">
                                                {{ ['Dashboard', 'ecommerce'].includes(option.id) ? '299' : option.price
                                                }}€
                                            </span>
                                        </div>

                                        <!-- Bouton de sélection -->
                                        <button
                                            v-if="!option.included || ['Dashboard', 'ecommerce'].includes(option.id)"
                                            @click="toggleOption(option)"
                                            class="mt-4 w-full rounded-lg px-4 py-3 text-sm font-semibold transition-all duration-200"
                                            :class="[
                                                isSelected(option.id)
                                                    ? 'bg-green-600 text-white hover:bg-green-700'
                                                    : 'bg-gray-100 text-gray-700 hover:bg-green-100'
                                            ]">
                                            {{ isSelected(option.id) ? 'Sélectionné' : 'Sélectionner' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Plans de maintenance -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                Plans de maintenance annuelle
                            </h3>

                            <!-- Grille des plans de maintenance -->
                            <div class="grid grid-cols-2 gap-8">
                                <div v-for="plan in maintenancePlans" :key="plan.id"
                                    class="relative rounded-xl border-2 p-6 transition-all duration-200" :class="[
                                        (localFormData.selectedForfait === 'standard' && plan.id === 'basic') ||
                                            (localFormData.selectedForfait === 'premium' && plan.id === 'pro')
                                            ? 'border-green-500 bg-green-50'
                                            : isMaintenancePlanDisabled(plan.id)
                                                ? 'border-gray-200 opacity-50 cursor-not-allowed'
                                                : localFormData.maintenancePlan === plan.id
                                                    ? 'border-green-500 bg-green-50 cursor-pointer'
                                                    : 'border-gray-200 hover:border-green-500 hover:bg-green-50 cursor-pointer'
                                    ]">
                                    <div class="flex flex-col items-center">
                                        <!-- Icône -->
                                        <div
                                            class="h-12 w-12 bg-green-100 dark:bg-green-800 rounded-lg flex items-center justify-center mb-4">
                                            <i :class="[
                                                'bx bx-shield-quarter text-2xl',
                                                (localFormData.selectedForfait === 'standard' && plan.id === 'basic') ||
                                                    (localFormData.selectedForfait === 'premium' && plan.id === 'pro') ||
                                                    localFormData.maintenancePlan === plan.id
                                                    ? 'text-green-600'
                                                    : plan.disabled
                                                        ? 'text-gray-400'
                                                        : 'text-gray-600'
                                            ]"></i>
                                        </div>

                                        <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ plan.name }}
                                        </h4>
                                        <p class="text-gray-600 dark:text-gray-400 mb-6">{{ plan.description }}</p>

                                        <!-- Badge Inclus ou Prix -->
                                        <div class="mb-6">
                                            <span v-if="
                                                (localFormData.selectedForfait === 'standard' && plan.id === 'basic') ||
                                                (localFormData.selectedForfait === 'premium' && plan.id === 'pro')"
                                                class="inline-flex flex-col items-center">
                                                <span
                                                    class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class='bx bx-check mr-1'></i>
                                                    Inclus pendant 3 mois
                                                </span>
                                                <span class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                                    Puis {{ plan.price }}€/an
                                                </span>
                                            </span>
                                            <span v-else-if="!plan.disabled"
                                                class="text-3xl font-bold text-green-600 dark:text-green-400">
                                                {{ plan.price }}€<span
                                                    class="text-base font-normal text-gray-500">/an</span>
                                            </span>
                                        </div>

                                        <!-- Liste des fonctionnalités -->
                                        <ul class="space-y-3 mb-6">
                                            <li v-for="feature in plan.features" :key="feature"
                                                class="flex items-start gap-x-3">
                                                <i class='bx bx-check text-green-500 text-xl'></i>
                                                <span class="text-gray-600 dark:text-gray-300">{{ feature }}</span>
                                            </li>
                                        </ul>

                                        <!-- Bouton de sélection -->
                                        <button v-if="!isMaintenancePlanDisabled(plan.id)"
                                            @click="selectMaintenancePlan(plan)"
                                            class="mt-auto w-full rounded-lg px-4 py-3 text-sm font-semibold transition-all duration-200"
                                            :class="[
                                                localFormData.maintenancePlan === plan.id
                                                    ? 'bg-green-600 text-white hover:bg-green-700'
                                                    : 'bg-gray-100 text-gray-700 hover:bg-green-100'
                                            ]">
                                            {{ localFormData.maintenancePlan === plan.id ? 'Sélectionné' :
                                                'Sélectionner' }}
                                        </button>
                                    </div>
                                </div>
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

// Options disponibles
const optionsSelection = [
    {
        id: 'logoPhotos',
        name: 'Création de logo + Photos Pro',
        description: 'Design professionnel de votre identité visuelle',
        price: 59,
        icon: 'bx-palette'
    },
    {
        id: 'socialMedia',
        name: 'Réseaux Sociaux',
        description: 'Création et gestion de vos réseaux sociaux',
        price: 199,
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

    // Log de vérification
    console.log('Validation du formulaire Forfait:', true);
    console.log('Données validées:', validatedData);

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
        price: 349,
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
        price: 699,
        badge: 'Populaire',
        description: 'Solution complète pour une présence web professionnelle et impactante.',
        popular: true,
        features: [
            'Application web 5-7 pages personnalisées',
            'Design premium responsive avec animations',
            'SEO avancé + Suivi de base',
            'Support 30 jours',
            'Délai de livraison : 3-4 jours',
            'Hébergement (optionnel)',
            'Intégration réseaux sociaux',
            'Statistiques Réseaux sociaux + Rapport mensuel',
            'Formulaire de contact personnalisé multi-pages'
        ]
    },
    {
        id: 'premium',
        name: 'Premium',
        price: 1399,
        badge: 'Sur-mesure',
        description: 'Solution premium tout inclus avec accompagnement personnalisé pour une présence web exceptionnelle et des résultats garantis.',
        popular: false,
        features: [
            'Application web 10-12 pages personnalisées avec E-commerce inclus',
            'Design exclusif sur-mesure avec animations premium',
            'SEO Expert + Suivi mensuel personnalisé',
            'Support prioritaire illimité 60 jours',
            'Délai de livraison : 5-7 jours',
            'Hébergement premium 1 an offert',
            'Stratégie de contenu personnalisée',
            'Blog professionnel + Newsletter automatisée',
            'Maintenance 3 mois offerte',
            'Audit marketing initial offert',
            'Stratégie de contenu personnalisée',
            'Système de formulaires avancé'
        ]
    }
]

const TemplateSelection = [
    {
        id: 'logoPhotos',
        name: 'Création de logo + Photos Pro',
        description: 'Design professionnel de votre identité visuelle',
        price: 199,
        icon: 'bx-image'
    },
    {
        id: 'socialMedia',
        name: 'Réseaux Sociaux',
        description: 'Création et gestion de vos réseaux sociaux',
        price: 199,
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
    // Réinitialiser les options lors du changement de forfait
    localFormData.value = {
        ...localFormData.value,
        selectedForfait: forfait.id,
        forfaitDetails: forfait,
        includedOptions: [],
        selectedOptions: []
    };

    // Si c'est le forfait premium, ajouter les options incluses
    if (forfait.id === 'premium') {
        localFormData.value.includedOptions = [
            {
                id: 'socialMedia',
                name: 'Réseaux Sociaux',
                price: 0,
                description: 'Création et gestion de vos réseaux sociaux',
                icon: 'bx-share-alt'
            },
            {
                id: 'logoPhotos',
                name: 'Création de logo + Photos Pro',
                price: 0,
                description: 'Design professionnel de votre identité visuelle',
                icon: 'bx-image'
            }
        ];
    }

    // Émettre la mise à jour vers le parent
    emit('update:formData', {
        ...props.formData,
        forfait: localFormData.value
    });

    console.log('=== FORFAIT SÉLECTIONNÉ ===');
    console.log('Forfait:', forfait.id);
    console.log('Options incluses:', localFormData.value.includedOptions);
    console.log('Options sélectionnées:', localFormData.value.selectedOptions);
    console.log('========================');
};

const isOptionDisabled = (optionId) => {
    // Pour le forfait Starter, désactiver Dashboard et E-commerce
    if (localFormData.value.selectedForfait === 'starter') {
        return ['Dashboard', 'ecommerce'].includes(optionId);
    }
    return false;
};

const toggleOption = (option) => {
    // Ne rien faire si l'option est désactivée pour le forfait Starter
    if (option.disabled) return;

    if (['Dashboard', 'ecommerce'].includes(option.id)) {
        const selectedOption = {
            id: option.id,
            name: option.id === 'Dashboard' ? 'Dashboard (CRM)' : 'E-commerce',
            price: 299,
            description: option.id === 'Dashboard'
                ? 'Suivi détaillé de vos performances'
                : 'Solution complète de vente en ligne',
            icon: option.id === 'Dashboard' ? 'bx-line-chart' : 'bx-store'
        };

        const index = localFormData.value.selectedOptions.findIndex(
            opt => opt.id === option.id
        );

        if (index === -1) {
            localFormData.value.selectedOptions.push(selectedOption);
        } else {
            localFormData.value.selectedOptions = localFormData.value.selectedOptions.filter(
                opt => opt.id !== option.id
            );
        }
    }
};

// Fonction pour vérifier si une option est sélectionnée
const isSelected = (optionId) => {
    return localFormData.value.selectedOptions.some(
        opt => opt.id === optionId
    );
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
    // Empêche la sélection si le plan est désactivé
    if (isMaintenancePlanDisabled(plan.id)) return;

    localFormData.value.maintenancePlan =
        localFormData.value.maintenancePlan === plan.id ? null : plan.id;
};

const handlePrevious = () => {
    try {
        // Sauvegarder l'état actuel
        const currentState = {
            forfait: localFormData.value.selectedForfait,
            options: localFormData.value.selectedOptions,
            maintenance: localFormData.value.maintenancePlan
        };

        console.log('État sauvegardé avant retour :', currentState);

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

// Computed pour filtrer les options selon le forfait
const availableOptions = computed(() => {
    return TemplateSelection.map(option => {
        const isStarterForfait = localFormData.value.selectedForfait === 'starter';
        const isDashboardOrEcommerce = ['Dashboard', 'ecommerce'].includes(option.id);

        return {
            ...option,
            disabled: isStarterForfait && isDashboardOrEcommerce,
            disabledMessage: isStarterForfait && isDashboardOrEcommerce ? 'Indisponible pour ce forfait' : null
        };
    });
});

// Définir les options incluses par forfait
const includedOptionsByForfait = {
    premium: [
        {
            id: 'logoPhotos',
            name: 'Création de logo + Photos Pro',
            price: 199,
            description: 'Design professionnel de votre identité visuelle',
            icon: 'bx-image'
        },
        {
            id: 'socialMedia',
            name: 'Réseaux Sociaux',
            price: 199,
            description: 'Création et gestion de vos réseaux sociaux',
            icon: 'bx-share-alt'
        }
    ],
    standard: [
        {
            id: 'logoPhotos',
            name: 'Création de logo + Photos Pro',
            price: 199,
            description: 'Design professionnel de votre identité visuelle',
            icon: 'bx-image'
        }
    ],
    starter: []
};

// Fonction pour obtenir les options incluses selon le forfait
const getIncludedOptions = (forfaitId) => {
    const includedIds = includedOptionsByForfait[forfaitId] || [];
    return TemplateSelection.filter(option => includedIds.includes(option.id));
};

// Mettre à jour localFormData quand le forfait change
watch(() => localFormData.value.selectedForfait, (newForfait) => {
    if (newForfait) {
        console.log('Forfait sélectionné:', newForfait);
        console.log('Options incluses:', getIncludedOptions(newForfait));
        console.log('Toutes les options:', TemplateSelection);
    }
});

// Dans la fonction de validation
const validateStep = () => {
    // ... autre code ...

    // Ajouter les options incluses aux données du formulaire
    formData.value.forfait = {
        ...localFormData.value,
        includedOptions: getIncludedOptions(localFormData.value.selectedForfait)
    };
};

// Modification de la fonction isOptionIncluded si elle existe
const isOptionIncluded = (optionId) => {
    if (!localFormData.value.selectedForfait) return false;
    const includedOptions = getIncludedOptions(localFormData.value.selectedForfait);
    return includedOptions.some(option => option.id === optionId);
};

const selectedOptions = ref([
    {
        id: 'socialMedia',
        name: 'Réseaux Sociaux',
        price: 199,
        description: 'Création et gestion de vos réseaux sociaux',
        icon: 'bx-share-alt'
    },
    {
        id: 'Dashboard',
        name: 'Dashboard (CRM)',
        price: 299,
        description: 'Suivi détaillé de vos performances',
        icon: 'bx-line-chart'
    }
]);

// Assurez-vous que les options sont toujours des objets complets
const handleOptionSelection = (option) => {
    if (typeof option === 'string') {
        // Convertir en objet si c'est une chaîne
        const optionDetails = availableOptions.find(opt => opt.id === option);
        if (optionDetails) {
            selectedOptions.value.push(optionDetails);
        }
    } else {
        selectedOptions.value.push(option);
    }
};

// Constantes pour séparer les options
const includedOptions = computed(() => {
    return (localFormData.value.selectedOptions || []).filter(option =>
        option.id === 'socialMedia' || option.id === 'logoPhotos'
    );
});

const selectedAdditionalOptions = computed(() => {
    return (localFormData.value.selectedOptions || []).filter(option =>
        option.id !== 'socialMedia' && option.id !== 'logoPhotos'
    );
});

// Log pour vérifier la séparation
watch([includedOptions, selectedAdditionalOptions], () => {
    console.log('Options séparées :', {
        optionsIncluses: includedOptions.value,  // Contiendra Réseaux Sociaux et Logo
        optionsSelectionnees: selectedAdditionalOptions.value  // Contiendra Dashboard
    });
});

// Ajouter un watcher pour logger les changements
watch([includedOptions, selectedAdditionalOptions], () => {
    console.log('=== SÉPARATION DES OPTIONS ===');
    console.log('Options incluses dans le forfait:', includedOptions.value);
    console.log('Options supplémentaires sélectionnées:', selectedAdditionalOptions.value);
    console.log('================================');
}, { immediate: true });

// Ajouter un watcher pour le changement de forfait
watch(() => localFormData.value.selectedForfait, (newForfait) => {
    if (newForfait === 'starter') {
        // Retirer Dashboard et E-commerce des options sélectionnées
        localFormData.value.selectedOptions = localFormData.value.selectedOptions.filter(
            opt => !['Dashboard', 'ecommerce'].includes(opt.id)
        );
    }
});

</script>
