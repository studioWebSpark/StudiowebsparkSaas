<template>
    <section class="py-12 sm:py-16 lg:py-20 relative">
        <!-- Fond avec motif grille -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col items-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl">
                    Technologies Approuvées
                </h2>
                <p class="mt-4 text-lg text-white/80 text-center">
                    Des technologies modernes et performantes pour des projets de qualité
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 mt-12 md:grid-cols-2 lg:grid-cols-3 lg:gap-8">
                <!-- Vue.js -->
                <div
                    class="flex flex-col bg-white/10 backdrop-blur-sm rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-center pt-6">
                        <i class='bx bxl-vuejs text-6xl text-emerald-400'></i>
                    </div>
                    <div class="px-6 py-8">
                        <div class="flex justify-center mb-4">
                            <div class="flex gap-1">
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                            </div>
                        </div>
                        <blockquote class="flex-1 mt-8">
                            <p class="text-lg leading-relaxed text-white">
                                "Framework JavaScript progressif offrant une excellente réactivité et une maintenance
                                simplifiée. Parfait pour les interfaces modernes."
                            </p>
                        </blockquote>
                        <p class="mt-6 text-base font-semibold text-emerald-400">Vue.js 3</p>
                        <p class="mt-1 text-sm text-white/80">Framework Frontend</p>
                    </div>
                </div>

                <!-- Laravel/PHP -->
                <div
                    class="flex flex-col bg-white/10 backdrop-blur-sm rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-center pt-6">
                        <i class='bx bxl-php text-6xl text-indigo-400'></i>
                    </div>
                    <div class="px-6 py-8">
                        <div class="flex justify-center mb-4">
                            <div class="flex gap-1">
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                            </div>
                        </div>
                        <blockquote class="flex-1 mt-8">
                            <p class="text-lg leading-relaxed text-white">
                                "Framework PHP robuste avec une architecture élégante. Sécurité intégrée et écosystème
                                riche pour des applications web performantes."
                            </p>
                        </blockquote>
                        <p class="mt-6 text-base font-semibold text-indigo-400">Laravel/PHP</p>
                        <p class="mt-1 text-sm text-white/80">Framework Backend</p>
                    </div>
                </div>

                <!-- Tailwind -->
                <div
                    class="flex flex-col bg-white/10 backdrop-blur-sm rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-center pt-6">
                        <i class='bx bxl-tailwind-css text-6xl text-cyan-400'></i>
                    </div>
                    <div class="px-6 py-8">
                        <div class="flex justify-center mb-4">
                            <div class="flex gap-1">
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                                <i class='bx bxs-star text-yellow-400'></i>
                            </div>
                        </div>
                        <blockquote class="flex-1 mt-8">
                            <p class="text-lg leading-relaxed text-white">
                                "Framework CSS utilitaire permettant un développement rapide et flexible. Design
                                responsive et personnalisation poussée."
                            </p>
                        </blockquote>
                        <p class="mt-6 text-base font-semibold text-cyan-400">Tailwind CSS</p>
                        <p class="mt-1 text-sm text-white/80">Framework CSS</p>
                    </div>
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