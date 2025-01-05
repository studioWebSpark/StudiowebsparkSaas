<template>
    <section class="py-12 relative">
        <!-- Fond avec motif -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <h2 class="text-3xl font-bold text-center text-white mb-12">
                Questions Fréquentes
            </h2>
            <div class="max-w-3xl mx-auto space-y-4">
                <div v-for="(faq, index) in faqs" :key="index" class="bg-blue-500/20 backdrop-blur-sm rounded-[32px]">
                    <button @click="toggleFaq(index)"
                        class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-medium text-white">{{ faq.question }}</span>
                        <i class='bx bx-chevron-down text-2xl text-white'
                            :class="{ 'transform rotate-180': faq.isOpen }"></i>
                    </button>
                    <div v-show="faq.isOpen" class="px-6 pb-4">
                        <p class="text-white/90">{{ faq.answer }}</p>
                    </div>
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

<script setup>
import { ref } from 'vue';

const faqs = ref([
    {
        question: "Quel est le délai de livraison pour un site web ?",
        answer: "Nos délais varient selon le forfait choisi : 24-48h pour le forfait Starter, 3-4 jours pour le Standard, et 5-7 jours pour le Premium. Ces délais commencent après la validation du brief et la réception de vos contenus.",
        isOpen: false
    },
    {
        question: "Comment se déroule le processus de création ?",
        answer: "Le processus se déroule en 4 étapes : 1) Brief et analyse de vos besoins, 2) Proposition de maquette, 3) Développement et intégration, 4) Tests et mise en ligne. Vous êtes impliqué à chaque étape pour validation.",
        isOpen: false
    },
    {
        question: "Quels sont les moyens de paiement acceptés ?",
        answer: "Nous acceptons les paiements par carte bancaire, virement bancaire et PayPal. Pour les projets Premium, nous proposons également un paiement en plusieurs fois.",
        isOpen: false
    },
    {
        question: "Le site sera-t-il optimisé pour mobile ?",
        answer: "Oui, tous nos sites sont responsive par défaut et optimisés pour tous les appareils (mobiles, tablettes, ordinateurs). Nous testons sur différents appareils avant livraison.",
        isOpen: false
    },
    {
        question: "Proposez-vous un service de maintenance ?",
        answer: "Oui, nous proposons deux formules de maintenance annuelle : Essentiel (129€/an) et Professionnel (249€/an), incluant les mises à jour de sécurité, sauvegardes et modifications selon le forfait choisi.",
        isOpen: false
    },

    {
        question: "Comment gérez-vous l'hébergement du site ?",
        answer: "Nous proposons un hébergement premium inclus la première année avec le forfait Premium, ou en option pour les autres forfaits. Vous pouvez également utiliser votre propre hébergeur si vous le souhaitez.",
        isOpen: false
    },
    
    
    {
        question: "Proposez-vous des services SEO ?",
        answer: "Oui, tous nos sites sont optimisés SEO par défaut. Le forfait Premium inclut un suivi SEO mensuel personnalisé. Des services SEO supplémentaires sont disponibles en option.",
        isOpen: false
    }
]);

const toggleFaq = (index) => {
    faqs.value[index].isOpen = !faqs.value[index].isOpen;
};
</script>
<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
