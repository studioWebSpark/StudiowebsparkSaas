<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6">
        <form @submit.prevent="validateForm" class="space-y-4 sm:space-y-6">
            <!-- Type de client -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Vous êtes ? *
                </label>
                <div class="flex flex-wrap gap-4">
                    <label class="relative flex items-center p-3 rounded-lg border cursor-pointer focus:outline-none"
                        :class="[localFormData.clientType === 'individual' ? 'bg-blue-50 border-blue-200 z-10' : 'border-gray-200']">
                        <input type="radio" v-model="localFormData.clientType" value="individual" class="sr-only">
                        <span class="ml-2 text-sm font-medium text-gray-900">Un particulier</span>
                        <i v-if="localFormData.clientType === 'individual'"
                            class="bx bx-check text-blue-600 text-xl ml-2"></i>
                    </label>
                    <label class="relative flex items-center p-3 rounded-lg border cursor-pointer focus:outline-none"
                        :class="[localFormData.clientType === 'professional' ? 'bg-blue-50 border-blue-200 z-10' : 'border-gray-200']">
                        <input type="radio" v-model="localFormData.clientType" value="professional" class="sr-only">
                        <span class="ml-2 text-sm font-medium text-gray-900">Un professionnel</span>
                        <i v-if="localFormData.clientType === 'professional'"
                            class="bx bx-check text-blue-600 text-xl ml-2"></i>
                    </label>
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
                            class="mt-1 block w-full pr-10 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            :class="{
                                'border-gray-300': !touchedFields.lastName,
                                'border-red-300': formErrors.lastName,
                                'border-green-500': isFieldValid.lastName && touchedFields.lastName
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
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Prénom *
                    </label>
                    <div class="relative">
                        <input type="text" v-model="localFormData.firstName" @input="validateField('firstName')"
                            class="mt-1 block w-full pr-10 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            :class="{
                                'border-gray-300': !touchedFields.firstName,
                                'border-red-300': formErrors.firstName,
                                'border-green-500': isFieldValid.firstName && touchedFields.firstName
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
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email *
                    </label>
                    <div class="relative">
                        <input type="email" v-model="localFormData.email" @input="validateField('email')"
                            class="mt-1 block w-full pr-10 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            :class="{
                                'border-gray-300': !touchedFields.email,
                                'border-red-300': formErrors.email,
                                'border-green-500': isFieldValid.email && touchedFields.email
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
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Téléphone *
                    </label>
                    <div class="relative">
                        <input type="tel" v-model="localFormData.phone" @input="validateField('phone')"
                            class="mt-1 block w-full pr-10 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            :class="{
                                'border-gray-300': !touchedFields.phone,
                                'border-red-300': formErrors.phone,
                                'border-green-500': isFieldValid.phone && touchedFields.phone
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
                                class="mt-1 block w-full pr-10 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                :class="{
                                    'border-gray-300': !touchedFields.siren,
                                    'border-red-300': sirenError,
                                    'border-green-500': isValidSiren
                                }" :disabled="selectedCompany" required>
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
                    class="mt-6 p-6 bg-gray-50 border border-gray-200 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            Informations de l'entreprise
                        </h3>
                        <div class="flex items-center gap-4">
                            <span :class="[
                                'px-3 py-1 rounded-full text-sm font-medium',
                                selectedCompany ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'
                            ]">
                                {{ selectedCompany ? 'Entreprise confirmée' : 'En attente de sélection' }}
                            </span>
                            <button v-if="selectedCompany" type="button" @click="resetSirenSelection"
                                class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                <i class="bx bx-edit mr-1"></i>
                                Modifier
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
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

                    <div class="mt-6">
                        <button type="button" @click="confirmCompanyDetails"
                            class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white transition-colors duration-200"
                            :class="[
                                selectedCompany
                                    ? 'bg-green-600 hover:bg-green-700 focus:ring-green-500'
                                    : 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500'
                            ]" :disabled="selectedCompany">
                            <i class="bx bx-check-circle mr-2 text-xl"></i>
                            {{ selectedCompany ? 'Entreprise confirmée' : 'Sélectionner cette entreprise' }}
                        </button>
                    </div>
                </div>
            </template>
        </form>
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
    company: ''
})

const isFieldValid = ref({
    lastName: false,
    firstName: false,
    email: false,
    phone: false,
    activity: false,
    siren: false
})

const touchedFields = ref({
    lastName: false,
    firstName: false,
    email: false,
    phone: false,
    activity: false,
    siren: false
})

const sirenError = ref('')
const isValidSiren = ref(false)
const isCheckingSiren = ref(false)
const companyDetails = ref(null)
const selectedCompany = ref(false)
const showErrors = ref(false)
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
                companyName: ''
            }
        })
    }
})

// S'assurer que localFormData est initialisé avec des valeurs par défaut
const localFormData = ref({
    clientType: props.formData?.personal?.clientType || 'individual',
    firstName: props.formData?.personal?.firstName || '',
    lastName: props.formData?.personal?.lastName || '',
    email: props.formData?.personal?.email || '',
    phone: props.formData?.personal?.phone || '',
    activity: props.formData?.personal?.activity || '',
    siren: props.formData?.personal?.siren || '',
    companyName: props.formData?.personal?.companyName || ''
})

const emit = defineEmits(['update:formData', 'stepValidated'])

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
        return;
    }

    clearTimeout(sirenTimeout);
    sirenTimeout = setTimeout(async () => {
        isCheckingSiren.value = true;

        try {
            // Utilisation de l'URL complète
            const response = await axios.post('/api/verify-siren', {
                siren: siren  // S'assurer que le paramètre est 'siren'
            }, {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

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
                console.log('Données entreprise reçues:', companyDetails.value);
            }
        } catch (error) {
            console.error('Erreur détaillée:', error);
            isValidSiren.value = false;
            companyDetails.value = null;

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
    localFormData.value = {
        ...localFormData.value,
        companyName: companyDetails.value.denomination,
        siren: companyDetails.value.siren,
        siret: companyDetails.value.siret
    };
};

const resetSirenSelection = () => {
    selectedCompany.value = false;
    isValidSiren.value = false;
    companyDetails.value = null;
    sirenError.value = '';
};

// Fonction pour formater la date
const formatDate = (dateString) => {
    if (!dateString) return ''
    return new Date(dateString).toLocaleDateString('fr-FR')
}

const validateForm = () => {
    showErrors.value = true

    if (!isFormValid.value) {
        return false
    }

    emit('update:formData', { personal: localFormData.value })
    emit('stepValidated', true)
    return true
}

const validateField = (fieldName) => {
    touchedFields.value[fieldName] = true

    switch (fieldName) {
        case 'lastName':
        case 'firstName':
            isFieldValid.value[fieldName] = localFormData.value[fieldName].length >= 2
            formErrors.value[fieldName] = isFieldValid.value[fieldName] ? '' : 'Ce champ est requis (minimum 2 caractères)'
            break
        case 'email':
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
            isFieldValid.value[fieldName] = emailRegex.test(localFormData.value[fieldName])
            formErrors.value[fieldName] = isFieldValid.value[fieldName] ? '' : 'Veuillez saisir une adresse email valide'
            break
        case 'phone':
            const phoneRegex = /^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/
            isFieldValid.value[fieldName] = phoneRegex.test(localFormData.value[fieldName])
            formErrors.value[fieldName] = isFieldValid.value[fieldName] ? '' : 'Veuillez saisir un numéro de téléphone valide'
            break
        case 'activity':
            isFieldValid.value[fieldName] = localFormData.value[fieldName].length >= 3
            formErrors.value[fieldName] = isFieldValid.value[fieldName] ? '' : 'Veuillez indiquer votre activité'
            break
    }
}
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
