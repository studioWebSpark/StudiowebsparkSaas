<template>
    <section class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Options Supplémentaires</h2>
                <p class="mt-4 text-xl text-gray-600 dark:text-gray-300">
                    Personnalisez votre solution avec nos options
                </p>
            </div>

            <!-- Options -->
            <div class="mt-12 grid grid-cols-1 gap-4 sm:gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div v-for="option in TemplateSelection" :key="option.id"
                    class="bg-white dark:bg-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 p-6 transition-all duration-200 hover:border-green-500 hover:bg-green-50">
                    <div class="flex flex-col items-center">
                        <div
                            class="h-12 w-12 bg-green-100 dark:bg-green-800 rounded-lg flex items-center justify-center mb-4">
                            <i :class="['bx text-2xl text-green-600 dark:text-green-300', option.icon]"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-center">{{ option.name }}
                        </h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-300 text-center">{{ option.description }}</p>
                        <p class="mt-4 text-center font-semibold text-green-600 dark:text-green-400">
                            {{ option.price }}€
                        </p>
                    </div>
                </div>
            </div>

            <!-- Plans de maintenance -->
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-8">
                    Plans de maintenance annuelle
                </h3>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:max-w-4xl lg:mx-auto">
                    <div v-for="plan in maintenancePlans" :key="plan.id" @click="selectMaintenancePlan(plan)"
                        class="bg-white dark:bg-gray-800 rounded-xl border-2 p-6 transition-all duration-200 cursor-pointer"
                        :class="[
                            selectedPlan === plan.id
                                ? 'border-green-500 bg-green-50 dark:bg-gray-800/50'
                                : 'border-gray-200 dark:border-gray-700 hover:border-green-500 hover:bg-green-50'
                        ]">
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ plan.name }}</h4>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">{{ plan.description }}</p>
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-6">
                            {{ plan.price }}€<span class="text-base font-normal text-gray-500">/an</span>
                        </div>
                        <ul class="space-y-3">
                            <li v-for="feature in plan.features" :key="feature" class="flex items-start gap-x-3">
                                <i class='bx bx-check text-green-500 text-xl'></i>
                                <span class="text-gray-600 dark:text-gray-300">{{ feature }}</span>
                            </li>
                        </ul>

                        <!-- Bouton de sélection -->
                        <button @click.stop="selectMaintenancePlan(plan)"
                            class="mt-6 w-full rounded-lg px-4 py-3 text-sm font-semibold transition-all duration-200"
                            :class="[
                                selectedPlan === plan.id
                                    ? 'bg-green-600 text-white hover:bg-green-700'
                                    : 'bg-gray-100 text-gray-700 hover:bg-green-100 dark:bg-gray-700 dark:text-gray-200'
                            ]">
                            {{ selectedPlan === plan.id ? 'Sélectionné' : 'Sélectionner' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const TemplateSelection = [
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
        description: 'Maintenance compl��te annuelle',
        price: 159,
        features: [
            'Mises à jour prioritaires',
            'Sauvegardes hebdomadaires',
            'Support prioritaire',
            'Temps de réponse sous 24h',
            'Modifications illimitées'
        ]
    }
];

const selectedPlan = ref(null);

const selectMaintenancePlan = (plan) => {
    selectedPlan.value = selectedPlan.value === plan.id ? null : plan.id;
};
</script>