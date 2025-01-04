<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="max-w-[1920px] mx-auto px-8 py-16">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6">
                <form @submit.prevent="validateForm" class="space-y-4 sm:space-y-6">
                    <!-- Type de client -->
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Vous êtes ? *
                            </label>
                            <div class="relative">
                                <div class="flex gap-4">
                                    <label class="relative flex items-center px-6 py-3 rounded-md cursor-pointer border bg-white dark:bg-gray-700"
                                        :class="{
                                            'border-gray-300 dark:border-gray-600': !touchedFields.clientType,
                                            'border-red-300 dark:border-red-500': touchedFields.clientType && formErrors.clientType,
                                            'border-green-500 dark:border-green-400': touchedFields.clientType && isFieldValid.clientType
                                        }">
                                        <input type="radio" v-model="localFormData.clientType" value="individual"
                                            class="sr-only" @change="validateField('clientType')">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">Un
                                            particulier</span>
                                        <i v-if="localFormData.clientType === 'individual'"
                                            class="bx bx-check text-green-500 dark:text-green-400 text-xl ml-2"></i>
                                    </label>
                                    <label class="relative flex items-center px-6 py-3 rounded-md cursor-pointer border bg-white dark:bg-gray-700"
                                        :class="{
                                            'border-gray-300 dark:border-gray-600': !touchedFields.clientType,
                                            'border-red-300 dark:border-red-500': touchedFields.clientType && formErrors.clientType,
                                            'border-green-500 dark:border-green-400': touchedFields.clientType && isFieldValid.clientType
                                        }">
                                        <input type="radio" v-model="localFormData.clientType" value="professional"
                                            class="sr-only" @change="validateField('clientType')">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">Un
                                            professionnel</span>
                                        <i v-if="localFormData.clientType === 'professional'"
                                            class="bx bx-check text-green-500 dark:text-green-400 text-xl ml-2"></i>
                                    </label>
                                </div>
                            </div>
                            <p v-if="formErrors.clientType" class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ formErrors.clientType }}
                            </p>
                        </div>
                    </div>

                    <!-- Champs communs -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <!-- Nom -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nom *
                            </label>
                            <div class="relative">
                                <input type="text" v-model="localFormData.lastName" @input="validateField('lastName')"
                                    class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white dark:bg-gray-700 dark:text-white"
                                    :class="{
                                        'border-gray-300 dark:border-gray-600': !touchedFields.lastName,
                                        'border-red-300 dark:border-red-500': touchedFields.lastName && formErrors.lastName,
                                        'border-green-500 dark:border-green-400': touchedFields.lastName && isFieldValid.lastName
                                    }" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i v-if="isFieldValid.lastName && touchedFields.lastName"
                                        class="bx bx-check text-green-500 dark:text-green-400 text-xl"></i>
                                    <i v-if="formErrors.lastName"
                                        class="bx bx-x text-red-500 dark:text-red-400 text-xl"></i>
                                </div>
                            </div>
                            <p v-if="formErrors.lastName" class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ formErrors.lastName }}
                            </p>
                        </div>

                        <!-- Prénom -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Prénom *
                            </label>
                            <div class="relative">
                                <input type="text" v-model="localFormData.firstName" @input="validateField('firstName')"
                                    class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white dark:bg-gray-700 dark:text-white"
                                    :class="{
                                        'border-gray-300 dark:border-gray-600': !touchedFields.firstName,
                                        'border-red-300 dark:border-red-500': formErrors.firstName,
                                        'border-green-500 dark:border-green-400': isFieldValid.firstName && touchedFields.firstName
                                    }" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i v-if="isFieldValid.firstName && touchedFields.firstName"
                                        class="bx bx-check text-green-500 dark:text-green-400 text-xl"></i>
                                    <i v-if="formErrors.firstName"
                                        class="bx bx-x text-red-500 dark:text-red-400 text-xl"></i>
                                </div>
                            </div>
                            <p v-if="formErrors.firstName" class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ formErrors.firstName }}
                            </p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email *
                            </label>
                            <div class="relative">
                                <input type="email" v-model="localFormData.email" @input="validateField('email')"
                                    class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white dark:bg-gray-700 dark:text-white"
                                    :class="{
                                        'border-gray-300 dark:border-gray-600': !touchedFields.email,
                                        'border-red-300 dark:border-red-500': formErrors.email,
                                        'border-green-500 dark:border-green-400': isFieldValid.email && touchedFields.email
                                    }" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i v-if="isFieldValid.email && touchedFields.email"
                                        class="bx bx-check text-green-500 dark:text-green-400 text-xl"></i>
                                    <i v-if="formErrors.email"
                                        class="bx bx-x text-red-500 dark:text-red-400 text-xl"></i>
                                </div>
                            </div>
                            <p v-if="formErrors.email" class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ formErrors.email }}
                            </p>
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Téléphone *
                            </label>
                            <div class="relative">
                                <input type="tel" v-model="localFormData.phone" @input="validateField('phone')"
                                    class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white dark:bg-gray-700 dark:text-white"
                                    :class="{
                                        'border-gray-300 dark:border-gray-600': !touchedFields.phone,
                                        'border-red-300 dark:border-red-500': formErrors.phone,
                                        'border-green-500 dark:border-green-400': isFieldValid.phone && touchedFields.phone
                                    }" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i v-if="isFieldValid.phone && touchedFields.phone"
                                        class="bx bx-check text-green-500 dark:text-green-400 text-xl"></i>
                                    <i v-if="formErrors.phone"
                                        class="bx bx-x text-red-500 dark:text-red-400 text-xl"></i>
                                </div>
                            </div>
                            <p v-if="formErrors.phone" class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ formErrors.phone }}
                            </p>
                        </div>
                    </div>

                    <!-- Champs professionnels -->
                    <template v-if="localFormData.clientType === 'professional'">
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Activité professionnelle -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Activité professionnelle *
                                </label>
                                <div class="relative">
                                    <input type="text" v-model="localFormData.activity"
                                        @input="validateField('activity')"
                                        class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white dark:bg-gray-700 dark:text-white"
                                        :class="{
                                            'border-gray-300 dark:border-gray-600': !touchedFields.activity,
                                            'border-red-300 dark:border-red-500': formErrors.activity,
                                            'border-green-500 dark:border-green-400': isFieldValid.activity && touchedFields.activity
                                        }" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i v-if="isFieldValid.activity && touchedFields.activity"
                                            class="bx bx-check text-green-500 dark:text-green-400 text-xl"></i>
                                        <i v-if="formErrors.activity"
                                            class="bx bx-x text-red-500 dark:text-red-400 text-xl"></i>
                                    </div>
                                </div>
                                <p v-if="formErrors.activity" class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ formErrors.activity }}
                                </p>
                            </div>

                            <!-- SIREN -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Numéro SIREN *
                                </label>
                                <div class="relative">
                                    <input type="text" v-model="localFormData.siren" @input="validateSiren"
                                        maxlength="9"
                                        class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white dark:bg-gray-700 dark:text-white"
                                        :class="{
                                            'border-gray-300 dark:border-gray-600': !touchedFields.siren,
                                            'border-red-300 dark:border-red-500': sirenError,
                                            'border-green-500 dark:border-green-400': isValidSiren
                                        }" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i v-if="isValidSiren"
                                            class="bx bx-check text-green-500 dark:text-green-400 text-xl"></i>
                                        <i v-if="sirenError" class="bx bx-x text-red-500 dark:text-red-400 text-xl"></i>
                                    </div>
                                </div>
                                <p v-if="sirenError" class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ sirenError }}
                                </p>
                            </div>
                        </div>

                        <!-- Informations de l'entreprise -->
                        <div v-if="isValidSiren && companyDetails"
                            class="mt-6 p-6 rounded-md border bg-white dark:bg-gray-700 cursor-pointer" :class="{
                                'border-gray-300 dark:border-gray-600': !selectedCompany,
                                'border-green-500 dark:border-green-400': selectedCompany
                            }" @click="!selectedCompany && confirmCompanyDetails()">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Informations de l'entreprise
                                </h3>
                                <span class="px-3 py-1 rounded-full text-sm font-medium"
                                    :class="selectedCompany ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : 'bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200'">
                                    {{ selectedCompany ? 'Entreprise confirmée' : 'Cliquez pour confirmer' }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Dénomination</p>
                                    <p class="mt-1 text-base text-gray-900 dark:text-white">
                                        {{ companyDetails.denomination }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Date de création</p>
                                    <p class="mt-1 text-base text-gray-900 dark:text-white">
                                        {{ new Date(companyDetails.dateCreation).toLocaleDateString('fr-FR') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Numéro SIREN</p>
                                    <p class="mt-1 text-base text-gray-900 dark:text-white">
                                        {{ companyDetails.siren }}
                                    </p>
                                </div>

                                <div v-if="companyDetails.siret">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Numéro SIRET</p>
                                    <p class="mt-1 text-base text-gray-900 dark:text-white">
                                        {{ companyDetails.siret }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Navigation -->
                    <div class="mt-8 flex justify-end">
                        <button v-if="isFormComplete" @click="handleNext"
                            class="px-6 py-3 text-base lg:text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 border border-transparent rounded-xl shadow-sm">
                            Suivant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, watch, onMounted, onUnmounted, nextTick } from 'vue'
import axios from 'axios'

const props = defineProps({
    formData: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['update:formData', 'stepValidated', 'next']);

// Ajouter la ref pour selectedCompany
const selectedCompany = ref(null);

// Fonction pour obtenir les données initiales de manière sécurisée
const getInitialData = () => {
    const savedData = localStorage.getItem('projectWizardData');
    const parsedData = savedData ? JSON.parse(savedData) : null;
    const personal = parsedData?.personal || props.formData?.personal || {};

    return {
        clientType: personal.clientType || null,
        firstName: personal.firstName || '',
        lastName: personal.lastName || '',
        email: personal.email || '',
        phone: personal.phone || '',
        activity: personal.activity || '',
        siren: personal.siren || '',
        companyName: personal.companyName || '',
    };
};

// Initialisation sécurisée des données
const localFormData = ref({
    clientType: '',
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    activity: '',
    siren: '',
    companyName: '',
    isValidated: false
});

// Restaurer les données immédiatement depuis les props si disponibles
if (props.formData?.personal) {
    localFormData.value = {
        ...localFormData.value,
        ...props.formData.personal
    };
}

onMounted(() => {
    try {
        const savedData = localStorage.getItem('projectWizardData');
        if (savedData) {
            const parsedData = JSON.parse(savedData);
            if (parsedData.personal) {
                localFormData.value = {
                    ...localFormData.value,
                    ...parsedData.personal
                };

                // Marquer tous les champs comme touchés et valides
                Object.keys(touchedFields.value).forEach(field => {
                    touchedFields.value[field] = true;
                    isFieldValid.value[field] = true;
                });

                // Si c'est un professionnel, valider le SIREN
                if (parsedData.personal.clientType === 'professional' && parsedData.personal.siren) {
                    validateSiren();
                }
            }
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
    }
});

const companyDetails = ref(props.formData?.personal?.companyDetails || null);

// Initialisation sécurisée des champs touchés
const touchedFields = ref({
    clientType: false,
    firstName: false,
    lastName: false,
    email: false,
    phone: false,
    activity: false,
    siren: false,
    companyName: false
});

const formErrors = ref({
    clientType: '',
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    activity: '',
    siren: '',
    companyName: ''
});

const isFieldValid = ref({
    clientType: false,
    firstName: false,
    lastName: false,
    email: false,
    phone: false,
    activity: false,
    siren: true,
    companyName: true
});

// Initialiser la validation si le formulaire est déjà validé
if (props.formData?.personal?.isValidated) {
    Object.keys(isFieldValid.value).forEach(field => {
        isFieldValid.value[field] = true;
        touchedFields.value[field] = true;
    });
}

const validateField = (field) => {
    touchedFields.value[field] = true;

    switch (field) {
        case 'clientType':
            isFieldValid.value[field] = !!localFormData.value[field];
            formErrors.value[field] = !isFieldValid.value[field] ? 'Veuillez sélectionner un type de client' : '';
            break;
        case 'firstName':
            isFieldValid.value[field] = !!localFormData.value[field];
            formErrors.value[field] = !isFieldValid.value[field] ? 'Le prénom est requis' : '';
            break;
        case 'lastName':
            isFieldValid.value[field] = !!localFormData.value[field];
            formErrors.value[field] = !isFieldValid.value[field] ? 'Le nom est requis' : '';
            break;
        case 'email':
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            isFieldValid.value[field] = emailRegex.test(localFormData.value[field]);
            formErrors.value[field] = !isFieldValid.value[field] ? 'Email invalide' : '';
            break;
        case 'phone':
            const phoneNumber = localFormData.value[field].replace(/[^0-9]/g, '');
            localFormData.value[field] = phoneNumber; // Garde uniquement les chiffres

            if (!phoneNumber) {
                formErrors.value[field] = 'Le téléphone est requis';
                isFieldValid.value[field] = false;
            } else if (phoneNumber.length !== 10) {
                formErrors.value[field] = 'Le numéro doit contenir 10 chiffres';
                isFieldValid.value[field] = false;
            } else {
                formErrors.value[field] = '';
                isFieldValid.value[field] = true;
            }
            break;
        case 'activity':
            isFieldValid.value[field] = !!localFormData.value[field];
            formErrors.value[field] = !isFieldValid.value[field] ? 'L\'activité est requise' : '';
            break;
        case 'siren':
            if (localFormData.value.clientType === 'company') {
                isFieldValid.value[field] = !!localFormData.value[field];
                formErrors.value[field] = !isFieldValid.value[field] ? 'Le SIREN est requis pour une entreprise' : '';
            } else {
                isFieldValid.value[field] = true;
                formErrors.value[field] = '';
            }
            break;
        case 'companyName':
            if (localFormData.value.clientType === 'company') {
                isFieldValid.value[field] = !!localFormData.value[field];
                formErrors.value[field] = !isFieldValid.value[field] ? 'Le nom de l\'entreprise est requis' : '';
            } else {
                isFieldValid.value[field] = true;
                formErrors.value[field] = '';
            }
            break;
    }
};



const validateForm = () => {
    Object.keys(touchedFields.value).forEach(field => {
        touchedFields.value[field] = true;
        validateField(field);
    });
};

const isFormComplete = computed(() => {
    // Vérification des champs communs
    const commonFieldsValid = [
        'clientType',
        'firstName',
        'lastName',
        'email',
        'phone'
    ].every(field => {
        const value = localFormData.value[field];
        return value && value.trim() !== '' && isFieldValid.value[field];
    });

    // Si c'est un particulier, on vérifie uniquement les champs communs
    if (localFormData.value.clientType === 'individual') {
        return commonFieldsValid;
    }

    // Si c'est un professionnel
    if (localFormData.value.clientType === 'professional') {
        return commonFieldsValid &&
            localFormData.value.activity &&
            (!localFormData.value.siren || isValidSiren.value); // SIREN optionnel mais valide si renseigné
    }

    return false;
});

const handleNext = () => {
    if (!isFormComplete.value) return;

    try {
        // Préparer les données à émettre
        const formDataToEmit = {
            ...props.formData,
            personal: {
                ...localFormData.value,
                isValidated: true
            }
        };

        // Sauvegarder dans le localStorage
        const savedData = localStorage.getItem('projectWizardData');
        const existingData = savedData ? JSON.parse(savedData) : {};

        localStorage.setItem('projectWizardData', JSON.stringify({
            ...existingData,
            personal: {
                ...localFormData.value,
                isValidated: true,
                lastUpdated: new Date().toISOString()
            }
        }));

        // Émettre les événements
        emit('update:formData', formDataToEmit);
        emit('stepValidated', true);
        emit('next');
    } catch (error) {
        console.error('Erreur lors de la sauvegarde:', error);
    }
};

// Observer les changements
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

const sirenError = ref('')
const isValidSiren = ref(false)
const isCheckingSiren = ref(false)
let sirenTimeout = null

const validateSiren = () => {
    const siren = localFormData.value.siren.replace(/[^0-9]/g, '');
    localFormData.value.siren = siren;

    // Simple validation du format (9 chiffres)
    if (siren && siren.length !== 9) {
        sirenError.value = 'Le numéro SIREN doit contenir 9 chiffres';
        isValidSiren.value = false;
    } else {
        sirenError.value = '';
        isValidSiren.value = true;
    }
};

// Simplifier le watch
watch(() => localFormData.value.siren, (newValue) => {
    // Nettoyer : garder uniquement les chiffres
    const cleanValue = newValue.replace(/[^0-9]/g, '');
    localFormData.value.siren = cleanValue;

    // Valider uniquement si un numéro est entré
    if (cleanValue.length > 0) {
        validateSiren();
    } else {
        // Si vide, pas d'erreur
        sirenError.value = '';
        isValidSiren.value = true;
    }
});

// Réinitialiser les champs professionnels lors du changement de type de client
watch(() => localFormData.value.clientType, (newType) => {
    if (newType !== 'professional') {
        localFormData.value.siren = '';
        localFormData.value.activity = '';
        companyDetails.value = null;
        selectedCompany.value = false;
        isValidSiren.value = false;
        sirenError.value = '';
    }
});

// Validation en temps réel du format SIREN
const validateSirenFormat = () => {
    const siren = localFormData.value.siren.replace(/[^0-9]/g, '');
    localFormData.value.siren = siren;

    if (siren && siren.length !== 9) {
        sirenError.value = 'Le numéro SIREN doit contenir 9 chiffres';
        isValidSiren.value = false;
    } else {
        sirenError.value = '';
    }
};

const confirmCompanyDetails = () => {
    if (!companyDetails.value) return;
    selectedCompany.value = true;

    // Émettre les données mises à jour
    emit('update:formData', {
        personal: {
            ...localFormData.value,
            companyDetails: companyDetails.value,
            companyName: companyDetails.value.denomination,
            siren: companyDetails.value.siren,
            siret: companyDetails.value.siret
        }
    });
};

const resetSirenSelection = () => {
    selectedCompany.value = false;
    isValidSiren.value = false;
    companyDetails.value = null;
    sirenError.value = '';
    localFormData.value.siren = '';
};

// Fonction pour formater la date
const formatDate = (dateString) => {
    if (!dateString) return ''
    return new Date(dateString).toLocaleDateString('fr-FR')
}

// État d'édition initialisé en fonction de la validation précédente
const isEditing = ref(!props.formData?.personal?.isValidated);

const startEditing = () => {
    isEditing.value = true;
    // Réinitialiser les validations
    Object.keys(touchedFields.value).forEach(field => {
        touchedFields.value[field] = true;
        isFieldValid.value[field] = true;
    });

    emit('stepValidated', false);
};

// Surveiller les changements de route/étape
watch(
    () => props.formData,
    (newValue) => {
        // Réinitialiser l'état d'édition si on revient sur cette étape
        if (!newValue?.personal?.isValidated) {
            isEditing.value = true;
        }
    },
    { deep: true }
);

// Réinitialiser l'état d'édition quand on revient sur le composant
onMounted(() => {
    if (!props.formData?.personal?.isValidated) {
        isEditing.value = true;
    }
});

// Fonction pour gérer la sélection de l'entreprise
const handleCompanySelect = (company) => {
    try {
        selectedCompany.value = company;
        if (company) {
            localFormData.value.companyName = company.name;
            localFormData.value.siren = company.siren;
            validateField('companyName');
            validateField('siren');
        }
    } catch (error) {
        console.error('Erreur lors de la sélection de l\'entreprise:', error);
    }
};

// Fonction pour réinitialiser la sélection de l'entreprise
const resetCompanySelection = () => {
    selectedCompany.value = null;
    localFormData.value.companyName = '';
    localFormData.value.siren = '';
};

// Méthode pour sauvegarder les données
const saveStepData = () => {
    const stepData = {
        ...props.formData,
        personal: {
            ...localFormData.value,
            isValidated: true
        }
    }

    // Un seul log lors de la sauvegarde
    console.log('Données personnelles sauvegardées:', stepData.personal);

    // Émettre les données mises à jour
    emit('update:formData', stepData)

    return stepData.personal;
}

// Exposer la méthode saveStepData
defineExpose({
    saveStepData: handleNext
})

// Ajouter un watch spécifique pour le téléphone
watch(() => localFormData.value.phone, (newValue) => {
    // Nettoyer : garder uniquement les chiffres
    const cleanValue = newValue.replace(/[^0-9]/g, '');
    localFormData.value.phone = cleanValue;

    if (touchedFields.value.phone) {
        validateField('phone');
    }
});
</script>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>