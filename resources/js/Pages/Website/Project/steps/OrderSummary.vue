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

                <!-- Plan de Maintenance -->
                <div v-if="forfait.maintenancePlan" class="mt-6">
                    <p class="text-sm font-medium text-gray-900 dark:text-white mb-3">
                        Plan de maintenance sélectionné
                    </p>
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center">
                            <i class="bx bx-shield-quarter text-green-500 text-xl mr-3"></i>
                            <div>
                                <p class="text-gray-900 dark:text-white font-medium">
                                    {{ forfait.maintenancePlan === 'pro' ? 'Maintenance Pro' : 'Maintenance Basic' }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    3 premiers mois offerts, puis {{ forfait.maintenancePlan === 'pro' ? '99' : '49'
                                    }}€/an
                                </p>
                            </div>
                        </div>
                        <span class="text-green-600 dark:text-green-400 font-medium">
                            Inclus 3 mois
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Template Sélectionné -->
        <div v-if="template?.selectedTemplates?.length > 0"
            class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                Template Sélectionné
            </h2>
            <div class="flex items-start space-x-6">
                <!-- Aperçu du template -->
                <div class="relative group flex-shrink-0 w-1/3">
                    <img :src="selectedTemplateDetails?.thumbnail || selectedTemplateDetails?.image"
                        :alt="selectedTemplateDetails?.name" class="w-full h-auto rounded-lg object-cover">

                    <button @click="openPreview(selectedTemplateDetails)"
                        class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all">
                        <span
                            class="opacity-0 group-hover:opacity-100 px-4 py-2 bg-green-600 text-white rounded-lg transform scale-95 group-hover:scale-100 transition-all">
                            Voir l'aperçu
                        </span>
                    </button>
                </div>

                <!-- Informations du template -->
                <div class="flex-grow">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ selectedTemplateDetails?.name }}
                            <span v-if="selectedTemplateDetails?.isPro"
                                class="ml-2 px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200 rounded-full">
                                PRO
                            </span>
                        </h3>
                        <button @click="removeTemplate" class="text-gray-400 hover:text-red-500 transition-colors">
                            <i class='bx bx-x text-xl'></i>
                        </button>
                    </div>

                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        {{ selectedTemplateDetails?.description }}
                    </p>

                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <i class='bx bx-category-alt mr-2'></i>
                        <span>{{ selectedTemplateDetails?.category }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de prévisualisation -->
        <TransitionRoot appear :show="isPreviewOpen" as="template">
            <Dialog as="div" @close="closePreview" class="relative z-50">
                <TransitionChild enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                    leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-95" />
                </TransitionChild>

                <div class="fixed inset-0">
                    <div class="absolute inset-0 flex items-center justify-center p-0">
                        <TransitionChild enter="ease-out duration-300" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="ease-in duration-200"
                            leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                            <DialogPanel class="w-screen h-screen transform bg-transparent transition-all relative">
                                <!-- Boutons de contrôle -->
                                <div class="absolute top-6 right-6 z-50 flex items-center space-x-4">
                                    <button @click="closePreview"
                                        class="p-2 bg-white rounded-full shadow-lg hover:bg-gray-100 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Container de l'image avec zoom -->
                                <div class="h-screen w-screen flex items-center justify-center p-8">
                                    <div class="relative group w-full h-full">
                                        <img :src="selectedTemplateDetails?.image" :alt="selectedTemplateDetails?.name"
                                            class="w-full h-full object-contain rounded-lg transform transition-transform duration-300"
                                            :class="{ 'scale-150': isZoomed }" @click="toggleZoom">

                                        <!-- Informations du template -->
                                        <div v-show="!isZoomed"
                                            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-8 text-white">
                                            <div class="max-w-4xl mx-auto">
                                                <h3 class="text-2xl font-semibold mb-2">
                                                    {{ selectedTemplateDetails?.name }}
                                                    <span v-if="selectedTemplateDetails?.isPro"
                                                        class="ml-2 px-2 py-1 text-xs font-medium bg-green-600 rounded-full">
                                                        PRO
                                                    </span>
                                                </h3>
                                                <p class="text-lg opacity-90">
                                                    {{ selectedTemplateDetails?.description }}
                                                </p>
                                                <p class="mt-2 text-sm opacity-75">
                                                    Cliquez sur l'image pour zoomer/dézoomer
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Total -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
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
                <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    <p>* Maintenance : 3 premiers mois offerts</p>
                    <p>Puis {{ forfait.maintenancePlan === 'pro' ? '99' : '49' }}€/an</p>
                </div>
            </div>
        </div>

        <!-- Section Authentification -->
        <div v-if="isAllValid" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mt-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                Dernière étape avant le paiement
            </h2>

            <div v-if="!$page.props.auth.user" class="space-y-6">
                <p class="text-gray-600 dark:text-gray-400">
                    Pour finaliser votre commande, vous devez être connecté à votre compte.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <Link :href="route('login', { redirect: currentPath })" @click="sendAuthRequest"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class='bx bx-log-in mr-2'></i>
                    Se connecter
                    </Link>

                    <Link :href="route('register', { redirect: currentPath })" @click="sendAuthRequest"
                        class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class='bx bx-user-plus mr-2'></i>
                    Créer un compte
                    </Link>
                </div>

                <p class="text-sm text-gray-500 dark:text-gray-400 text-center mt-4">
                    La création d'un compte vous permet de suivre vos commandes et de gérer vos projets.
                </p>
            </div>

            <div v-else class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-800 flex items-center justify-center">
                                <i class='bx bx-user text-green-600 dark:text-green-200 text-xl'></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                Connecté en tant que
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $page.props.auth.user.email }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <Link :href="route('logout')" method="post" as="button" @click="storeRedirectUrl"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-gray-600 dark:text-gray-200 dark:border-gray-500 dark:hover:bg-gray-500"
                            preserve-scroll>
                        <i class='bx bx-transfer text-lg mr-2'></i>
                        Changer de compte
                        </Link>

                        <button @click="proceedToPayment"
                            class="inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Procéder au paiement
                            <i class='bx bx-right-arrow-alt ml-2'></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message si tout n'est pas valide -->
        <div v-else class="bg-yellow-50 dark:bg-yellow-900 border-l-4 border-yellow-400 p-4 mt-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class='bx bx-error text-yellow-400 text-xl'></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700 dark:text-yellow-200">
                        Veuillez compléter toutes les étapes précédentes avant de procéder au paiement.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { Dialog, DialogPanel, TransitionRoot, TransitionChild } from '@headlessui/vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import axios from 'axios';
import { loadStripe } from '@stripe/stripe-js';

const props = defineProps({
    formData: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['update:formData', 'stepValidated']);

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
        const selectedForfait = forfait.value?.selectedForfait;

        return selectedOptions.reduce((total, option) => {
            // Vérifier si l'option est incluse dans le forfait actuel
            const isIncluded = includedOptionsByForfait[selectedForfait]?.includes(option.id);

            // Ne pas ajouter le prix si l'option est incluse
            if (isIncluded) {
                return total;
            }

            if (typeof option === 'object' && option !== null) {
                const price = Number(option.price);
                return total + (isNaN(price) ? 0 : price);
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

// Mettre à jour les options incluses par forfait
const includedOptionsByForfait = {
    premium: ['ecommerce', 'logoPhotos', 'socialMedia', 'Dashboard'], // Tous les services inclus
    standard: ['logoPhotos', 'socialMedia'], // Logo + Photos et Réseaux sociaux inclus
    starter: [] // Aucun service inclus
};

// Modifier les computed properties pour la séparation des options
const includedFeaturesOnly = computed(() => {
    const selectedForfait = forfait.value?.selectedForfait;
    const includedOptions = includedOptionsByForfait[selectedForfait] || [];

    return forfait.value.selectedOptions?.filter(option =>
        includedOptions.includes(option.id)
    ) || [];
});

const paidOptionsOnly = computed(() => {
    const selectedForfait = forfait.value?.selectedForfait;
    const includedOptions = includedOptionsByForfait[selectedForfait] || [];

    return forfait.value.selectedOptions?.filter(option =>
        !includedOptions.includes(option.id)
    ) || [];
});

// Définition des templates
const templates = [
    {
        id: 'template1',
        name: 'Business Basic',
        description: 'Template professionnel pour petites entreprises',
        image: 'https://placehold.co/600x400/e2e8f0/475569?text=Template+Business',
        category: 'Business',
        isPro: false
    },
    {
        id: 'template2',
        name: 'E-commerce Pro',
        description: 'Solution complète pour boutique en ligne',
        image: 'https://placehold.co/600x400/e2e8f0/475569?text=Template+E-commerce',
        category: 'E-commerce',
        isPro: true
    },
    {
        id: 'template3',
        name: 'Portfolio Creative',
        description: 'Mise en page moderne pour artistes',
        image: 'https://placehold.co/600x400/e2e8f0/475569?text=Template+Portfolio',
        category: 'Portfolio',
        isPro: false
    },
    {
        id: 'template4',
        name: 'Blog Standard',
        description: 'Design épuré pour les blogueurs',
        image: 'https://placehold.co/600x400/e2e8f0/475569?text=Template+Blog',
        category: 'Blog',
        isPro: false
    },
    {
        id: 'template5',
        name: 'Restaurant Premium',
        description: 'Template spécialisé pour restaurants',
        image: 'https://placehold.co/600x400/e2e8f0/475569?text=Template+Restaurant',
        category: 'Business',
        isPro: true
    }
];

const selectedTemplate = ref(null);

const selectedTemplateDetails = computed(() => {
    const selectedId = props.formData?.template?.selectedTemplates?.[0];
    return templates.find(t => t.id === selectedId);
});

const removeTemplate = () => {
    emit('update:formData', {
        ...props.formData,
        template: {
            ...props.formData.template,
            selectedTemplates: []
        }
    });
};

// Modal controls
const isPreviewOpen = ref(false);
const isZoomed = ref(false);

const openPreview = (template) => {
    selectedTemplateDetails.value = template;
    isPreviewOpen.value = true;
};

const closePreview = () => {
    isPreviewOpen.value = false;
    isZoomed.value = false;
};

const toggleZoom = () => {
    isZoomed.value = !isZoomed.value;
};

const proceedToPayment = async () => {
    try {
        if (!calculateTotal.value || calculateTotal.value <= 0) {
            throw new Error('Le montant du paiement est invalide');
        }

        const paymentData = {
            amount: calculateTotal.value,
            projectData: props.formData,
            customer: {
                email: informations.value.email,
                name: `${informations.value.firstName} ${informations.value.lastName}`
            }
        };

        console.log('Envoi des données de paiement:', paymentData);

        const response = await axios.post(route('stripe.create-session'), paymentData);

        console.log('Réponse complète du serveur:', response);

        // Extraire le JSON de la réponse si nécessaire
        let sessionData;
        try {
            if (typeof response.data === 'string') {
                // Chercher le JSON dans la chaîne de caractères
                const jsonMatch = response.data.match(/\{.*\}/);
                if (jsonMatch) {
                    sessionData = JSON.parse(jsonMatch[0]);
                }
            } else {
                sessionData = response.data;
            }
        } catch (e) {
            console.error('Erreur lors du parsing de la réponse:', e);
            throw new Error('Format de réponse invalide');
        }

        if (!sessionData || !sessionData.sessionId) {
            console.error('Réponse invalide:', response.data);
            throw new Error('Session ID manquant dans la réponse');
        }

        console.log('Session ID extrait:', sessionData.sessionId);

        const stripe = await loadStripe(import.meta.env.VITE_STRIPE_KEY);
        if (!stripe) {
            throw new Error('Erreur lors de l\'initialisation de Stripe');
        }

        const { error } = await stripe.redirectToCheckout({
            sessionId: sessionData.sessionId
        });

        if (error) {
            console.error('Erreur Stripe:', error);
            throw error;
        }

        // La réinitialisation se fera automatiquement après le retour du paiement
        // grâce au script dans la route success

    } catch (error) {
        console.error('Erreur détaillée:', error);
        console.error('Stack trace:', error.stack);
        alert('Une erreur est survenue lors de la préparation du paiement. Veuillez réessayer.');
    }
};

// Vérification des étapes
const isPersonalInfoValid = computed(() => {
    const info = props.formData?.personal;
    if (!info) return false;

    const requiredFields = ['firstName', 'lastName', 'email', 'phone'];
    const professionalFields = ['companyName', 'siren'];

    // Vérifier les champs obligatoires
    const hasRequiredFields = requiredFields.every(field => info[field]?.trim());

    // Vérifier les champs professionnels si nécessaire
    if (info.clientType === 'professional') {
        return hasRequiredFields && professionalFields.every(field => info[field]?.trim());
    }

    return hasRequiredFields;
});

const isProjectValid = computed(() => {
    const project = props.formData?.project;
    return project?.projectType &&
        project?.description?.trim() &&
        project?.selectedFeatures?.length > 0;
});

const isForfaitValid = computed(() => {
    const forfait = props.formData?.forfait;
    return forfait?.forfaitDetails &&
        forfait?.selectedOptions?.length > 0 &&
        forfait?.maintenancePlan;
});

const isTemplateValid = computed(() => {
    return props.formData?.template?.selectedTemplates?.length > 0;
});

// Vérification globale
const isAllValid = computed(() => {
    return isPersonalInfoValid.value &&
        isProjectValid.value &&
        isForfaitValid.value &&
        isTemplateValid.value;
});

const isDropdownOpen = ref(false);

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

const closeDropdown = () => {
    isDropdownOpen.value = false;
};

// Directive pour fermer le dropdown quand on clique en dehors
const vClickOutside = {
    mounted(el, binding) {
        el.clickOutsideEvent = (event) => {
            if (!(el === event.target || el.contains(event.target))) {
                binding.value(event);
            }
        };
        document.addEventListener('click', el.clickOutsideEvent);
    },
    unmounted(el) {
        document.removeEventListener('click', el.clickOutsideEvent);
    },
};

// Récupérer l'URL actuelle de manière sécurisée
const page = usePage();
const currentPath = computed(() => '/demarrer-projet?step=4');

const storeRedirectUrl = () => {
    localStorage.setItem('auth_redirect_url', currentPath.value);
};

const sendAuthRequest = () => {
    // Récupérer les données du projet depuis le localStorage
    const projectData = localStorage.getItem('projectWizardData');

    // Ajouter les données dans le header de la requête
    if (projectData) {
        document.cookie = `X-Project-Data=${encodeURIComponent(projectData)}; path=/`;
    }
};

const resetProjectData = () => {
    try {
        // Réinitialiser le localStorage
        localStorage.removeItem('projectWizardData');

        // Réinitialiser les données du formulaire
        emit('update:formData', {
            personal: {
                clientType: 'individual',
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                companyName: null,
                siren: null,
                isValidated: false
            },
            project: {
                projectType: '',
                description: '',
                selectedFeatures: [],
                isValidated: false
            },
            forfait: {
                forfaitDetails: null,
                selectedOptions: [],
                maintenancePlan: null,
                isValidated: false
            },
            template: {
                selectedTemplates: [],
                isValidated: false
            },
            currentStep: 1
        });

        // Rediriger vers le dashboard après le succès
        router.visit('/dashboard', {
            method: 'get',
            preserveScroll: true,
            onSuccess: () => {
                // Afficher un message de succès si nécessaire
                // Vous pouvez utiliser votre système de notification ici
            }
        });
    } catch (error) {
        console.error('Erreur lors de la réinitialisation:', error);
    }
};
</script>
<style scoped>
.scale-150 {
    transform: scale(1.5);
}

/* Ajout de styles pour une meilleure gestion du zoom */
img {
    transition: transform 0.3s ease;
}

img:hover {
    cursor: zoom-in;
}

img.scale-150:hover {
    cursor: zoom-out;
}

/* Style pour le scrollbar en mode zoom */
.overflow-auto {
    scrollbar-width: thin;
    scrollbar-color: rgba(155, 155, 155, 0.5) transparent;
}

.overflow-auto::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.overflow-auto::-webkit-scrollbar-track {
    background: transparent;
}

.overflow-auto::-webkit-scrollbar-thumb {
    background-color: rgba(155, 155, 155, 0.5);
    border-radius: 3px;
}

/* Optimiser l'affichage de l'image */
.object-contain {
    object-fit: contain;
    max-width: 100%;
    max-height: 100%;
}

/* Améliorer la lisibilité du gradient */
.from-black {
    --tw-gradient-from: rgb(0 0 0 / 0.8);
    --tw-gradient-to: transparent;
}

/* Ajout des styles pour le dropdown */
.relative {
    position: relative;
}

.absolute {
    position: absolute;
}

/* Animation du dropdown */
.dropdown-enter-active,
.dropdown-leave-active {
    transition: all 0.2s ease;
}

.dropdown-enter-from,
.dropdown-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>