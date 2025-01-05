<template>
    <section class="py-12 sm:py-16 lg:py-20 relative overflow-hidden">
        <!-- Fond avec motif -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="mt-8 text-4xl sm:text-5xl lg:text-6xl font-bold text-white">
                    Un Processus Simple et Efficace
                </h1>
                <p class="max-w-md mx-auto mt-5 text-base text-white/80 font-pj">
                    De la conception à la livraison, un parcours transparent et professionnel
                </p>
            </div>

            <div class="flex flex-col items-center max-w-md mx-auto mt-8 lg:mt-20 lg:flex-row lg:max-w-none gap-8">
                <div v-for="(step, index) in steps" :key="index"
                    class="relative flex-1 w-full overflow-hidden bg-blue-500/20 backdrop-blur-sm rounded-[32px] min-h-[300px] flex flex-col group transition-all duration-300 hover:scale-105">
                    <div class="relative py-8 px-9 flex-1 flex flex-col z-10">
                        <!-- Numéro d'étape -->
                        <div
                            class="inline-flex items-center justify-center w-10 h-10 text-base font-bold text-white bg-blue-600 rounded-xl font-pj">
                            {{ index + 1 }}
                        </div>

                        <!-- Titre -->
                        <p class="mt-5 text-xl font-medium text-white font-pj">
                            {{ step.title }}
                        </p>

                        <!-- Liste des points -->
                        <ul class="mt-4 space-y-2 text-white/90 flex-grow">
                            <li v-for="(item, itemIndex) in step.items" :key="itemIndex" class="flex items-start">
                                <i class='bx bx-check-circle text-white mt-1 mr-2'></i>
                                <span>{{ item }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Séparateurs entre les cartes -->
                <div v-if="index < steps.length - 1" class="hidden lg:block lg:-mx-2">
                    <svg class="w-auto h-4 text-white/30" viewBox="0 0 81 16" fill="none" stroke="currentColor">
                        <!-- ... lignes SVG ... -->
                    </svg>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const steps = [
    {
        title: 'Consultation & Analyse',
        items: [
            'Analyse de vos besoins',
            'Définition des objectifs',
            'Étude de faisabilité'
        ]
    },
    {
        title: 'Proposition & Planning',
        items: [
            'Devis détaillé',
            'Planning prévisionnel',
            'Validation du projet'
        ]
    },
    {
        title: 'Développement & Tests',
        items: [
            'Développement agile',
            'Tests approfondis',
            'Points d\'étape réguliers'
        ]
    },
    {
        title: 'Livraison & Suivi',
        items: [
            'Mise en production',
            'Formation utilisateur',
            'Support technique 30j'
        ]
    }
];
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>