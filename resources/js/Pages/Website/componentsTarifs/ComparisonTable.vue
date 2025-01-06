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
                            <th class="px-6 py-3 text-center text-white">Standard</th>
                            <th class="px-6 py-3 text-center text-white">Premium</th>
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
                                <template v-if="typeof feature.standard === 'boolean'">
                                    <i v-if="feature.standard" class='bx bx-check text-emerald-400 text-xl'></i>
                                    <i v-else class='bx bx-x text-red-400 text-xl'></i>
                                </template>
                                <template v-else>
                                    {{ feature.standard }}
                                </template>
                            </td>
                            <td class="px-6 py-4 text-center text-white/90">
                                <template v-if="typeof feature.premium === 'boolean'">
                                    <i v-if="feature.premium" class='bx bx-check text-emerald-400 text-xl'></i>
                                    <i v-else class='bx bx-x text-red-400 text-xl'></i>
                                </template>
                                <template v-else>
                                    {{ feature.premium }}
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
        standard: "5-7 pages",
        premium: "10-12 pages"
    },
    {
        name: "Design",
        starter: "Responsive moderne",
        standard: "Premium responsive avec animations",
        premium: "Exclusif sur-mesure avec animations premium"
    },
    {
        name: "SEO",
        starter: "De base",
        standard: "Avancé + Suivi de base",
        premium: "Expert + Suivi mensuel personnalisé"
    },
    {
        name: "Support client",
        starter: "15 jours",
        standard: "30 jours",
        premium: "60 jours prioritaire"
    },
    {
        name: "Délai de livraison",
        starter: "1-2 jours",
        standard: "3-4 jours",
        premium: "5-7 jours"
    },
    {
        name: "Hébergement",
        starter: "Optionnel",
        standard: "Optionnel",
        premium: "1 an offert"
    },
    {
        name: "E-commerce",
        starter: false,
        standard: false,
        premium: true
    },
    {
        name: "Intégration réseaux sociaux",
        starter: false,
        standard: true,
        premium: true
    },
    {
        name: "Statistiques réseaux sociaux",
        starter: false,
        standard: true,
        premium: true
    },
    {
        name: "Formulaire de contact",
        starter: "Basique",
        standard: "Multi-pages personnalisé",
        premium: "Système avancé"
    },
    {
        name: "Blog professionnel",
        starter: false,
        standard: true,
        premium: true
    },
    {
        name: "Newsletter automatisée",
        starter: false,
        standard: false,
        premium: true
    },
    {
        name: "Audit marketing",
        starter: false,
        standard: true,
        premium: true
    },
    {
        name: "Maintenance offerte",
        starter: false,
        standard: false,
        premium: "6 mois"
    }
];
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>