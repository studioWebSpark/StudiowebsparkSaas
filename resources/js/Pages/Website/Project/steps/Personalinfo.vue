<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6">
        <!-- Bouton Modifier -->
        <div v-if="!isEditing && formData.personal.isValidated" class="mb-4 flex justify-end">
            <button type="button" @click="startEditing"
                class="px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                <i class='bx bx-edit mr-2'></i>
                Modifier mes informations
            </button>
        </div>

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
                            <label class="relative flex items-center px-6 py-3 rounded-md cursor-pointer" :class="{
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
                            <label class="relative flex items-center px-6 py-3 rounded-md cursor-pointer" :class="{
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
                    <p v-if="formErrors.clientType" class="mt-1 text-sm text-red-600">{{ formErrors.clientType }}</p>
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
                    <p v-if="formErrors.lastName" class="mt-1 text-sm text-red-600">{{ formErrors.lastName }}</p>
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
                    <p v-if="formErrors.firstName" class="mt-1 text-sm text-red-600">{{ formErrors.firstName }}</p>
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
                            <input type="text" v-model="localFormData.activity" @input="validateField('activity')"
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
                        <p v-if="formErrors.activity" class="mt-1 text-sm text-red-600">{{ formErrors.activity }}</p>
                    </div>

                    <!-- SIREN -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Numéro SIREN *
                        </label>
                        <div class="relative">
                            <input type="text" v-model="localFormData.siren" @input="validateSiren" maxlength="9"
                                :disabled="!isEditing" class="mt-1 block w-full pr-10 rounded-md shadow-sm bg-white"
                                :class="{
                                    'border-gray-300': !touchedFields.siren,
                                    'border-red-300': sirenError,
                                    'border-green-500': isValidSiren,
                                    'opacity-75': !isEditing
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
                <div v-if="isValidSiren && companyDetails" class="mt-6 p-6 rounded-md border bg-white cursor-pointer"
                    :class="{
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
        </form>

        <!-- Bouton Suivant/Valider avec transition -->
        <transition enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 translate-y-4" enter-to-class="transform opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-150" leave-from-class="transform opacity-100 translate-y-0"
            leave-to-class="transform opacity-0 translate-y-4">
            <div v-if="isFormComplete && isEditing" class="mt-6">
                <button type="button" @click="validateForm"
                    class="w-full sm:w-auto px-6 py-3 text-base lg:text-lg font-medium text-white bg-blue-600 border border-transparent rounded-xl shadow-sm hover:bg-blue-700 transition-colors">
                    {{ formData.personal.isValidated ? 'Valider les modifications' : 'Suivant' }}
                    <i class='bx bx-check ml-2'></i>
                </button>
            </div>
        </transition>
    </div>

</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'
import axios from 'axios'

// Initialisation des variables réactives
const formErrors = ref({
    lastName: '',
    firstName: '',
    email: '',
    phone: '',
    activity: '',
    siren: '',
    clientType: ''
});

const isFieldValid = ref({
    lastName: false,
    firstName: false,
    email: false,
    phone: false,
    activity: false,
    siren: false,
    clientType: false
});

const touchedFields = ref({
    lastName: false,
    firstName: false,
    email: false,
    phone: false,
    activity: false,
    siren: false,
    clientType: false
});

const sirenError = ref('')
const isValidSiren = ref(false)
const isCheckingSiren = ref(false)
let sirenTimeout = null

const props = defineProps({
    formData: {
        type: Object,
        required: true,
        default: () => ({
            personal: {
                clientType: 'individual',
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                activity: '',
                siren: '',
                companyName: '',
                companyDetails: null,
                isValidated: false
            }
        })
    }
});

// Une seule déclaration pour companyDetails et selectedCompany
const companyDetails = ref(props.formData?.personal?.companyDetails || null);
const selectedCompany = ref(!!props.formData?.personal?.companyDetails);

const localFormData = ref({
    clientType: props.formData?.personal?.clientType || 'individual',
    firstName: props.formData?.personal?.firstName || '',
    lastName: props.formData?.personal?.lastName || '',
    email: props.formData?.personal?.email || '',
    phone: props.formData?.personal?.phone || '',
    activity: props.formData?.personal?.activity || '',
    siren: props.formData?.personal?.siren || '',
    companyName: props.formData?.personal?.companyName || ''
});

const emit = defineEmits(['update:formData', 'stepValidated', 'next']);

// Validation du formulaire
const isFormValid = computed(() => {
    const baseFieldsValid =
        isFieldValid.value.lastName &&
        isFieldValid.value.firstName &&
        isFieldValid.value.email &&
        isFieldValid.value.phone

    if (localFormData.value.clientType === 'professional') {
        return baseFieldsValid &&
            isFieldValid.value.activity &&
            isValidSiren.value &&
            selectedCompany.value
    }

    return baseFieldsValid
})

const validateSiren = async () => {
    const siren = localFormData.value.siren.replace(/[^0-9]/g, '');
    localFormData.value.siren = siren;

    if (siren.length !== 9) {
        if (siren.length > 0) {
            sirenError.value = 'Le numéro SIREN doit contenir 9 chiffres';
        }
        isValidSiren.value = false;
        companyDetails.value = null;
        selectedCompany.value = false;
        return;
    }

    clearTimeout(sirenTimeout);
    sirenTimeout = setTimeout(async () => {
        isCheckingSiren.value = true;

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

            if (error.response?.status === 404) {
                sirenError.value = 'Entreprise non trouvée';
            } else {
                sirenError.value = 'Une erreur est survenue lors de la vérification';
            }
        } finally {
            isCheckingSiren.value = false;
        }
    }, 500);
};

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

watch(localFormData, (newValue) => {
    emit('update:formData', { personal: newValue })
}, { deep: true })

// Nettoyage au démontage
onUnmounted(() => {
    if (sirenTimeout) {
        clearTimeout(sirenTimeout)
    }
})

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

const validateForm = () => {
    if (isFormComplete.value) {
        isEditing.value = false;
        const formDataToEmit = {
            personal: {
                ...localFormData.value,
                companyDetails: companyDetails.value,
                isValidated: true
            }
        };

        console.log('Données du formulaire :', formDataToEmit);
        emit('update:formData', formDataToEmit);
        emit('stepValidated', true);
        emit('next');
        return true;
    }
    return false;
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

const validateField = (field) => {
    touchedFields.value[field] = true;

    switch (field) {
        case 'clientType':
            isFieldValid.value[field] = !!localFormData.value[field];
            formErrors.value[field] = !isFieldValid.value[field] ? 'Veuillez sélectionner votre type de client' : '';
            break;
        case 'lastName':
        case 'firstName':
            isFieldValid.value[field] = localFormData.value[field].length >= 2;
            formErrors.value[field] = !isFieldValid.value[field] ? 'Ce champ est obligatoire' : '';
            break;
        case 'email':
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            isFieldValid.value[field] = emailRegex.test(localFormData.value[field]);
            formErrors.value[field] = !isFieldValid.value[field] ? 'Veuillez saisir une adresse email valide' : '';
            break;
        case 'phone':
            const phoneRegex = /^[0-9+\s-]{10,}$/;
            isFieldValid.value[field] = phoneRegex.test(localFormData.value[field]);
            formErrors.value[field] = !isFieldValid.value[field] ? 'Veuillez saisir un numéro de téléphone valide' : '';
            break;
        case 'activity':
            isFieldValid.value[field] = localFormData.value[field].length >= 3;
            formErrors.value[field] = !isFieldValid.value[field] ? 'Ce champ est obligatoire' : '';
            break;
        case 'siren':
            isFieldValid.value[field] = localFormData.value[field].length === 9;
            formErrors.value[field] = !isFieldValid.value[field] ? 'Le numéro SIREN doit contenir 9 chiffres' : '';
            break;
    }
};

const isFormComplete = computed(() => {
    const isPersonalInfoValid = isFieldValid.value.lastName &&
        isFieldValid.value.firstName &&
        isFieldValid.value.email &&
        isFieldValid.value.phone;

    if (localFormData.value.clientType === 'professional') {
        return isPersonalInfoValid &&
            isFieldValid.value.activity &&
            isValidSiren.value &&
            selectedCompany.value;
    }

    return isPersonalInfoValid;
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
