<script setup>
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    session_id: String,
    amount: Number,
    status: String,
    customer: Object,
    project: Object
});

const progress = ref(0);
const countdown = ref(20);
let timer;

onMounted(() => {
    console.log('Props reçues dans PaymentSuccess:', props);
    startCountdown();
});

const startCountdown = () => {
    const interval = 50; // Mise à jour toutes les 50ms pour une animation fluide
    const totalTime = 20000; // 20 secondes
    const steps = totalTime / interval;
    const progressIncrement = 100 / steps;

    timer = setInterval(() => {
        progress.value += progressIncrement;

        // Mise à jour du compte à rebours toutes les secondes
        if (progress.value % (100 / 20) === 0) {
            countdown.value = 20 - Math.floor(progress.value / (100 / 20));
        }

        if (progress.value >= 100) {
            clearInterval(timer);
            router.visit(route('client.dashboard'));
        }
    }, interval);
};

const pauseCountdown = () => {
    clearInterval(timer);
};

const resumeCountdown = () => {
    startCountdown();
};

const skipCountdown = () => {
    clearInterval(timer);
    router.visit(route('client.dashboard'));
};

const formatPrice = (price) => {
    return Number(price).toLocaleString('fr-FR');
};
</script>

<template>
    <AppLayout title="Paiement réussi">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <!-- En-tête avec icône -->
                        <div class="text-center mb-8">
                            <div class="flex justify-center mb-6">
                                <div class="animate-bounce">
                                    <i class='bx bxs-check-circle text-7xl text-green-500'></i>
                                </div>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                Paiement réussi !
                            </h2>
                            <p class="text-gray-600 dark:text-gray-400">
                                Transaction #{{ session_id }}
                            </p>
                        </div>

                        <!-- Détails de la commande -->
                        <div class="max-w-3xl mx-auto space-y-6">
                            <!-- Récapitulatif rapide -->
                            <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-green-700 dark:text-green-200">Total payé</p>
                                        <p class="text-2xl font-bold text-green-800 dark:text-green-100">
                                            {{ formatPrice(amount) }}€
                                        </p>
                                    </div>

                                </div>
                            </div>

                            <!-- Informations client -->
                            <div class="border dark:border-gray-700 rounded-lg p-4">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-3">
                                    Informations client
                                </h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Nom</p>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ customer.first_name }} {{ customer.last_name }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Email</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ customer.email }}</p>
                                    </div>
                                    <div v-if="customer.activity">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Activité professionnelle</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ customer.activity }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Détails du projet -->
                            <div class="border dark:border-gray-700 rounded-lg p-4">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-3">
                                    Détails du projet
                                </h3>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Type de projet</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ project.type }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Forfait</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ project.forfait }}</p>
                                    </div>
                                    
                                </div>
                            </div>

                            <!-- Message de redirection -->


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nouvelle barre de progression et contrôles -->
        <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 py-4">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-4">
                        <button @click="pauseCountdown"
                            class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white">
                            <i class='bx bx-pause text-xl'></i>
                        </button>
                        <button @click="resumeCountdown"
                            class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white">
                            <i class='bx bx-play text-xl'></i>
                        </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            Redirection dans {{ countdown }} secondes
                        </span>
                        <button @click="skipCountdown" class="text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 
                                       flex items-center space-x-2">
                            <span>Aller au tableau de bord</span>
                            <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </div>
                </div>

                <!-- Barre de progression -->
                <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-green-500 transition-all duration-50 ease-linear rounded-full"
                        :style="{ width: `${progress}%` }">
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
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
.animate-bounce {
    animation: bounce 1s infinite;
}

@keyframes bounce {

    0%,
    100% {
        transform: translateY(-25%);
        animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
    }

    50% {
        transform: translateY(0);
        animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }
}

/* Ajout d'un padding en bas pour éviter que la barre fixe ne cache du contenu */
:deep(.py-12) {
    padding-bottom: 5rem;
}
</style>