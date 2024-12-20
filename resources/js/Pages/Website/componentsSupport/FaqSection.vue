<template>
    <section class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">
                Questions Fréquentes
            </h2>
            <div class="max-w-3xl mx-auto space-y-4">
                <div v-for="(faq, index) in faqs" :key="index" 
                    class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <button @click="toggleFaq(index)"
                        class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-medium text-gray-900 dark:text-white">{{ faq.question }}</span>
                        <i class='bx bx-chevron-down text-2xl'
                            :class="{ 'transform rotate-180': faq.isOpen }"></i>
                    </button>
                    <div v-show="faq.isOpen" class="px-6 pb-4">
                        <p class="text-gray-600 dark:text-gray-300">{{ faq.answer }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const faqs = ref([
    {
        question: "Comment puis-je contacter le support ?",
        answer: "Vous pouvez nous contacter 24/7 via notre chat en ligne, par email ou par téléphone.",
        isOpen: false
    },
    // Ajoutez d'autres FAQs ici
]);

const toggleFaq = (index) => {
    faqs.value[index].isOpen = !faqs.value[index].isOpen;
};
</script> 