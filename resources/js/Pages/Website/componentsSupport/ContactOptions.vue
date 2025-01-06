<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const subject = ref('');
const message = ref('');
const email = ref('');
const name = ref('');
const loading = ref(false);
const showSuccess = ref(false);
const showError = ref(false);

const submitForm = async () => {
    loading.value = true;
    showSuccess.value = false;
    showError.value = false;

    try {
        await axios.post('/api/contact', {
            subject: subject.value,
            message: message.value,
            email: email.value,
            name: name.value
        });

        // Réinitialiser le formulaire
        subject.value = '';
        message.value = '';
        email.value = '';
        name.value = '';
        showSuccess.value = true;

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

// Fonction pour gérer le scroll
const scrollToContact = () => {
    const element = document.getElementById('contact-section');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
};

// Écouter les événements de hash dans l'URL
onMounted(() => {
    if (window.location.hash === '#contact') {
        scrollToContact();
    }
});

// Exposer la fonction pour l'utiliser ailleurs
defineExpose({
    scrollToContact
});
</script>

<template>
    <section class="py-12 relative">
        <!-- Fond avec motif -->
        <div class="absolute inset-0 bg-blue-600">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <!-- Messages de notification -->
            <div v-if="showSuccess"
                class="max-w-3xl mx-auto mb-8 bg-emerald-500/20 backdrop-blur-sm border-l-4 border-emerald-400 p-4 rounded-[32px]">
                <div class="flex">
                    <i class='bx bx-check-circle text-2xl text-emerald-400'></i>
                    <p class="ml-3 text-white">Message envoyé avec succès ! Nous vous répondrons dans les plus brefs
                        délais.</p>
                </div>
            </div>

            <div v-if="showError"
                class="max-w-3xl mx-auto mb-8 bg-red-500/20 backdrop-blur-sm border-l-4 border-red-400 p-4 rounded-[32px]">
                <div class="flex">
                    <i class='bx bx-error-circle text-2xl text-red-400'></i>
                    <p class="ml-3 text-white">Une erreur est survenue. Veuillez réessayer.</p>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-center text-white mb-12"> <a href="#contact" class="text-white">Nous
                    Contacter </a></h2>

            <div id="contact-section" class="scroll-mt-20">
                <div class="max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 justify-center">
                        <!-- Email -->
                        <div
                            class="text-center p-6 bg-blue-500/20 backdrop-blur-sm rounded-[32px] transition-all duration-300 hover:bg-blue-500/30">
                            <i class='bx bx-envelope text-4xl text-white'></i>
                            <h3 class="mt-4 text-xl font-semibold text-white">Email</h3>
                            <p class="mt-2 text-white/90">Réponse sous 24h ouvrées</p>
                            <a href="mailto:studiowebspark@gmail.com"
                                class="mt-4 inline-block px-6 py-2 bg-white/20 text-white rounded-[32px] hover:bg-white/30 transition-all">
                                Envoyer un email
                            </a>
                        </div>

                        <!-- Téléphone -->
                        <div
                            class="text-center p-6 bg-blue-500/20 backdrop-blur-sm rounded-[32px] transition-all duration-300 hover:bg-blue-500/30">
                            <i class='bx bx-phone text-4xl text-white'></i>
                            <h3 class="mt-4 text-xl font-semibold text-white">Téléphone</h3>
                            <p class="mt-2 text-white/90">Lun-Ven, 9h-18h</p>
                            <a href="tel:+33767175724"
                                class="mt-4 inline-block px-6 py-2 bg-white/20 text-white rounded-[32px] hover:bg-white/30 transition-all">
                                Appeler
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de contact -->
            <div class="max-w-3xl mx-auto mt-12">
                <div class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] p-6">
                    <h3 class="text-xl font-semibold text-white mb-6">Envoyez-nous un message</h3>

                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-white mb-2">Nom</label>
                                <input type="text" v-model="name" required
                                    class="w-full px-4 py-2 rounded-[32px] bg-white/20 border-white/20 text-white placeholder-white/70 focus:border-white focus:ring-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-white mb-2">Email</label>
                                <input type="email" v-model="email" required
                                    class="w-full px-4 py-2 rounded-[32px] bg-white/20 border-white/20 text-white placeholder-white/70 focus:border-white focus:ring-white">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Sujet</label>
                            <select v-model="subject" required
                                class="w-full px-4 py-2 rounded-[32px] bg-white/20 border-white/20 text-white focus:border-white focus:ring-white">
                                <option value="" disabled selected class="bg-blue-600">Sélectionnez un sujet
                                </option>
                                <option value="devis" class="bg-blue-600">Demande de devis</option>
                                <option value="information" class="bg-blue-600">Demande d'information</option>
                                <option value="other" class="bg-blue-600">Autre</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Message</label>
                            <textarea v-model="message" required rows="4"
                                class="w-full px-4 py-2 rounded-[32px] bg-white/20 border-white/20 text-white placeholder-white/70 focus:border-white focus:ring-white"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" :disabled="loading"
                                class="px-6 py-2 bg-white/20 text-white rounded-[32px] hover:bg-white/30 transition-all flex items-center">
                                <i class='bx bx-send mr-2'></i>
                                {{ loading ? 'Envoi...' : 'Envoyer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
