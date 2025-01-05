<template>
    <footer class="bg-gray-50 dark:bg-gray-900 relative overflow-hidden">
        <!-- Effet de fond -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <!-- Section principale -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Logo et description -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <img src="/logo.svg" alt="Logo" class="h-8 w-auto" />
                        <span class="text-xl font-bold text-white">StudioWebSpark ✨</span>
                    </div>
                    <p class="text-white/90">
                        Développeur & Expert Marketing Digital. Transformez votre présence en ligne avec des solutions
                        sur mesure.
                    </p>
                    <div class="flex space-x-4">
                        <a v-for="social in socials" :key="social.name" :href="social.url" :aria-label="social.name"
                            class="text-white/70 hover:text-white transition-colors">
                            <i :class="social.icon" class="text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">
                        Services
                    </h3>
                    <ul class="space-y-3">
                        <li v-for="service in services" :key="service.name">
                            <a :href="service.url" class="text-white/80 hover:text-white transition-colors">
                                {{ service.name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Ressources -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">
                        Ressources
                    </h3>
                    <ul class="space-y-3">
                        <li v-for="resource in resources" :key="resource.name">
                            <a :href="resource.url" class="text-white/80 hover:text-white transition-colors">
                                {{ resource.name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">
                        Newsletter
                    </h3>
                    <p class="text-white/90 mb-4">
                        Restez informé des dernières tendances et actualités
                    </p>
                    <form @submit.prevent="subscribeNewsletter" class="space-y-3">
                        <div class="relative">
                            <input type="email" v-model="email" placeholder="Votre email" :disabled="isLoading"
                                class="w-full px-4 py-2 rounded-lg bg-white/10 text-white placeholder-white/60 border-none backdrop-blur-sm"
                                required />
                        </div>

                        <button type="submit" :disabled="isLoading"
                            class="w-full px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-colors flex items-center justify-center backdrop-blur-sm">
                            {{ isLoading ? 'Inscription...' : 'S\'abonner' }}
                        </button>
                    </form>
                </div>
            </div>

            

            <!-- Copyright et liens légaux -->
            <div class="mt-16 pt-8 border-t border-white/10">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-white/80">
                        © {{ new Date().getFullYear() }} StudioWebSpark ✨ . Tous droits réservés.
                    </p>
                    <div class="flex space-x-6">
                        <a v-for="link in legalLinks" :key="link.name" :href="link.url"
                            class="text-white/70 hover:text-white transition-colors">
                            {{ link.name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const email = ref('');
const isLoading = ref(false);
const notification = ref({ show: false, message: '', type: '' });

const socials = [
    { name: 'LinkedIn', icon: 'bx bxl-linkedin', url: '#' },
    { name: 'GitHub', icon: 'bx bxl-github', url: '#' },
    { name: 'Twitter', icon: 'bx bxl-twitter', url: '#' },
    { name: 'Instagram', icon: 'bx bxl-instagram', url: '#' }
];

const services = [
    { name: 'Développement Web', url: '/web-creation' },
    { name: 'Marketing Digital', url: '/marketing-digital' },
    { name: 'Maintenance & Support', url: '/maintenance-support' },
    { name: 'Consulting', url: '/conseil' }
];

const resources = [
    { name: 'À propos', url: '/about' },
    { name: 'Contact', url: '/contact' },
    { name: 'FAQ', url: '/faq' }
];

const legalLinks = [
    {
        name: 'Mentions légales',
        url: route('mentions-legales')
    },
    {
        name: 'Politique de confidentialité',
        url: route('politique-confidentialite')
    },

];

const subscribeNewsletter = async () => {
    isLoading.value = true;
    console.log('Tentative d\'inscription avec:', email.value);

    try {
        const response = await axios.post(route('newsletter.subscribe'), {
            email: email.value
        });

        const { status, message } = response.data;
        console.log('Réponse du serveur:', response.data);

        // Réinitialiser l'email seulement après une inscription réussie
        if (status === 'success') {
            email.value = '';
        }

        // Afficher la notification
        notification.value = {
            show: true,
            message: message,
            type: status
        };

        // Garder la notification plus longtemps (8 secondes)
        setTimeout(() => {
            notification.value.show = false;
        }, 8000);

    } catch (error) {
        console.error('Erreur lors de l\'inscription:', error);
        notification.value = {
            show: true,
            message: error.response?.data?.message || 'Une erreur est survenue.',
            type: 'error'
        };

        // Même délai pour les erreurs
        setTimeout(() => {
            notification.value.show = false;
        }, 5000);
    } finally {
        isLoading.value = false;
    }
};
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}

@keyframes scroll {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
    }
}

.animate-scroll {
    animation: scroll 30s linear infinite;
}

.animate-scroll:hover {
    animation-play-state: paused;
}
</style>
