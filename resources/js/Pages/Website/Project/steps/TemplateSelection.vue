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
                    <!-- Nouvelle section Options -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 sm:mb-6">
                            Options additionnelles (Optionnel)
                        </h2>

                        <div class="space-y-4 sm:space-y-6">
                            <!-- Services additionnels -->
                            <div class="grid grid-cols-1 gap-4 sm:gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                <div v-for="option in additionalOptions" :key="option.id"
                                    class="relative rounded-xl border-2 p-3 sm:p-4 cursor-pointer transition-all duration-200 transform hover:scale-105 hover:shadow-lg"
                                    :class="[
                                        isSelected(option.id)
                                            ? 'border-green-500 bg-green-50'
                                            : 'border-gray-200 hover:border-green-500 hover:bg-green-50'
                                    ]" @click="toggleOption(option)">

                                    <div class="flex flex-col items-center">
                                        <div class="flex-shrink-0 mb-4">
                                            <i :class="[
                                                'bx text-2xl sm:text-3xl',
                                                option.icon,
                                                isSelected(option.id) ? 'text-green-500' : 'text-gray-400'
                                            ]"></i>
                                        </div>
                                        <div class="text-center w-full">
                                            <h3 class="text-base sm:text-lg font-medium text-gray-900 dark:text-white">
                                                {{ option.name }}
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                {{ option.description }}
                                            </p>
                                            <p class="mt-2 text-green-600 dark:text-green-400 font-medium">
                                                {{ option.price }}€
                                            </p>
                                        </div>

                                        <!-- Bouton de sélection -->
                                        <button @click.stop="toggleOption(option)"
                                            class="mt-4 w-full rounded-lg px-4 py-3 text-sm font-semibold transition-all duration-200"
                                            :class="[
                                                isSelected(option.id)
                                                    ? 'bg-green-600 text-white hover:bg-green-700'
                                                    : 'bg-gray-100 text-gray-700 hover:bg-green-100 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600'
                                            ]">
                                            {{ isSelected(option.id) ? 'Sélectionné' : 'Sélectionner' }}
                                        </button>

                                        <!-- Indicateur de sélection -->
                                        <div v-if="isSelected(option.id)"
                                            class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                            <i class='bx bx-check text-white'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Maintenance mensuelle -->
                            <div class="mt-6 sm:mt-8">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                    Plan de maintenance
                                </h3>
                                <div class="grid grid-cols-1 gap-4 sm:gap-6 md:grid-cols-2">
                                    <div v-for="plan in maintenancePlans" :key="plan.id"
                                        class="relative rounded-xl border-2 p-4 cursor-pointer transition-all duration-200 transform hover:scale-105 hover:shadow-lg"
                                        :class="[
                                            localFormData.maintenancePlan === plan.id
                                                ? 'border-green-500 bg-green-50'
                                                : 'border-gray-200 hover:border-green-500 hover:bg-green-50'
                                        ]" @click="selectMaintenancePlan(plan)">

                                        <h4 class="text-base sm:text-lg font-medium text-gray-900 dark:text-white">
                                            {{ plan.name }}
                                        </h4>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                            {{ plan.description }}
                                        </p>
                                        <p class="mt-3 sm:mt-4 text-green-600 dark:text-green-400 font-medium">
                                            {{ plan.price }}€/an
                                        </p>

                                        <ul class="mt-3 sm:mt-4 space-y-2">
                                            <li v-for="feature in plan.features" :key="feature"
                                                class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                                <i class='bx bx-check text-green-500 mr-2'></i>
                                                {{ feature }}
                                            </li>
                                        </ul>

                                        <!-- Bouton de sélection -->
                                        <button @click.stop="selectMaintenancePlan(plan)"
                                            class="mt-6 w-full rounded-lg px-4 py-3 text-sm font-semibold transition-all duration-200"
                                            :class="[
                                                localFormData.maintenancePlan === plan.id
                                                    ? 'bg-green-600 text-white hover:bg-green-700'
                                                    : 'bg-gray-100 text-gray-700 hover:bg-green-100 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600'
                                            ]">
                                            {{ localFormData.maintenancePlan === plan.id ? 'Sélectionné' :
                                                'Sélectionner' }}
                                        </button>

                                        <!-- Indicateur de sélection -->
                                        <div v-if="localFormData.maintenancePlan === plan.id"
                                            class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                            <i class='bx bx-check text-white'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Maintenance mensuelle -->
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

// Initialisation sécurisée des données locales
const localFormData = ref({
    selectedForfait: null,
    forfaitDetails: null,
    selectedOptions: [],
    maintenancePlan: null
})

// Initialisation des données à partir des props
try {
    if (props.formData?.template) {
        localFormData.value = {
            selectedForfait: props.formData.template.selectedForfait || null,
            forfaitDetails: props.formData.template.forfaitDetails || null,
            selectedOptions: props.formData.template.selectedOptions || [],
            maintenancePlan: props.formData.template.maintenancePlan || null
        }
    }
} catch (error) {
    console.error('Erreur lors de l\'initialisation des données:', error)
}

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
    const formDataToEmit = {
        ...props.formData,
        template: {
            ...localFormData.value,
            isValidated: true
        }
    }

    // Log détaillé des données du template
    console.log('Données du formulaire Template :', {
        previousData: props.formData?.template,
        currentData: {
            forfait: {
                selected: !!localFormData.value.selectedForfait,
                id: localFormData.value.selectedForfait || null,
                details: localFormData.value.forfaitDetails || null,
                price: localFormData.value.forfaitDetails?.price || 0
            },
            options: {
                selected: localFormData.value.selectedOptions.length > 0,
                selections: localFormData.value.selectedOptions,
                totalOptionsPrice: calculateOptionsTotal()
            },
            maintenance: {
                selected: !!localFormData.value.maintenancePlan,
                plan: localFormData.value.maintenancePlan,
                price: calculateMaintenancePrice()
            }
        },
        totals: {
            forfait: localFormData.value.forfaitDetails?.price || 0,
            options: calculateOptionsTotal(),
            maintenance: calculateMaintenancePrice(),
            total: calculateTotal()
        },
        changes: {
            forfaitChanged: props.formData?.template?.selectedForfait !== localFormData.value.selectedForfait,
            optionsChanged: JSON.stringify(props.formData?.template?.selectedOptions) !==
                JSON.stringify(localFormData.value.selectedOptions),
            maintenanceChanged: props.formData?.template?.maintenancePlan !==
                localFormData.value.maintenancePlan
        }
    });

    emit('update:formData', formDataToEmit)
    emit('stepValidated', true)
}

// Surveiller les changements pour mettre à jour le formData
watch(localFormData, () => {
    try {
        const formDataToEmit = {
            ...props.formData,
            template: {
                ...localFormData.value,
                isValidated: false
            }
        }
        emit('update:formData', formDataToEmit)
    } catch (error) {
        console.error('Erreur dans le watcher:', error)
    }
}, { deep: true })

// Fonction pour calculer le total même avec des sélections partielles
const calculateTotal = () => {
    let total = 0;

    // Ajouter le prix du forfait s'il est sélectionné
    if (localFormData.value.forfaitDetails) {
        total += localFormData.value.forfaitDetails.price;
    }

    // Ajouter le prix des options sélectionnées
    const selectedOptionsTotal = localFormData.value.selectedOptions.reduce((sum, optionId) => {
        const option = additionalOptions.find(opt => opt.id === optionId);
        return sum + (option?.price || 0);
    }, 0);
    total += selectedOptionsTotal;

    // Ajouter le prix du plan de maintenance s'il est sélectionné
    if (localFormData.value.maintenancePlan) {
        const maintenancePlan = maintenancePlans.find(plan => plan.id === localFormData.value.maintenancePlan);
        total += maintenancePlan?.price || 0;
    }

    return total;
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
            'Maintenance mensuelle 3 mois offerte',
            'Audit marketing initial offert',
            'Stratégie de contenu personnalisée',
            'Système de formulaires avancé'
        ]
    }
]

const additionalOptions = [
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
]

const maintenancePlans = [
    {
        id: 'basic',
        name: 'Essentiel',
        description: 'Maintenance de base annuelle',
        price: 49,
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
        price: 129,
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
    try {
        if (!forfait) return

        if (localFormData.value.selectedForfait === forfait.id) {
            localFormData.value.selectedForfait = null
            localFormData.value.forfaitDetails = null
        } else {
            localFormData.value.selectedForfait = forfait.id
            localFormData.value.forfaitDetails = forfait
        }
    } catch (error) {
        console.error('Erreur lors de la sélection du forfait:', error)
    }
}

const toggleOption = (option) => {
    const index = localFormData.value.selectedOptions.indexOf(option.id)
    if (index === -1) {
        localFormData.value.selectedOptions.push(option.id)
    } else {
        localFormData.value.selectedOptions.splice(index, 1)
    }
}
const selectMaintenancePlan = (plan) => {
    if (localFormData.value.maintenancePlan === plan.id) {
        // Désélection
        localFormData.value.maintenancePlan = null;
    } else {
        // Sélection
        localFormData.value.maintenancePlan = plan.id;
    }
};

const isSelected = (optionId) => {
    return localFormData.value.selectedOptions.includes(optionId)
}

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
        // Récupération des données du localStorage
        const savedData = localStorage.getItem('projectWizardData');
        if (savedData) {
            const parsedData = JSON.parse(savedData);
            if (parsedData.template) {
                localFormData.value = {
                    ...localFormData.value,
                    ...parsedData.template
                };
              
            }
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des données template:', error);
    }
});

// Modifier le watch existant pour inclure la sauvegarde dans le localStorage
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

const handleNext = () => {
    if (!isFormComplete.value) {
        Object.keys(touchedFields.value).forEach(field => {
            validateField(field);
        });
        return;
    }

    // Log détaillé des données du template
    console.log('Données du formulaire Template :', {
        previousData: props.formData?.template,
        currentData: {
            selectedTemplate: localFormData.value.selectedTemplate,
            templateOptions: localFormData.value.templateOptions,
            isValidated: true
        }
    });

    const formDataToEmit = {
        ...props.formData,
        template: {
            ...localFormData.value,
            isValidated: true
        }
    };

    emit('update:formData', formDataToEmit);
    emit('stepValidated', true);
    emit('next');
};

</script>
