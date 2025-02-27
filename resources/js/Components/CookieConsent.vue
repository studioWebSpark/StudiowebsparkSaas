<script setup>
import { ref, onMounted } from 'vue';

const showBanner = ref(false);

onMounted(() => {
    // Vérifier si l'utilisateur a déjà accepté les cookies
    if (!localStorage.getItem('cookiesAccepted')) {
        showBanner.value = true;
    }
});

const acceptCookies = () => {
    localStorage.setItem('cookiesAccepted', 'true');
    showBanner.value = false;
};

const refuseCookies = () => {
    localStorage.setItem('cookiesAccepted', 'false');
    showBanner.value = false;
};
</script>

<template>
    <div v-if="showBanner"
        class="fixed bottom-0 inset-x-0 z-50 p-4 bg-white dark:bg-gray-800 shadow-lg transform transition-transform duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex-1">
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        Nous utilisons des cookies pour améliorer votre expérience. En continuant à utiliser notre site,
                        vous acceptez notre
                        <a href="/politique-confidentialite"
                            class="text-blue-600 dark:text-blue-400 hover:underline">politique de confidentialité</a>.
                    </p>
                </div>
                <div class="flex gap-4">
                    <button @click="refuseCookies"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                        Refuser
                    </button>
                    <button @click="acceptCookies"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-full transition-colors">
                        Accepter
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
