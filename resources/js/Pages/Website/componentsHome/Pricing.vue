<template>
    <section class="py-12 -mt-36 bg-gray-50 dark:bg-gray-900 sm:py-16 lg:py-20 relative overflow-hidden">
        <!-- Effet de fond -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 pt-36">
            <!-- En-tête -->
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj">
                    Des Tarifs
                    <span class="relative">
                        <span class="relative z-10 text-white">Simples et Transparents</span>
                        <div class="absolute bottom-0 left-0 w-full h-3 bg-blue-200/50 -z-10 transform -rotate-1"></div>
                    </span>
                </h2>
                    <p class="mt-4 text-sm text-white/80 text-center">
                        Offre limitée dans le temps - Profitez de nos tarifs de lancement !
                    </p>
                <p class="mt-4 text-lg text-white/90">
                    Choisissez le plan qui correspond le mieux à vos besoins
                </p>
                <p class="mt-2 text-sm text-white/80">
                    * TVA non applicable, art. 293 B du CGI
                </p>
            </div>

            <!-- Grille des prix -->
            <div class="grid max-w-md grid-cols-1 gap-6 mx-auto mt-8 lg:grid-cols-3 lg:max-w-none lg:gap-8">
                <div v-for="(plan, index) in plans" :key="index" class="relative group">
                    <!-- Badge avec z-index augmenté -->
                    <div class="absolute -top-3 right-4 z-10">
                        <span
                            class="px-3 py-1 text-xs font-medium text-white rounded-full bg-black dark:bg-white dark:text-black shadow-sm">
                            {{ plan.badge }}
                        </span>
                    </div>

                    <!-- Carte -->
                    <div
                        class="relative flex flex-col h-full p-8 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-xl">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ plan.name }}</h3>
                            <div class="mt-4 flex items-baseline justify-center">
                                <span class="text-5xl font-bold text-gray-900 dark:text-white">{{ plan.price }}€</span>
                                <span class="ml-1 text-sm text-gray-500">HT*</span>
                            </div>
                            <p class="mt-4 text-gray-600 dark:text-gray-400">{{ plan.description }}</p>
                        </div>

                        <ul class="mt-8 space-y-4 flex-grow">
                            <li v-for="(feature, featureIndex) in plan.features" :key="featureIndex"
                                class="flex items-start">
                                <i class='bx bx-check text-blue-600 text-xl mr-2'></i>
                                <span class="text-gray-600 dark:text-gray-300">{{ feature }}</span>
                            </li>
                        </ul>

                        <Link href="/demarrer-projet"
                            class="mt-8 w-full px-4 py-3 text-base font-semibold rounded-xl transition-all duration-200 text-center inline-block"
                            :class="[
                                plan.popular
                                    ? 'text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:shadow-lg hover:scale-[1.02]'
                                    : 'text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600'
                            ]">
                        Commencer maintenant
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Garanties -->
            <div class="grid grid-cols-1 gap-6 mx-auto mt-12 sm:grid-cols-2 lg:grid-cols-4 max-w-7xl">
                <div v-for="(guarantee, index) in guarantees" :key="index"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                    <i :class="guarantee.icon" class="text-2xl text-blue-600 dark:text-blue-400"></i>
                    <div class="ml-4">
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white">{{ guarantee.title }}</h4>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ guarantee.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const selectedPeriod = ref('Mensuel');
const plans = [
    {
        name: 'Starter',
        description: 'Site vitrine professionnel pour démarrer votre présence en ligne.',
        price: 499,
        badge: 'Essentiel',
        features: [
            '✨ Site vitrine 3 pages',
            '📱 Design responsive moderne',
            '📝 Formulaire de contact simple',
            '🔍 Optimisation SEO de base',
            '⚡️ Délai : 1 jour ouvré',
            '🛟 Support technique 30 jours',
            '🔒 Certificat SSL inclus'
        ],
        options: [
            '🎨 Logo & Photos pro (+199€)',
            '🌐 Réseaux sociaux (+349€)',
            '📊 CRM intégré (+599€)'
        ]
    },
    {
        name: 'Starter +',
        description: 'Site vitrine professionnel avec identité visuelle complète.',
        price: 649,
        badge: 'Recommandé',
        popular: true,
        features: [
            '✨ Site vitrine 3-5 pages',
            '📱 Design responsive moderne',
            '📝 Formulaire de contact personnalisé',
            '🔍 Optimisation SEO de base',
            '🎨 Logo personnalisé inclus (199€)',
            '📸 Photos professionnelles incluses',
            '⚡️ Délai : 2 jours ouvrés',
            '🛟 Support technique 30 jours',
            '🔒 Certificat SSL inclus'
        ],
        options: [
            '🌐 Réseaux sociaux (+349€)',
            '📊 CRM intégré (+599€)'
        ]
    },
    {
        name: 'Standard',
        description: 'Solution complète avec réseaux sociaux et marketing digital.',
        price: 1499,
        badge: 'Business',
        features: [
            '✨ Site vitrine 7-9 pages',
            '📱 Design responsive premium',
            '📝 Formulaire de contact avancé',
            '🎨 Logo personnalisé inclus (199€)',
            '📸 Photos professionnelles incluses',
            '🌐 Réseaux sociaux inclus (349€)',
            '🔍 SEO avancé avec rapport mensuel',
            '📊 Formation utilisation (2h)',
            '⚡️ Délai : 4-5 jours ouvrés',
            '🛟 Support technique premium 60 jours',
            '🔒 Certificat SSL inclus',
            '📱 Adaptation mobile premium'
        ],
        options: [
            '📊 CRM intégré (+599€)',
            '💎 Premium sur demande'
        ]
    }
];
const guarantees = [
    {
        icon: 'bx bx-check-shield',
        title: 'Satisfaction garantie',
        description: 'Droit de rétractation 14 jours'
    },
    {
        icon: 'bx bx-time',
        title: 'Livraison rapide',
        description: 'Délai selon forfait choisi'
    },
    {
        icon: 'bx bx-support',
        title: 'Support premium',
        description: 'Support jusqu à 90 jours'
    },
    {
        icon: 'bx bx-lock-alt',
        title: 'Sécurité maximale',
        description: 'Protection SSL incluse'
    }
];
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
