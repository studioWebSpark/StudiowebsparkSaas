<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12 sm:py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8">
                <!-- Icône d'avertissement -->
                <div class="flex justify-center mb-6">
                    <div class="rounded-full bg-yellow-100 p-3">
                        <i class='bx bx-info-circle text-3xl text-yellow-600'></i>
                    </div>
                </div>

                <!-- Titre -->
                <h1 class="text-center text-2xl font-bold text-gray-900 dark:text-white mb-4">
                    Projet existant détecté
                </h1>

                <!-- Message -->
                <div class="text-center space-y-4">
                    <p class="text-gray-600 dark:text-gray-300">
                        Vous avez déjà un projet en cours avec votre compte actuel.
                    </p>
                    <p class="text-gray-600 dark:text-gray-300">
                        Pour démarrer un nouveau projet, veuillez créer un nouveau compte avec une adresse email
                        différente.
                    </p>
                </div>

                <!-- Boutons d'action -->
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                    
                    

                    <Link href="/"
                        class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Retour à l'accueil
                    </Link>
                </div>

                <!-- Note supplémentaire -->

            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>