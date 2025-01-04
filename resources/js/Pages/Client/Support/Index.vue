<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SideBarClient from '@/Pages/Website/componentsDashboard/SideBarClient.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const subject = ref('');
const message = ref('');
const loading = ref(false);
const showSuccess = ref(false);
const showError = ref(false);

const submitForm = async () => {
    loading.value = true;
    showSuccess.value = false;
    showError.value = false;

    try {
        await router.post(route('client.support.send'), {
            subject: subject.value,
            message: message.value
        });

        // Réinitialiser le formulaire
        subject.value = '';
        message.value = '';
        showSuccess.value = true;

        // Faire défiler jusqu'au message de succès
        setTimeout(() => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }, 100);

        // Masquer le message après 6 secondes
        setTimeout(() => {
            showSuccess.value = false;
        }, 6000);

    } catch (error) {
        showError.value = true;
        setTimeout(() => {
            showError.value = false;
        }, 6000);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <AppLayout title="Support Client">
        <SideBarClient>
            <div class="py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl mx-auto">
                    <!-- Message de succès -->
                    <div v-if="showSuccess"
                        class="mb-8 bg-green-50 border-l-4 border-green-400 p-4 rounded-md shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class='bx bx-check-circle text-2xl text-green-400'></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800">
                                    Message envoyé avec succès !
                                </h3>
                                <div class="mt-2 text-sm text-green-700">
                                    <p>Merci de nous avoir contacté. Notre équipe vous répondra dans les plus brefs
                                        délais
                                        (généralement sous 24-48h ouvrées).</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message d'erreur -->
                    <div v-if="showError" class="mb-8 bg-red-50 border-l-4 border-red-400 p-4 rounded-md shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class='bx bx-error-circle text-2xl text-red-400'></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Une erreur est survenue
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p>Désolé, votre message n'a pas pu être envoyé. Veuillez réessayer ou nous
                                        contacter
                                        directement par email.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- En-tête -->
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                            Comment pouvons-nous vous aider ?
                        </h2>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            Notre équipe est là pour vous accompagner
                        </p>
                    </div>

                    <!-- Informations de contact rapide -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                            <div class="flex items-center mb-4">
                                <i class='bx bx-phone text-2xl text-indigo-600 mr-3'></i>
                                <h3 class="text-lg font-semibold">Par téléphone</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400">
                                Du lundi au vendredi, 9h-18h
                            </p>
                            <a href="tel:+33123456789"
                                class="text-indigo-600 hover:text-indigo-800 font-medium block mt-2">
                                +33 7 67 17 57 24
                            </a>
                        </div>

                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                            <div class="flex items-center mb-4">
                                <i class='bx bx-envelope text-2xl text-indigo-600 mr-3'></i>
                                <h3 class="text-lg font-semibold">Par email</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400">
                                Réponse sous 24h ouvrées
                            </p>
                            <a href="mailto:support@example.com"
                                class="text-indigo-600 hover:text-indigo-800 font-medium block mt-2">
                                studiowebspark@gmail.com
                            </a>
                        </div>
                    </div>

                    <!-- Formulaire de contact -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-6">Envoyez-nous un message</h3>

                        <form @submit.prevent="submitForm" class="space-y-6">
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Sujet
                                </label>
                                <select id="subject" v-model="subject" :disabled="loading"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                    <option value="">Sélectionnez un sujet</option>
                                    <option value="technical">Support technique</option>
                                    <option value="billing">Facturation</option>
                                    <option value="project">Question sur mon projet</option>
                                    <option value="other">Autre</option>
                                </select>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Message
                                </label>
                                <textarea id="message" v-model="message" :disabled="loading" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required></textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" :disabled="loading"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class='bx bx-send mr-2'></i>
                                    {{ loading ? 'Envoi en cours...' : 'Envoyer' }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- FAQ -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Questions fréquentes</h3>
                        <div class="space-y-4">
                            <details class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                <summary class="px-4 py-3 cursor-pointer font-medium">
                                    Comment suivre l'avancement de mon projet ?
                                </summary>
                                <div class="px-4 py-3 text-gray-600 dark:text-gray-400">
                                    Vous pouvez suivre l'avancement de votre projet dans la section "Mes Projets" de
                                    votre tableau de bord.
                                </div>
                            </details>

                            <details class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                <summary class="px-4 py-3 cursor-pointer font-medium">
                                    Comment modifier mes informations de facturation ?
                                </summary>
                                <div class="px-4 py-3 text-gray-600 dark:text-gray-400">
                                    Rendez-vous dans les paramètres de votre compte pour modifier vos informations de
                                    facturation.
                                </div>
                            </details>
                        </div>
                    </div>
                </div>
            </div>
        </SideBarClient>
    </AppLayout>
</template>

<style scoped>
details {
    transition: all 0.3s ease;
}

details[open] summary {
    border-bottom: 1px solid #e5e7eb;
}

summary::-webkit-details-marker {
    display: none;
}

summary {
    list-style: none;
    position: relative;
}

summary::after {
    content: '+';
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
}

details[open] summary::after {
    content: '-';
}
</style>