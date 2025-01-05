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
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-center text-white mb-8">
                    Plans de maintenance annuelle
                </h3>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:max-w-4xl lg:mx-auto">
                    <div v-for="plan in maintenancePlans" :key="plan.id" @click="selectMaintenancePlan(plan)"
                        class="bg-blue-500/20 backdrop-blur-sm rounded-[32px] p-6 transition-all duration-200 cursor-pointer"
                        :class="[
                            selectedPlan === plan.id
                                ? 'bg-blue-500/30 ring-2 ring-white'
                                : 'hover:bg-blue-500/30'
                        ]">
                        <h4 class="text-xl font-bold text-white mb-4">{{ plan.name }}</h4>
                        <p class="text-white/90 mb-6">{{ plan.description }}</p>
                        <div class="text-3xl font-bold text-white mb-6">
                            {{ plan.price }}€<span class="text-base font-normal text-white/70">/an</span>
                        </div>
                        <ul class="space-y-3">
                            <li v-for="feature in plan.features" :key="feature" class="flex items-start gap-x-3">
                                <i class='bx bx-check text-emerald-400 text-xl'></i>
                                <span class="text-white/90">{{ feature }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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
        price: 99,
        icon: 'bx-palette'
    },
    {
        id: 'socialMedia',
        name: 'Réseaux Sociaux',
        description: 'Création et gestion de vos réseaux sociaux',
        price: 199,
        icon: 'bx-share-alt'
    },
    {
        id: 'Dashboard',
        name: 'Dashboard (CRM)',
        description: 'Suivi détaillé de vos performances',
        price: 299,
        icon: 'bx-line-chart'
    },
    {
        id: 'ecommerce',
        name: 'E-commerce',
        description: 'Solution complète de vente en ligne',
        price: 349,
        icon: 'bx-store'
    }
];

const maintenancePlans = [
    {
        id: 'basic',
        name: 'Essentiel',
        description: 'Maintenance de base annuelle',
        price: 129,
        features: [
            'Mises à jour de sécurité',
            'Sauvegardes mensuelles',
            'Support par email',
            'Temps de réponse sous 72h',
            'Modifications mineures'
        ]
    },
    {
        id: 'pro',
        name: 'Professionnel',
        description: 'Maintenance complète annuelle',
        price: 249,
        features: [
            'Mises à jour prioritaires',
            'Sauvegardes hebdomadaires',
            'Support prioritaire',
            'Temps de réponse sous 24h',
            'Modifications illimitées'
        ]
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