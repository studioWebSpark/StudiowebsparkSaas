<script setup>
import { onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

onMounted(() => {
    // Redirection après 10 secondes vers le dashboard client
    setTimeout(() => {
        router.visit(route('client.dashboard'));
    }, 10000);
});
</script>

<template>
    <AppLayout title="Paiement annulé">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 text-center">
                        <!-- Icône d'annulation animée -->
                        <div class="flex justify-center mb-6">
                            <div class="animate-pulse">
                                <i class='bx bx-x-circle text-7xl text-red-500'></i>
                            </div>
                        </div>

                        <!-- Message d'annulation -->
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                            Paiement annulé
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Votre paiement a été annulé. Si vous rencontrez des difficultés, n'hésitez pas à nous
                            contacter.
                        </p>

                        <!-- Compteur de redirection -->
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Redirection automatique vers votre tableau de bord dans <span
                                class="font-bold countdown">10</span> secondes...
                        </p>

                        <!-- Boutons d'action -->
                        <div class="mt-6 space-x-4">
                            <a :href="route('client.dashboard')"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                Retour au tableau de bord
                                <i class='bx bx-home ml-2'></i>
                            </a>
                            <a :href="route('demarrer-projet')"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
                                Réessayer le paiement
                                <i class='bx bx-refresh ml-2'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
// Script pour le compteur
document.addEventListener('DOMContentLoaded', () => {
    let countdown = 10;
    const countdownElement = document.querySelector('.countdown');

    const timer = setInterval(() => {
        countdown--;
        if (countdownElement) {
            countdownElement.textContent = countdown;
        }
        if (countdown <= 0) {
            clearInterval(timer);
        }
    }, 1000);
});
</script>

<style scoped>
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {

    0%,
    100% {
        opacity: 1;
    }

    50% {
        opacity: .5;
    }
}
</style>