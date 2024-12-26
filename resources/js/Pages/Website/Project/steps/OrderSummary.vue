<template>
    <div class="max-w-4xl mx-auto">
        <!-- Informations Personnelles -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                Informations Personnelles
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Type de client</p>
                    <p class="font-medium text-gray-900 dark:text-white">
                        {{ informations.clientType === 'individual' ? 'Particulier' : 'Professionnel' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Nom complet</p>
                    <p class="font-medium text-gray-900 dark:text-white">
                        {{ informations.firstName }} {{ informations.lastName }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Email</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ informations.email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Téléphone</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ informations.phone }}</p>
                </div>
                <div v-if="informations.clientType === 'professional'">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Entreprise</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ informations.companyName }}</p>
                </div>
                <div v-if="informations.clientType === 'professional'">
                    <p class="text-sm text-gray-600 dark:text-gray-400">SIREN</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ informations.siren }}</p>
                </div>
            </div>
        </div>

        <!-- Détails du Projet -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6" v-if="project">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                Détails du Projet
            </h2>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Type de projet</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ project.projectType }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Description</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ project.description }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Fonctionnalités sélectionnées</p>
                    <ul class="mt-2 space-y-1">
                        <li v-for="feature in project.selectedFeatures" :key="feature"
                            class="flex items-center text-gray-900 dark:text-white">
                            <i class='bx bx-check text-green-500 mr-2'></i>
                            {{ feature }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Forfait et Options -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6" v-if="forfait">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                Options et fonctionnalités
            </h2>

            <div class="space-y-6">
                <!-- Forfait sélectionné -->
                <div v-if="forfait.forfaitDetails">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Forfait sélectionné</p>
                    <div class="flex items-center justify-between mt-1">
                        <p class="font-medium text-gray-900 dark:text-white">
                            {{ forfait.forfaitDetails.name }}
                        </p>
                        <p class="font-semibold text-green-600 dark:text-green-400">
                            {{ formatPrice(forfait.forfaitDetails.price) }}€
                        </p>
                    </div>
                </div>

                <!-- Fonctionnalités incluses dans le forfait -->
                <div v-if="includedFeaturesOnly.length">
                    <p class="text-sm font-medium text-gray-900 dark:text-white mb-3">
                        Fonctionnalités incluses dans votre forfait
                    </p>
                    <ul class="space-y-2">
                        <li v-for="option in includedFeaturesOnly" :key="option.id"
                            class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <i :class="['bx', option.icon, 'text-green-500 text-xl mr-3']"></i>
                                <div>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ option.name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ option.description }}</p>
                                </div>
                            </div>
                            <span class="text-green-600 font-medium">Inclus</span>
                        </li>
                    </ul>
                </div>

                <!-- Options payantes sélectionnées -->
                <div v-if="paidOptionsOnly.length">
                    <p class="text-sm font-medium text-gray-900 dark:text-white mb-3">
                        Options supplémentaires sélectionnées
                    </p>
                    <ul class="space-y-2">
                        <li v-for="option in paidOptionsOnly" :key="option.id"
                            class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <i :class="['bx', option.icon, 'text-green-500 text-xl mr-3']"></i>
                                <div>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ option.name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ option.description }}</p>
                                </div>
                            </div>
                            <span class="font-medium text-green-600">{{ formatPrice(option.price) }}€</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Template -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6" v-if="template.selectedTemplate">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                Template Sélectionné
            </h2>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Template</p>
                <p class="font-medium text-gray-900 dark:text-white">
                    {{ template.selectedTemplate.name }}
                </p>
            </div>
        </div>

        <!-- Total -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6" v-if="forfait">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                Récapitulatif des coûts
            </h2>
            <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Forfait</span>
                    <span class="font-medium text-gray-900 dark:text-white">
                        {{ formatPrice(forfait.forfaitDetails?.price) }}€
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Options supplémentaires</span>
                    <span class="font-medium text-gray-900 dark:text-white">
                        {{ formatPrice(calculateOptionsTotal) }}€
                    </span>
                </div>
                <div class="h-px bg-gray-200 dark:bg-gray-700 my-4"></div>
                <div class="flex justify-between">
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Total</span>
                    <span class="text-lg font-bold text-green-600 dark:text-green-400">
                        {{ formatPrice(calculateTotal) }}€
                    </span>
                </div>
                <div class="mt-2 text-sm text-gray-500">
                    <p>* Maintenance : 3 premiers mois offerts</p>
                    <p>Puis {{ forfait.maintenancePlan === 'pro' ? '99' : '49' }}€/an</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    formData: {
        type: Object,
        required: true
    }
});

// Accès sécurisé aux données avec valeurs par défaut
const informations = computed(() => props.formData?.personal || {});
const project = computed(() => props.formData?.project || {});
const forfait = computed(() => props.formData?.forfait || {});
const template = computed(() => props.formData?.template || {});

const formatPrice = (price) => {
    return Number(price).toLocaleString('fr-FR');
};

// Calculer le total des options de manière sécurisée
const calculateOptionsTotal = computed(() => {
    try {
        const selectedOptions = forfait.value?.selectedOptions || [];
        return selectedOptions.reduce((total, option) => {
            if (typeof option === 'object' && option !== null) {
                const price = Number(option.price);
                return total + (isNaN(price) ? 0 : price);
            } else if (typeof option === 'string') {
                // Si l'option est une chaîne, chercher le prix dans la liste des options disponibles
                const optionPrice = getOptionPrice(option);
                return total + optionPrice;
            }
            return total;
        }, 0);
    } catch (error) {
        console.error('Erreur calcul options:', error);
        return 0;
    }
});


// Calculer le total général de manière sécurisée
const calculateTotal = computed(() => {
    try {
        const forfaitPrice = Number(forfait.value?.forfaitDetails?.price) || 0;
        return forfaitPrice + calculateOptionsTotal.value;
    } catch (error) {
        console.error('Erreur calcul total:', error);
        return 0;
    }
});

const includedFeaturesOnly = computed(() => {
    return forfait.value.selectedOptions?.filter(option =>
        option.id === 'socialMedia' || option.id === 'logoPhotos'
    ) || [];
});

const paidOptionsOnly = computed(() => {
    return forfait.value.selectedOptions?.filter(option =>
        option.id === 'Dashboard' || option.id === 'ecommerce'
    ) || [];
});
</script>
