<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="max-w-[1920px] mx-auto px-8 py-16">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6">
                <form @submit.prevent="validateForm" class="space-y-4 sm:space-y-6">
                    <!-- Type de client -->
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Type de client -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Vous êtes ? *
                            </label>
                            <div class="relative">
                                <div class="flex gap-4">
                                    <label class="relative flex items-center px-6 py-3 rounded-md cursor-pointer"
                                        :class="{
                                            'border-gray-300': !touchedFields.clientType,
                                            'border-red-300': formErrors.clientType,
                                            'border-green-500 ': isFieldValid.clientType && touchedFields.clientType,
                                            'border': true
                                        }">
                                        <input type="radio" v-model="localFormData.clientType" value="individual"
                                            class="sr-only" @change="validateField('clientType')">
                                        <span class="text-sm font-medium text-gray-900">Un particulier</span>
                                        <i v-if="localFormData.clientType === 'individual'"
                                            class="bx bx-check text-green-500 text-xl ml-2"></i>
                                    </label>
                                    <label class="relative flex items-center px-6 py-3 rounded-md cursor-pointer"
                                        :class="{
                                            'border-gray-300': !touchedFields.clientType,
                                            'border-red-300': formErrors.clientType,
                                            'border-green-500 ': isFieldValid.clientType && touchedFields.clientType,
                                            'border': true
                                        }">
                                        <input type="radio" v-model="localFormData.clientType" value="professional"
                                            class="sr-only" @change="validateField('clientType')">
                                        <span class="text-sm font-medium text-gray-900">Un professionnel</span>
                                        <i v-if="localFormData.clientType === 'professional'"
                                            class="bx bx-check text-green-500 text-xl ml-2"></i>
                                    </label>
                                </div>
                            </div>
                            <p v-if="formErrors.clientType" class="mt-1 text-sm text-red-600">{{ formErrors.clientType
                                }}</p>
                        </div>
                    </div>

                    <!-- Champs communs -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <!-- Nom -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nom *
                            </label>
                            <div class="relative">
                                <input :disabled="!isEditing" type="text" v-model="localFormData.lastName"
                                    @input="validateField('lastName')"
                                    class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white" :class="{
                                        'border-gray-300': !touchedFields.lastName,
                                        'border-red-300': formErrors.lastName,
                                        'border-green-500': isFieldValid.lastName && touchedFields.lastName,
                                        'opacity-75': !isEditing
                                    }" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i v-if="isFieldValid.lastName && touchedFields.lastName"
                                        class="bx bx-check text-green-500 text-xl"></i>
                                    <i v-if="formErrors.lastName" class="bx bx-x text-red-500 text-xl"></i>
                                </div>
                            </div>
                            <p v-if="formErrors.lastName" class="mt-1 text-sm text-red-600">{{ formErrors.lastName }}
                            </p>
                        </div>

                        <!-- Prénom -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Prénom *
                            </label>
                            <div class="relative">
                                <input :disabled="!isEditing" type="text" v-model="localFormData.firstName"
                                    @input="validateField('firstName')"
                                    class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white" :class="{
                                        'border-gray-300': !touchedFields.firstName,
                                        'border-red-300': formErrors.firstName,
                                        'border-green-500': isFieldValid.firstName && touchedFields.firstName,
                                        'opacity-75': !isEditing
                                    }" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i v-if="isFieldValid.firstName && touchedFields.firstName"
                                        class="bx bx-check text-green-500 text-xl"></i>
                                    <i v-if="formErrors.firstName" class="bx bx-x text-red-500 text-xl"></i>
                                </div>
                            </div>
                            <p v-if="formErrors.firstName" class="mt-1 text-sm text-red-600">{{ formErrors.firstName }}
                            </p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Email *
                            </label>
                            <div class="relative">
                                <input :disabled="!isEditing" type="email" v-model="localFormData.email"
                                    @input="validateField('email')"
                                    class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white" :class="{
                                        'border-gray-300': !touchedFields.email,
                                        'border-red-300': formErrors.email,
                                        'border-green-500': isFieldValid.email && touchedFields.email,
                                        'opacity-75': !isEditing
                                    }" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i v-if="isFieldValid.email && touchedFields.email"
                                        class="bx bx-check text-green-500 text-xl"></i>
                                    <i v-if="formErrors.email" class="bx bx-x text-red-500 text-xl"></i>
                                </div>
                            </div>
                            <p v-if="formErrors.email" class="mt-1 text-sm text-red-600">{{ formErrors.email }}</p>
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Téléphone *
                            </label>
                            <div class="relative">
                                <input :disabled="!isEditing" type="tel" v-model="localFormData.phone"
                                    @input="validateField('phone')"
                                    class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white" :class="{
                                        'border-gray-300': !touchedFields.phone,
                                        'border-red-300': formErrors.phone,
                                        'border-green-500': isFieldValid.phone && touchedFields.phone,
                                        'opacity-75': !isEditing
                                    }" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i v-if="isFieldValid.phone && touchedFields.phone"
                                        class="bx bx-check text-green-500 text-xl"></i>
                                    <i v-if="formErrors.phone" class="bx bx-x text-red-500 text-xl"></i>
                                </div>
                            </div>
                            <p v-if="formErrors.phone" class="mt-1 text-sm text-red-600">{{ formErrors.phone }}</p>
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
                                        class="mt-1 block w-full pr-10 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        :class="{
                                            'border-gray-300': !touchedFields.activity,
                                            'border-red-300': formErrors.activity,
                                            'border-green-500': isFieldValid.activity && touchedFields.activity
                                        }" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i v-if="isFieldValid.activity && touchedFields.activity"
                                            class="bx bx-check text-green-500 text-xl"></i>
                                        <i v-if="formErrors.activity" class="bx bx-x text-red-500 text-xl"></i>
                                    </div>
                                </div>
                                <p v-if="formErrors.activity" class="mt-1 text-sm text-red-600">{{ formErrors.activity
                                    }}</p>
                            </div>

                            <!-- SIREN -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Numéro SIREN *
                                </label>
                                <div class="relative">
                                    <input type="text" v-model="localFormData.siren" @input="validateSiren"
                                        maxlength="9" class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white"
                                        :class="{
                                            'border-gray-300': !touchedFields.siren,
                                            'border-red-300': sirenError,
                                            'border-green-500': isValidSiren
                                        }" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i v-if="isValidSiren" class="bx bx-check text-green-500 text-xl"></i>
                                        <i v-if="sirenError" class="bx bx-x text-red-500 text-xl"></i>
                                    </div>
                                </div>
                                <p v-if="sirenError" class="mt-1 text-sm text-red-600">{{ sirenError }}</p>
                            </div>
                        </div>

                        <!-- Informations de l'entreprise -->
                        <div v-if="isValidSiren && companyDetails"
                            class="mt-6 p-6 rounded-md border bg-white cursor-pointer" :class="{
                                'border-gray-300': !selectedCompany,
                                'border-green-500': selectedCompany
                            }" @click="!selectedCompany && confirmCompanyDetails()">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-sm font-medium text-gray-700">Informations de l'entreprise</h3>
                                <span class="px-3 py-1 rounded-full text-sm font-medium"
                                    :class="selectedCompany ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'">
                                    {{ selectedCompany ? 'Entreprise confirmée' : 'Cliquez pour confirmer' }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Dénomination</p>
                                    <p class="mt-1 text-base text-gray-900">{{ companyDetails.denomination }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Date de création</p>
                                    <p class="mt-1 text-base text-gray-900">
                                        {{ new Date(companyDetails.dateCreation).toLocaleDateString('fr-FR') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">Numéro SIREN</p>
                                    <p class="mt-1 text-base text-gray-900">{{ companyDetails.siren }}</p>
                                </div>

                                <div v-if="companyDetails.siret">
                                    <p class="text-sm font-medium text-gray-500">Numéro SIRET</p>
                                    <p class="mt-1 text-base text-gray-900">{{ companyDetails.siret }}</p>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Ajout du composant de sélection d'entreprise -->
                    <div v-if="localFormData.clientType === 'company'" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Sélectionner une entreprise
                        </label>
                        <div class="mt-1">
                            <!-- Ajouter ici votre composant de recherche/sélection d'entreprise -->
                            <!-- Par exemple : -->
                            <input type="text" v-model="localFormData.companyName" @input="handleCompanySelect(null)"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Nom de l'entreprise" />
                        </div>
                    </div>
                </form>

                <!-- Navigation -->
                <div class="mt-8 flex justify-end">
                    <button v-if="isFormComplete" @click="handleNext"
                        class="px-6 py-3 text-base lg:text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 border border-transparent rounded-xl shadow-sm">
                        Suivant
                    </button>
                </div>
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
        // D'abord essayer de charger depuis les props
        if (props.formData?.personal) {
            localFormData.value = {
                ...localFormData.value,
                ...props.formData.personal
            };
        }
        // Sinon, essayer de charger depuis le localStorage
        else {
            const savedData = localStorage.getItem('projectWizardData');
            if (savedData) {
                const parsedData = JSON.parse(savedData);
                if (parsedData.personal) {
                    localFormData.value = {
                        ...localFormData.value,
                        ...parsedData.personal
                    };
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
            isFieldValid.value[field] = !!localFormData.value[field];
            formErrors.value[field] = !isFieldValid.value[field] ? 'Le téléphone est requis' : '';
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

    // Si c'est un professionnel, on vérifie aussi les champs spécifiques et la sélection de l'entreprise
    if (localFormData.value.clientType === 'professional') {
        return commonFieldsValid &&
            localFormData.value.activity &&
            localFormData.value.siren &&
            isValidSiren.value &&
            selectedCompany.value;
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

const validateSiren = async () => {
    const siren = localFormData.value.siren.replace(/[^0-9]/g, '');
    localFormData.value.siren = siren;

    if (siren.length !== 9) {
        sirenError.value = siren.length > 0 ? 'Le numéro SIREN doit contenir 9 chiffres' : '';
        isValidSiren.value = false;
        companyDetails.value = null;
        selectedCompany.value = false;
        return;
    }

    try {
        const response = await axios.post('/api/verify-siren', { siren });
        if (response.data.success && response.data.company) {
            const uniteLegale = response.data.company.uniteLegale;
            companyDetails.value = {
                denomination: uniteLegale.denominationUniteLegale,
                siren: uniteLegale.siren,
                siret: uniteLegale.siret,
                dateCreation: uniteLegale.dateCreationUniteLegale
            };
            isValidSiren.value = true;
            selectedCompany.value = false;
            sirenError.value = '';
        }
    } catch (error) {
        console.error('Erreur détaillée:', error);
        isValidSiren.value = false;
        companyDetails.value = null;
        selectedCompany.value = false;
        sirenError.value = error.response?.status === 404 ? 'Entreprise non trouvée' : 'Une erreur est survenue';
    }
};

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
