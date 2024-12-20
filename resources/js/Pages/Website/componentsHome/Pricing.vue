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
                <!-- Forfait Starter -->
                <div
                    class="relative flex flex-col h-full overflow-hidden bg-white border border-gray-200 rounded-2xl dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex-1 p-6 lg:px-10 lg:py-8">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900 font-pj dark:text-white">Starter</h3>
                            <span
                                class="inline-flex px-4 py-1 text-sm font-semibold text-indigo-600 bg-indigo-100 rounded-full dark:bg-indigo-900 dark:text-indigo-300">
                                Essentiel
                            </span>
                        </div>
                        <div class="mt-6">
                            <div class="flex items-baseline">
                                <span class="text-5xl font-bold text-gray-900 font-pj dark:text-white">349€</span>
                                <span class="ml-1 text-base text-gray-600 dark:text-gray-400">HT</span>
                            </div>
                            <p class="mt-4 text-base text-gray-600 dark:text-gray-400 min-h-[80px]">
                                Idéal pour les petites entreprises qui souhaitent établir leur présence en ligne.
                            </p>
                        </div>

                        <div class="mt-8">
                            <p class="text-base font-bold text-gray-900 font-pj dark:text-white">Ce qui est inclus :</p>
                            <ul class="mt-4 space-y-4">
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Site vitrine 3 pages
                                        (Accueil, À propos, Contact)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Design responsive
                                        moderne</span>
                                </li>

                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Optimisation SEO de
                                        base</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Support 15 jours</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Délai de livraison : 1-2
                                        jours</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Hébergement
                                        (optionnel)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 dark:bg-gray-700/50 lg:px-10 lg:py-8">
                        <a href="/contact"
                            class="inline-flex items-center justify-center w-full px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-indigo-600 rounded-xl font-pj hover:bg-indigo-700 dark:bg-indigo-600 dark:hover:bg-indigo-700">
                            Commencer votre projet
                        </a>
                    </div>
                </div>

                <!-- Forfait Standard -->
                <div
                    class="relative flex flex-col h-full overflow-hidden bg-white border-2 border-indigo-600 rounded-2xl dark:bg-gray-900 dark:border-indigo-400 transform transition-all duration-300 hover:scale-105 hover:shadow-2xl z-10">
                    <!-- Badge Populaire -->
                    <div class="absolute top-0 right-0 w-24 h-24">
                        <div
                            class="absolute transform rotate-45 bg-indigo-600 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px] dark:bg-indigo-400">
                            Populaire
                        </div>
                    </div>

                    <div class="flex-1 p-6 lg:px-10 lg:py-8">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900 font-pj dark:text-white">Standard</h3>

                        </div>

                        <div class="mt-6">
                            <div class="flex items-baseline">
                                <span class="text-5xl font-bold text-gray-900 font-pj dark:text-white">699€</span>
                                <span class="ml-1 text-base text-gray-600 dark:text-gray-400">HT</span>
                            </div>
                            <p class="mt-4 text-base text-gray-600 dark:text-gray-400 min-h-[80px]">
                                Solution complète pour une présence web professionnelle et impactante.
                            </p>
                        </div>

                        <div class="mt-8">
                            <p class="text-base font-bold text-gray-900 font-pj dark:text-white">Ce qui est inclus :</p>
                            <ul class="mt-4 space-y-4">
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">
                                        Application web 5-7 pages
                                        personnalisées</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Design premium responsive
                                        avec animations</span>
                                </li>

                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">SEO avancé + Suivi de
                                        base</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Support 30 jours</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Délai de livraison : 3-4
                                        jours</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Hébergement
                                        (optionnel)</span>
                                </li>

                                <!-- Services additionnels (accordéon) -->
                                <ul v-show="showFeatures" class="mt-4 space-y-4">
                                    <li class="flex items-start">
                                        <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                        <span class="text-base text-gray-600 dark:text-gray-400">Intégration réseaux
                                            sociaux </span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                        <span class="text-base text-gray-600 dark:text-gray-400">Statistiques Réseaux
                                            sociaux +
                                            Rapport mensuel</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                        <span class="text-base text-gray-600 dark:text-gray-400">Formulaire de contact
                                            personnalisé multi-pages</span>
                                    </li>

                                </ul>
                            </ul>

                            <div class="mt-4">
                                <button @click="toggleFeatures"
                                    class="flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                                    <span class="text-sm">Voir plus d'avantages</span>
                                    <i class='bx text-xl ml-2'
                                        :class="showFeatures ? 'bx-chevron-up' : 'bx-chevron-down'">
                                    </i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 dark:bg-gray-800/50 lg:px-10 lg:py-8">
                        <a href="/contact"
                            class="inline-flex items-center justify-center w-full px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-indigo-600 rounded-xl font-pj hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                            Commencer votre projet
                        </a>
                    </div>
                </div>

                <!-- Forfait Premium -->
                <div
                    class="relative flex flex-col h-full overflow-hidden bg-white border border-gray-200 rounded-2xl dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex-1 p-6 lg:px-10 lg:py-8">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900 font-pj dark:text-white">Premium</h3>
                            <span
                                class="inline-flex px-4 py-1 text-sm font-semibold text-indigo-600 bg-indigo-100 rounded-full dark:bg-indigo-900 dark:text-indigo-300">
                                Sur-mesure
                            </span>
                        </div>
                        <div class="mt-6">
                            <p class="flex items-baseline">
                                <span class="text-5xl font-bold text-gray-900 font-pj dark:text-white">1399€</span>
                                <span class="ml-1 text-base text-gray-600 dark:text-gray-400">HT</span>
                            </p>
                            <p class="mt-4 text-base text-gray-600 dark:text-gray-400 min-h-[80px]">
                                Solution premium tout inclus avec accompagnement personnalisé pour une présence web
                                exceptionnelle et des résultats garantis.
                            </p>
                        </div>

                        <div class="mt-8">
                            <p class="text-base font-bold text-gray-900 font-pj dark:text-white">Ce qui est inclus :</p>
                            <ul class="mt-4 space-y-4">
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Application web 10-12 pages
                                        personnalisées avec E-commerce inclus</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Design exclusif sur-mesure
                                        avec animations premium</span>
                                </li>

                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">SEO Expert + Suivi mensuel
                                        personnalisé</span>
                                </li>

                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Support prioritaire
                                        illimité 60 jours</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Délai de livraison : 5-7
                                        jours</span>
                                </li>
                                <li class="flex items-start">
                                    <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                    <span class="text-base text-gray-600 dark:text-gray-400">Hébergement premium 1
                                        an offert</span>
                                </li>

                                <!-- Services additionnels Premium (accordéon) -->
                                <ul v-show="showPremiumFeatures" class="mt-4 space-y-4">
                                    <li class="flex items-start">
                                        <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                        <span class="text-base text-gray-600 dark:text-gray-400">Stratégie de contenu
                                            personnalisée</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                        <span class="text-base text-gray-600 dark:text-gray-400">Blog professionnel +
                                            Newsletter automatisée</span>
                                    </li>


                                    <li class="flex items-start">
                                        <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                        <span class="text-base text-gray-600 dark:text-gray-400">Maintenance mensuelle 3
                                            mois offerte</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                        <span class="text-base text-gray-600 dark:text-gray-400">Audit marketing initial
                                            offert</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                        <span class="text-base text-gray-600 dark:text-gray-400">Stratégie de contenu
                                            personnalisée</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class='bx bx-check text-xl text-green-500 mr-2'></i>
                                        <span class="text-base text-gray-600 dark:text-gray-400">Système de formulaires
                                            avancé </span>
                                    </li>
                                </ul>
                            </ul>

                            <div class="mt-4">
                                <button @click="togglePremiumFeatures"
                                    class="flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                                    <span class="text-sm">Voir plus d'avantages</span>
                                    <i class='bx text-xl ml-2'
                                        :class="showPremiumFeatures ? 'bx-chevron-up' : 'bx-chevron-down'">
                                    </i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 dark:bg-gray-700/50 lg:px-10 lg:py-8">
                        <a href="/contact"
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

const toggleFeatures = () => {
    showFeatures.value = !showFeatures.value;
};

const togglePremiumFeatures = () => {
    showPremiumFeatures.value = !showPremiumFeatures.value;
};
</script>

