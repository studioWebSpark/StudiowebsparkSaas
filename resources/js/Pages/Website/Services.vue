<template>
    <div :class="{ 'dark': isDarkMode }" class="overflow-x-hidden bg-gray-50 dark:bg-gray-900">
        <Header :is-dark-mode="isDarkMode" :is-menu-open="isMenuOpen" :is-mobile="isMobile"
            :show-categories="showCategories" @toggle-dark-mode="toggleDarkMode" @toggle-menu="toggleMenu"
            @toggle-categories="toggleCategories" @show-categories="showCategories = true"
            @hide-categories="hideCategories" />
       
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <h1 class="text-4xl font-bold text-center text-gray-900 dark:text-white mb-8">
                    Nos Services
                </h1>
                <p class="text-center text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-16">
                    Des solutions complètes pour votre présence digitale
                </p>

                <!-- Grille des services avec liens directs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <Link v-for="service in services" :key="service.id" :href="route(service.route)"
                        class="group relative overflow-hidden rounded-xl bg-white dark:bg-gray-800 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <span class="material-icons-outlined text-3xl text-blue-500 mr-3">
                                {{ service.icon }}
                            </span>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ service.name }}
                            </h2>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ service.description }}
                        </p>
                        <div class="mt-4 flex items-center text-blue-500 group-hover:text-blue-600">
                            En savoir plus
                            <span
                                class="material-icons-outlined ml-2 transform group-hover:translate-x-1 transition-transform">
                                arrow_forward
                            </span>
                        </div>
                    </div>
                    </Link>
                </div>
            </div>

    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import Header from './componentsHome/Header.vue';

const services = [
    {
        id: 'web',
        name: 'Création de Sites Web',
        description: 'Sites vitrines, e-commerce et applications web sur mesure',
        route: 'web-creation',
        icon: 'computer'
    },
    {
        id: 'marketing',
        name: 'Marketing Digital',
        description: 'SEO, réseaux sociaux et stratégie de contenu',
        route: 'marketing-digital',
        icon: 'trending_up'
    },
    {
        id: 'maintenance',
        name: 'Maintenance & Support',
        description: 'Support technique, mises à jour et sécurité',
        route: 'maintenance-support',
        icon: 'build'
    },
    {
        id: 'formation',
        name: 'Formation & Conseil',
        description: 'Accompagnement personnalisé et formation',
        route: 'formation-conseil',
        icon: 'school'
    }
];
</script>

<style scoped>
.material-icons-outlined {
    font-size: 1.25rem;
    vertical-align: text-bottom;
}
</style>
