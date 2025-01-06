<template>
    <section class="py-12 relative">
        <!-- Fond avec motif -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white">Options Supplémentaires</h2>
                <p class="mt-4 text-xl text-white/90">
                    Personnalisez votre solution avec nos options
                </p>
            </div>

            <!-- Options -->
            <div class="mt-12 grid grid-cols-1 gap-4 sm:gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div v-for="option in TemplateSelection" :key="option.id"
                    class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] p-6 transition-all duration-200 hover:bg-blue-500/30">
                    <div class="flex flex-col items-center">
                        <div class="h-12 w-12 bg-white/10 rounded-xl flex items-center justify-center mb-4">
                            <i :class="['bx text-2xl text-white', option.icon]"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-white text-center">{{ option.name }}</h3>
                        <p class="mt-2 text-white/90 text-center">{{ option.description }}</p>
                        <p class="mt-4 text-center font-semibold text-white">
                            {{ option.price }}€
                        </p>
                    </div>
                </div>
            </div>

            <!-- Plans de maintenance -->
            
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const TemplateSelection = [
    {
        id: 'logoPhotos',
        name: 'Création de logo + Photos Pro',
        description: 'Design professionnel de votre identité visuelle',
        price: 199,
        icon: 'bx-palette'
    },
    {
        id: 'socialMedia',
        name: 'Réseaux Sociaux',
        description: 'Création et gestion de vos réseaux sociaux',
        price: 349,
        icon: 'bx-share-alt'
    },
    
    {
        id: 'ecommerce',
        name: 'E-commerce & CRM',
        description: 'Solution complète de vente en ligne',
        price: 899,
        icon: 'bx-store'
    }
];



const selectedPlan = ref(null);

const selectMaintenancePlan = (plan) => {
    selectedPlan.value = selectedPlan.value === plan.id ? null : plan.id;
};
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>