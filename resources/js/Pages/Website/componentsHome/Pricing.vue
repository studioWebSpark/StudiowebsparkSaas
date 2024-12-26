<template>
    <section class="py-12 bg-white sm:py-16 lg:py-20 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-xl px-8 mx-auto text-center md:px-0">
                <span
                    class="text-base font-semibold tracking-wide text-indigo-600 uppercase dark:text-indigo-400">Tarifs</span>
                <h2 class="mt-4 text-3xl font-bold text-gray-900 sm:text-4xl xl:text-5xl font-pj dark:text-white">
                    Des Solutions Web Adaptées à Vos Besoins
                </h2>
                <p class="mt-4 text-lg font-normal text-gray-600 font-pj dark:text-gray-400">
                    Choisissez le forfait qui correspond le mieux à votre projet
                </p>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    * TVA non applicable, art. 293 B du CGI
                </p>
            </div>

            <div
                class="grid max-w-sm grid-cols-1 gap-6 mx-auto mt-8 md:text-left md:mt-16 lg:max-w-none lg:grid-cols-3 lg:gap-8 ">
                <div v-for="forfait in forfaits" :key="forfait.id"
                    class="relative flex flex-col h-full overflow-hidden bg-white border rounded-2xl dark:bg-gray-800"
                    :class="[
                        forfait.popular
                            ? 'border-2 border-indigo-600 dark:border-indigo-400 transform hover:scale-105 hover:shadow-2xl z-10'
                            : 'border-gray-200 dark:border-gray-700'
                    ]">
                    <!-- Badge Populaire -->
                    <div v-if="forfait.popular" class="absolute top-0 right-0 w-24 h-24">
                        <div
                            class="absolute transform rotate-45 bg-indigo-600 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px] dark:bg-indigo-400">
                            Populaire
                        </div>
                    </div>

                    <div class="flex-1 p-6 lg:px-10 lg:py-8">
                        <!-- En-tête du forfait -->
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900 font-pj dark:text-white">{{ forfait.name }}</h3>
                            <span v-if="!forfait.popular"
                                class="inline-flex px-4 py-1 text-sm font-semibold text-indigo-600 bg-indigo-100 rounded-full dark:bg-indigo-900 dark:text-indigo-300">
                                {{ forfait.badge }}
                            </span>
                        </div>

                        <!-- Prix -->
                        <div class="mt-6">
                            <div class="flex items-baseline">
                                <span class="text-5xl font-bold text-gray-900 font-pj dark:text-white">{{ forfait.price
                                    }}€</span>
                                <span class="ml-1 text-base text-gray-600 dark:text-gray-400">HT</span>
                            </div>
                            <p class="mt-4 text-base text-gray-600 dark:text-gray-400 min-h-[80px]">
                                {{ forfait.description }}
                            </p>
                        </div>

                        <!-- Fonctionnalités -->
                        <div class="mt-8">
                            <p class="text-base font-bold text-gray-900 font-pj dark:text-white">Ce qui est inclus :</p>
                            <ul class="mt-4 space-y-4">
                                <li v-for="feature in forfait.features" :key="feature" class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">{{ feature }}</span>
                                </li>
                            </ul>

                            <!-- Bouton voir plus -->
                            <div class="mt-4">
                                <button @click="forfait.id === 'premium' ? togglePremiumFeatures() : toggleFeatures()"
                                    class="flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                                    <span class="text-sm">Voir plus d'avantages</span>
                                    <i class='bx text-xl ml-2'
                                        :class="(forfait.id === 'premium' ? showPremiumFeatures : showFeatures) ? 'bx-chevron-up' : 'bx-chevron-down'">
                                    </i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton d'action -->
                    <div class="p-6 bg-gray-50 dark:bg-gray-700/50 lg:px-10 lg:py-8">
                        <a href="/demarrer-projet"
                            class="inline-flex items-center justify-center w-full px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-indigo-600 rounded-xl font-pj hover:bg-indigo-700 dark:bg-indigo-600 dark:hover:bg-indigo-700">
                            Commencer votre projet
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


</template>

<script setup>
import Footer from './Footer.vue';
import { ref } from 'vue';

const showFeatures = ref(false);
const showPremiumFeatures = ref(false);

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
            'Formulaire de contact personnalisé multi-pages',
            'Logo et identité visuelle inclus',
            'Maintenance Essentielle (1 an) incluse'
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
            'Maintenance Professionnelle (1 an) incluse',
            'Audit marketing initial offert',
            'Logo et identité visuelle inclus',
            'CRM Dashboard inclus',
            'E-commerce inclus',
            'Système de formulaires avancé'
        ]
    }
];

const toggleFeatures = () => {
    showFeatures.value = !showFeatures.value;
};

const togglePremiumFeatures = () => {
    showPremiumFeatures.value = !showPremiumFeatures.value;
};
</script>
