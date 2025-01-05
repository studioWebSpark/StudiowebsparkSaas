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
                                Site Web Professionnel en 24h ⚡️
                            </p>
                        </div>

                        <!-- Titre principal avec animation de texte -->
                        <h1 class="mt-8 text-4xl sm:text-5xl lg:text-6xl font-bold">
                            <span class="text-white">
                                Transformez Votre Vision
                            </span>
                            <br>
                            <span class="text-blue-200">
                                en Réalité Digitale
                            </span>
                        </h1>

                        <p class="mt-6 text-lg text-gray-200">
                            Des solutions web sur mesure et abordables pour les entrepreneurs.
                            <br>
                            Un accompagnement personnalisé pour concrétiser vos projets digitaux.
                        </p>

                        <!-- Boutons d'action -->
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-10">
                            <!-- Bouton principal -->
                            <a href="/demarrer-projet"
                                class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 hover:scale-105 hover:shadow-lg dark:shadow-blue-500/25">
                                <span class="relative z-10">Démarrer Mon Projet</span>
                                <div
                                    class="absolute inset-0 bg-white/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity">
                                </div>
                                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>

                            <!-- Bouton secondaire -->
                            <a href="/tarifs"
                                class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-gray-900 dark:text-white transition-all duration-200 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 hover:shadow-md">
                                Voir les Tarifs
                                <i
                                    class='bx bx-right-arrow-alt ml-2 text-xl transition-transform group-hover:translate-x-1'></i>
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
                                <span class="text-sm text-gray-600 dark:text-gray-400">Satisfaction Client</span>
                            </div>
                            <div class="flex flex-col items-center p-4 bg-white rounded-lg dark:bg-gray-800 shadow-sm">
                                <span class="text-2xl font-bold text-purple-600 dark:text-purple-400">7/7</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Support Disponible</span>
                            </div>
                            <div class="flex flex-col items-center p-4 bg-white rounded-lg dark:bg-gray-800 shadow-sm">
                                <span class="text-2xl font-bold text-orange-600 dark:text-orange-400">30j</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Suivi Gratuit</span>
                            </div>
                        </div>
                    </div>

                    <!-- Image principale avec effet de flottement -->
                    <div class="mt-16 md:mt-20">
                        <div class="relative group">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg blur opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200">
                            </div>
                            <img class="relative w-full rounded-lg shadow-2xl dark:opacity-90 transition-transform duration-500 group-hover:scale-[1.01]"
                                src="https://d33wubrfki0l68.cloudfront.net/54780decfb9574945bc873b582cdc6156144a2ba/d9fa1/images/hero/4/illustration.png"
                                alt="Illustration de site web professionnel" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}

</style>
