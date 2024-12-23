<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8 text-center">
                <div class="mb-6">
                    <i class='bx bx-check-circle text-6xl text-green-500'></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    Projet soumis avec succès !
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                    Merci pour votre confiance. Nous avons bien reçu votre projet et nous vous contacterons dans les
                    plus brefs délais.
                </p>
                <div class="space-y-4">
                    <p class="text-gray-600 dark:text-gray-300">
                        Un email de confirmation a été envoyé à : <span class="font-medium">{{ email }}</span>
                    </p>
                    <p class="text-gray-600 dark:text-gray-300">
                        Numéro de référence : <span class="font-medium">{{ reference }}</span>
                    </p>
                </div>
                <div class="mt-8 space-x-4">
                    <Link :href="route('home')"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                    Retour à l'accueil
                    </Link>
                    <Link :href="route('contact')"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                    Nous contacter
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    email: String,
    reference: String
})
</script>