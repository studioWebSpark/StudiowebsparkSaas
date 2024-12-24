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

            <!-- Contenu des étapes avec padding adaptatif -->
            <div class="w-full">
                <div class="max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8">
                    <transition name="fade" mode="out-in">
                        <div class="py-6 lg:py-8">
                            <PersonalInfo v-if="currentStep === 0" :form-data="formData"
                                @update:form-data="updateFormData" />

                            <ProjectDetails v-if="currentStep === 1" :form-data="formData"
                                @update:form-data="updateFormData" />

                            <TemplateSelection v-if="currentStep === 2" :form-data="formData"
                                @update:form-data="updateFormData" />

                            <AdditionalOptions v-if="currentStep === 3" :form-data="formData"
                                @update:form-data="updateFormData" />

                            <OrderSummary v-if="currentStep === 4" :form-data="formData" @submit="submitForm" />
                        </div>
                    </transition>
                </div>

                <!-- Navigation responsive -->
                <div class="max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
                    <div class="flex flex-col sm:flex-row justify-between gap-4">
                        <button v-if="currentStep > 0" @click="previousStep"
                            class="w-full sm:w-auto px-6 py-3 text-base lg:text-lg font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <i class='bx bx-left-arrow-alt mr-2'></i>
                            Précédent
                        </button>
                        <button v-if="currentStep < steps.length - 1" @click="nextStep"
                            class="w-full sm:w-auto px-6 py-3 text-base lg:text-lg font-medium text-white bg-blue-600 border border-transparent rounded-xl shadow-sm hover:bg-blue-700 transition-colors">
                            Suivant
                            <i class='bx bx-right-arrow-alt ml-2'></i>
                        </button>
                        <button v-else @click="submitForm"
                            class="w-full sm:w-auto px-6 py-3 text-base lg:text-lg font-medium text-white bg-green-600 border border-transparent rounded-xl shadow-sm hover:bg-green-700 transition-colors">
                            Finaliser la commande
                            <i class='bx bx-check ml-2'></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import { ref, onMounted, onUnmounted } from 'vue';
import PersonalInfo from './steps/Personalinfo.vue'
import ProjectDetails from './steps/ProjectDetails.vue'
import TemplateSelection from './steps/TemplateSelection.vue'
import AdditionalOptions from './steps/AdditionalOptions.vue'
import OrderSummary from './steps/OrderSummary.vue'
import Header from '../componentsHome/Header.vue'

const steps = [
    { title: 'Informations' },
    { title: 'Projet' },
    { title: 'Template' },
    { title: 'Options' },
    { title: 'Validation' }
]

const currentStep = ref(0)
const formData = ref({
    personal: {},
    project: {},
    template: null,
    options: [],
    total: 0
})

const updateFormData = (newData) => {
    formData.value = { ...formData.value, ...newData }
}

const nextStep = () => {
    if (currentStep.value < steps.length - 1) {
        currentStep.value++
    }
}

const previousStep = () => {
    if (currentStep.value > 0) {
        currentStep.value--
    }
}

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