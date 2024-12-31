<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8">
                <!-- Animation de succès -->
                <div class="flex justify-center mb-8">
                    <div class="w-24 h-24 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                        <i class='bx bx-check text-5xl text-green-500 dark:text-green-400'></i>
                    </div>
                </div>

                <!-- Message de succès -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        Paiement confirmé !
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400">
                        Merci pour votre confiance. Votre projet est maintenant entre de bonnes mains.
                    </p>
                </div>

                <!-- Détails de la commande -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                        Récapitulatif de votre commande
                    </h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Numéro de commande</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ orderId }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Montant total</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ amount }}€</span>
                        </div>
                    </div>
                </div>

                <!-- Compte à rebours -->
                <div class="text-center">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Redirection vers votre tableau de bord dans
                        <span class="font-bold text-green-600 dark:text-green-400">{{ countdown }}</span>
                        secondes
                    </p>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-6">
                        <div class="bg-green-600 h-2 rounded-full transition-all duration-1000"
                            :style="{ width: `${(initialCountdown - countdown) * 10}%` }">
                        </div>
                    </div>
                    <Link :href="route('dashboard')"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    Accéder maintenant au tableau de bord
                    <i class='bx bx-right-arrow-alt ml-2'></i>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    orderId: {
        type: String,
        required: true
    },
    amount: {
        type: Number,
        required: true
    }
});

const initialCountdown = 10;
const countdown = ref(initialCountdown);

onMounted(() => {
    const timer = setInterval(() => {
        countdown.value--;
        if (countdown.value <= 0) {
            clearInterval(timer);
            router.visit(route('dashboard'));
        }
    }, 1000);
});
</script>