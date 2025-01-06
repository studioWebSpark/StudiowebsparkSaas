<template>
    <section class="py-12 bg-gray-50 dark:bg-gray-900 sm:py-16 lg:py-20 relative overflow-hidden">
        <!-- Effet de fond -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl">
                    Questions
                    <span class="relative">
                        <span class="relative z-10 text-white">Fréquentes</span>
                        <div class="absolute bottom-0 left-0 w-full h-3 bg-blue-200/50 -z-10 transform -rotate-1"></div>
                    </span>
                </h2>
                <p class="mt-4 text-lg text-white/90">
                    Tout ce que vous devez savoir sur notre stack technique
                </p>
            </div>

            <div class="max-w-3xl mx-auto mt-12">
                <div class="space-y-4">
                    <div v-for="(faq, index) in faqs" :key="index" class="relative group">
                        <!-- Effet de fond au hover -->
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl blur-2xl opacity-0 group-hover:opacity-10 transition duration-1000">
                        </div>

                        <!-- Question -->
                        <div
                            class="relative bg-white/90 backdrop-blur-sm rounded-xl shadow-sm transition-all duration-300 group-hover:shadow-lg">
                            <button @click="toggleFaq(index)"
                                class="flex items-center justify-between w-full px-6 py-5 text-left">
                                <span class="text-lg font-semibold text-gray-900">
                                    {{ faq.question }}
                                </span>
                                <span class="flex items-center ml-6 h-7">
                                    <i :class="[
                                        activeFaq === index ? 'rotate-180' : '',
                                        'bx bx-chevron-down text-2xl text-gray-900 transition-transform duration-300'
                                    ]"></i>
                                </span>
                            </button>

                            <!-- Réponse -->
                            <div v-show="activeFaq === index" class="px-6 pb-6">
                                <div class="h-px w-full bg-gradient-to-r from-blue-500/50 to-indigo-500/50 mb-4"></div>
                                <p class="text-base text-gray-600">
                                    {{ faq.answer }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const activeFaq = ref(null);

const toggleFaq = (index) => {
    activeFaq.value = activeFaq.value === index ? null : index;
};

const faqs = [
    {
        question: "Pourquoi avoir choisi Vue.js ?",
        answer: "Vue.js offre une excellente performance, une courbe d'apprentissage douce et une grande flexibilité. Il permet de créer des interfaces utilisateur réactives et modernes tout en restant léger et facile à maintenir."
    },
    {
        question: "Quels sont les avantages de Laravel ?",
        answer: "Laravel est un framework PHP robuste qui offre une excellente sécurité, une architecture MVC claire, et de nombreux outils intégrés comme l'ORM Eloquent. Il facilite le développement rapide d'applications web sécurisées et performantes."
    },
    {
        question: "Pourquoi utiliser Tailwind CSS ?",
        answer: "Tailwind CSS permet un développement rapide avec son approche utility-first. Il offre une personnalisation poussée, une excellente performance en production et une maintenance facilitée des styles."
    },
    {
        question: "Comment assurez-vous la sécurité de l'application ?",
        answer: "Nous utilisons les meilleures pratiques de sécurité de Laravel, incluant la protection CSRF, le hachage des mots de passe, la validation des données, et les sessions sécurisées. De plus, nous effectuons des mises à jour régulières."
    },
    {
        question: "Quel est le délai de livraison moyen ?",
        answer: "Notre délai de livraison standard est de 24h pour un site vitrine classique. Pour des projets plus complexes, nous établissons un planning détaillé en fonction de vos besoins spécifiques."
    }
];
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>