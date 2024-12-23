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
                    class="relative flex flex-col rounded-2xl border-2 p-8 xl:p-10 bg-white dark:bg-[#1E293B]" :class="[
                        forfait.popular ? 'border-blue-500' : 'border-gray-200 dark:border-gray-700',
                        localFormData.selectedForfait === forfait.id ? 'ring-2 ring-blue-500' : ''
                    ]">

                    <!-- Badge -->
                    <div :class="[
                        'absolute top-0 right-8 px-4 py-1 rounded-b-lg text-sm font-medium text-white',
                        forfait.popular ? 'bg-blue-500' : 'bg-indigo-700'
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
                        <button @click.stop="selectForfait(forfait)" :class="[
                            'mt-8 w-full rounded-lg px-4 py-3 text-sm font-semibold transition-colors',
                            localFormData.selectedForfait === forfait.id
                                ? 'bg-blue-600 text-white hover:bg-blue-700'
                                : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600'
                        ]">
                            {{ localFormData.selectedForfait === forfait.id ? 'Sélectionné' : 'Sélectionner' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Nouvelle section Options -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 sm:p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 sm:mb-6">
                    Options additionnelles
                </h2>

                <div class="space-y-4 sm:space-y-6">
                    <!-- Services additionnels -->
                    <div class="grid grid-cols-1 gap-4 sm:gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        <div v-for="option in additionalOptions" :key="option.id" :class="[
                            'relative rounded-lg border-2 p-3 sm:p-4 cursor-pointer transition-all',
                            isSelected(option.id)
                                ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20'
                                : 'border-gray-200 dark:border-gray-700 hover:border-blue-300'
                        ]" @click="toggleOption(option)">

                            <div class="flex flex-col items-center">
                                <div class="flex-shrink-0 mb-4">
                                    <i :class="[
                                        'bx text-2xl sm:text-3xl',
                                        option.icon,
                                        isSelected(option.id) ? 'text-blue-500' : 'text-gray-400'
                                    ]"></i>
                                </div>
                                <div class="text-center w-full">
                                    <h3 class="text-base sm:text-lg font-medium text-gray-900 dark:text-white">
                                        {{ option.name }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        {{ option.description }}
                                    </p>
                                    <p class="mt-2 text-blue-600 dark:text-blue-400 font-medium">
                                        {{ option.price }}€
                                    </p>
                                </div>

                                <!-- Bouton de sélection -->
                                <button @click.stop="toggleOption(option)" :class="[
                                    'mt-4 w-full rounded-lg px-4 py-3 text-sm font-semibold transition-colors',
                                    isSelected(option.id)
                                        ? 'bg-blue-600 text-white hover:bg-blue-700'
                                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600'
                                ]">
                                    {{ isSelected(option.id) ? 'Sélectionné' : 'Sélectionner' }}
                                </button>

                                <!-- Indicateur de sélection -->
                                <div v-if="isSelected(option.id)"
                                    class="absolute -top-2 -right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
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
                            <div v-for="plan in maintenancePlans" :key="plan.id" :class="[
                                'relative rounded-lg border-2 p-4 cursor-pointer transition-all',
                                localFormData.maintenancePlan === plan.id
                                    ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20'
                                    : 'border-gray-200 dark:border-gray-700 hover:border-blue-300'
                            ]">

                                <h4 class="text-base sm:text-lg font-medium text-gray-900 dark:text-white">
                                    {{ plan.name }}
                                </h4>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    {{ plan.description }}
                                </p>
                                <p class="mt-3 sm:mt-4 text-blue-600 dark:text-blue-400 font-medium">
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
                                <button @click.stop="selectMaintenancePlan(plan)" :class="[
                                    'mt-6 w-full rounded-lg px-4 py-3 text-sm font-semibold transition-colors',
                                    localFormData.maintenancePlan === plan.id
                                        ? 'bg-blue-600 text-white hover:bg-blue-700'
                                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600'
                                ]">
                                    {{ localFormData.maintenancePlan === plan.id ? 'Sélectionné' : 'Sélectionner' }}
                                </button>

                                <!-- Indicateur de sélection -->
                                <div v-if="localFormData.maintenancePlan === plan.id"
                                    class="absolute -top-2 -right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                    <i class='bx bx-check text-white'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    formData: {
        type: Object,
        required: true
    }
})

const emit = defineEmits(['update:formData'])

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


const localFormData = ref({
    selectedForfait: null,
    forfaitDetails: null,
    maintenancePlan: null,
    selectedOptions: [],
    ...props.formData.template
})

const selectForfait = (forfait) => {
    localFormData.value.selectedForfait = forfait.id
    localFormData.value.forfaitDetails = forfait
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
    localFormData.value.maintenancePlan = plan.id
}

const isSelected = (optionId) => {
    return localFormData.value.selectedOptions.includes(optionId)
}

watch(localFormData, (newValue) => {
    emit('update:formData', { template: newValue })
    emit('update:formData', { options: newValue })
}, { deep: true })

</script>
