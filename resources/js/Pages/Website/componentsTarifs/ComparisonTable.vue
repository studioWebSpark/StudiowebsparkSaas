<template>
    <section class="py-12 relative">
        <!-- Fond avec motif -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <h2 class="text-3xl font-bold text-center text-white mb-12">
                Comparaison des Forfaits
            </h2>
            <div class="overflow-x-auto rounded-[32px] bg-blue-500/20 backdrop-blur-sm">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/10">
                            <th class="px-6 py-3 text-left text-white">Fonctionnalité</th>
                            <th class="px-6 py-3 text-center text-white">Starter</th>
                            <th class="px-6 py-3 text-center text-white">Starter+</th>
                            <th class="px-6 py-3 text-center text-white">Standard</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(feature, index) in features" :key="index"
                            class="border-b border-white/10 hover:bg-blue-500/30 transition-colors">
                            <td class="px-6 py-4 text-white">{{ feature.name }}</td>
                            <td class="px-6 py-4 text-center text-white/90">
                                <template v-if="typeof feature.starter === 'boolean'">
                                    <i v-if="feature.starter" class='bx bx-check text-emerald-400 text-xl'></i>
                                    <i v-else class='bx bx-x text-red-400 text-xl'></i>
                                </template>
                                <template v-else>
                                    {{ feature.starter }}
                                </template>
                            </td>
                            <td class="px-6 py-4 text-center text-white/90">
                                <template v-if="typeof feature.starterPlus === 'boolean'">
                                    <i v-if="feature.starterPlus" class='bx bx-check text-emerald-400 text-xl'></i>
                                    <i v-else class='bx bx-x text-red-400 text-xl'></i>
                                </template>
                                <template v-else>
                                    {{ feature.starterPlus }}
                                </template>
                            </td>
                            <td class="px-6 py-4 text-center text-white/90">
                                <template v-if="typeof feature.standard === 'boolean'">
                                    <i v-if="feature.standard" class='bx bx-check text-emerald-400 text-xl'></i>
                                    <i v-else class='bx bx-x text-red-400 text-xl'></i>
                                </template>
                                <template v-else>
                                    {{ feature.standard }}
                                </template>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>
<script setup>
const features = [
    {
        name: "Nombre de pages",
        starter: "3 pages",
        starterPlus: "3-5 pages",
        standard: "7-9 pages"
    },
    {
        name: "Design",
        starter: "Responsive moderne",
        starterPlus: "Responsive moderne",
        standard: "Premium responsive avec animations"
    },
    {
        name: "SEO",
        starter: "De base",
        starterPlus: "De base",
        standard: "Avancé"
    },
    {
        name: "Support technique",
        starter: "30 jours",
        starterPlus: "30 jours",
        standard: "Support premium"
    },
    {
        name: "Délai de livraison",
        starter: "1 jour",
        starterPlus: "2 jours",
        standard: "4-5 jours"
    },
    {
        name: "Logo personnalisé",
        starter: false,
        starterPlus: true,
        standard: true
    },
    {
        name: "Photos professionnelles",
        starter: false,
        starterPlus: true,
        standard: true
    },
    {
        name: "Réseaux sociaux",
        starter: "En option",
        starterPlus: "En option",
        standard: "Inclus"
    },
    {
        name: "Formulaire de contact",
        starter: "Simple",
        starterPlus: "Personnalisé",
        standard: "Avancé"
    },
    {
        name: "Formation utilisation",
        starter: false,
        starterPlus: false,
        standard: true
    },
    {
        name: "Templates premium",
        starter: false,
        starterPlus: false,
        standard: true
    },
    {
        name: "CRM",
        starter: "En option",
        starterPlus: "En option",
        standard: "En option"
    }
];
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
