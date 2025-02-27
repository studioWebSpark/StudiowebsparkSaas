<template>
    <div class="relative -mt-36">
        <div class="min-h-screen bg-dot-pattern bg-fixed bg-[#EEF1FF] dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-36">
                <!-- Effet de fond avec gradient et motif -->
                <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
                    <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
                </div>
                <div class="relative px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                    <div class="max-w-3xl mx-auto text-center">
                        <!-- Badge animé -->
                        <div
                            class="inline-flex items-center px-4 py-2 space-x-2 bg-white dark:bg-gray-800 rounded-full shadow-md animate-float">
                            <span class="flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                            <p
                                class="text-sm font-medium bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                Accompagnement dédié aux auto-entrepreneurs ⚡️
                            </p>
                        </div>

                        <!-- Titre principal avec attributs de performance -->
                        <h1 class="mt-8 text-4xl sm:text-5xl lg:text-6xl font-bold" fetchpriority="high"
                            importance="high" id="main-lcp-element">
                            <span class="text-white">
                                Propulsez Votre Activité
                            </span>
                            <br>
                            <span class="text-blue-200">
                                dans l'Ère Digitale 🚀
                            </span>
                        </h1>

                        <p class="mt-6 text-lg text-gray-200">
                            <span class="font-semibold text-white">Sites web professionnels</span> et <span
                                class="font-semibold text-white">solutions digitales</span> accessibles pour
                            auto-entrepreneurs.
                            <br>
                            <span class="relative inline-block">
                                Développez votre activité avec un <span class="text-yellow-300">accompagnement sur
                                    mesure</span> ✓

                            </span>
                        </p>

                        <!-- Boutons d'action -->
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-10">
                            <!-- Bouton principal -->
                            <a href="/demarrer-projet"
                                class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-gray-900 dark:text-white transition-all duration-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 hover:shadow-md">
                                Démarrer Mon Projet
                                <i
                                    class='bx bx-right-arrow-alt ml-2 text-xl transition-transform group-hover:translate-x-1'></i>
                            </a>

                            <!-- Bouton secondaire -->
                            <a href="/tarifs"
                                class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-gray-900 dark:text-white transition-all duration-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 hover:shadow-md">
                                Voir les Tarifs
                                <i
                                    class='bx bx-right-arrow-alt ml-2 text-xl transition-transform group-hover:translate-x-1'></i>
                            </a>

                            <!-- Nouveau bouton Contact -->
                            <a href="tel:+33767175724"
                                class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-gray-900 dark:text-white transition-all duration-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 hover:shadow-md">
                                Nous Appeler
                                <i class='bx bx-phone ml-2 text-xl'></i>
                            </a>
                        </div>

                        <!-- Badges de confiance -->
                        <div class="grid grid-cols-2 gap-4 mt-12 sm:grid-cols-4">
                            <div class="relative group">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                                </div>
                                <div
                                    class="relative flex flex-col items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">24h</span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Livraison Express</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center p-4 bg-white rounded-lg dark:bg-gray-800 shadow-sm">
                                <span class="text-2xl font-bold text-green-600 dark:text-green-400">100%</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Engagement Qualité</span>
                            </div>
                            <div class="flex flex-col items-center p-4 bg-white rounded-lg dark:bg-gray-800 shadow-sm">
                                <span class="text-2xl font-bold text-purple-600 dark:text-purple-400">5/7 jours</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Support Disponible</span>
                            </div>
                            <div class="flex flex-col items-center p-4 bg-white rounded-lg dark:bg-gray-800 shadow-sm">
                                <span class="text-2xl font-bold text-orange-600 dark:text-orange-400">15j</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Suivi Gratuit</span>
                            </div>
                        </div>

                        <!-- Section de différenciation -->
                        <div class="mt-12 bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-blue-200/20">
                            <h2 class="text-xl font-bold text-white mb-4">Pourquoi nous choisir ?</h2>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mr-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center">
                                            <i class='bx bx-code-alt text-xl text-blue-300' aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-white">Développeur Passionné</h3>
                                        <p class="text-blue-100 text-sm mt-1">Un interlocuteur unique qui comprend vos
                                            besoins techniques et business.</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mr-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center">
                                            <i class='bx bx-line-chart text-xl text-green-300' aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-white">Approche ROI</h3>
                                        <p class="text-blue-100 text-sm mt-1">Sites conçus pour convertir vos visiteurs
                                            en clients et générer des revenus.</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mr-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center">
                                            <i class='bx bx-rocket text-xl text-purple-300' aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-white">Rapidité d'exécution</h3>
                                        <p class="text-blue-100 text-sm mt-1">Des délais courts sans compromis sur la
                                            qualité pour lancer votre activité rapidement.</p>
                                    </div>
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

</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
