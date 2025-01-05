<template>
    <section class="py-12 bg-white dark:bg-gray-800 sm:py-16 lg:py-20 relative overflow-hidden">
        <!-- Effet de fond -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 relative">
            <!-- En-tête -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl">
                    Ce que disent
                    <span class="relative">
                        <span class="relative z-10 text-white">nos clients</span>
                        <div class="absolute bottom-0 left-0 w-full h-3 bg-blue-200/50 -z-10 transform -rotate-1"></div>
                    </span>
                </h2>
                <p class="mt-4 text-lg text-white/90">
                    Découvrez les retours d'expérience sur notre stack technique
                </p>
            </div>

            <!-- Grille de témoignages -->
            <div class="grid gap-8 mt-16 md:grid-cols-2 lg:grid-cols-3">
                <div v-for="(testimonial, index) in testimonials" :key="index" class="relative group">
                    <!-- Effet de fond au hover -->
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl blur-2xl opacity-0 group-hover:opacity-10 transition duration-1000">
                    </div>

                    <!-- Carte -->
                    <div
                        class="relative p-8 bg-white/90 backdrop-blur-sm border border-gray-100 rounded-2xl transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-xl">
                        <!-- Quote icon -->
                        <div class="absolute -top-4 -left-4">
                            <div
                                class="flex items-center justify-center w-8 h-8 text-blue-500 bg-blue-100/50 backdrop-blur-sm rounded-full">
                                <i class='bx bxs-quote-left'></i>
                            </div>
                        </div>

                        <!-- Contenu -->
                        <div class="relative">
                            <!-- Note -->
                            <div class="flex items-center mb-6">
                                <div class="flex">
                                    <i v-for="star in 5" :key="star" class='bx bxs-star text-yellow-400 text-xl'></i>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">5.0</span>
                            </div>

                            <!-- Témoignage -->
                            <blockquote class="text-lg text-gray-600 italic">
                                "{{ testimonial.comment }}"
                            </blockquote>

                            <!-- Séparateur -->
                            <div class="h-px w-16 my-6 bg-gradient-to-r from-blue-500 to-indigo-500"></div>

                            <!-- Auteur -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img :src="testimonial.logo" :alt="testimonial.company"
                                        class="w-12 h-12 rounded-full object-cover border-2 border-blue-100">
                                </div>
                                <div class="ml-4">
                                    <p class="text-base font-semibold text-gray-900">{{ testimonial.name }}</p>
                                    <p class="text-sm text-gray-600">{{ testimonial.role }}, {{ testimonial.company }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="grid grid-cols-2 gap-8 mt-16 sm:grid-cols-4">
                <div v-for="(stat, index) in stats" :key="index" class="text-center">
                    <div class="text-4xl font-bold text-white">{{ stat.value }}</div>
                    <div class="mt-2 text-sm text-white/90">{{ stat.label }}</div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const testimonials = [
    {
        name: "Marie Laurent",
        role: "CTO",
        company: "TechStart",
        logo: "/images/companies/techstart.svg",
        comment: "L'utilisation de Vue.js nous a permis d'avoir une interface utilisateur très réactive. La combinaison avec Laravel offre une base solide pour notre application."
    },
    {
        name: "Thomas Martin",
        role: "Lead Developer",
        company: "WebInnovate",
        logo: "/images/companies/webinnovate.svg",
        comment: "Tailwind CSS nous fait gagner un temps précieux en développement. L'intégration avec Vue.js est parfaite et le code reste très maintenable."
    },
    {
        name: "Sophie Dubois",
        role: "Product Owner",
        company: "DigitalFlow",
        logo: "/images/companies/digitalflow.svg",
        comment: "La stack technique choisie nous permet d'avoir une application performante et sécurisée. Le support est excellent et les mises à jour sont simples."
    }
];

const stats = [
    { value: '500+', label: 'Clients Satisfaits' },
    { value: '98%', label: 'Taux de Satisfaction' },
    { value: '24/7', label: 'Support Client' },
    { value: '100%', label: 'Projets Livrés à Temps' }
];
</script>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>