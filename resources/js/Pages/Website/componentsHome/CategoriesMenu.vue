<template>
  <transition name="fade" enter-active-class="transition-opacity duration-200"
    leave-active-class="transition-opacity duration-200" enter-class="opacity-0" enter-to-class="opacity-100"
    leave-class="opacity-100" leave-to-class="opacity-0">
    <div class="relative min-h-screen">
      <!-- Même fond que CategoriesMenu -->
      <div class="fixed inset-0 bg-blue-600 dark:bg-blue-900">
        <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
      </div>

      <!-- Contenu de la page -->
      <div class="relative z-10">
        <div class="py-24 lg:block" style="margin-top: 1rem;" @mouseover="$emit('mouseover')"
          @mouseleave="$emit('mouseleave')">

          <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl relative">
            <div class="text-center mb-16">
              <h2 class="text-3xl font-bold text-white mb-4">
                Nos Services
              </h2>
              <p class="text-lg text-white/90">
                Des solutions complètes pour votre présence digitale
              </p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-16">
              <Link v-for="(category, index) in categories" :key="index" :href="route(category.route)" class="group">
              <div class="relative p-6 bg-white rounded-2xl transition-all duration-300 h-full flex flex-col">

                <h3 class="text-xl font-bold text-gray-900 mb-2">
                  {{ category.name }}
                </h3>
                <p class="text-gray-600 mb-4 flex-grow">
                  {{ category.description }}
                </p>
                <div class="flex items-center text-blue-600 font-medium group-hover:translate-x-2 transition-transform">
                  En savoir plus
                  <i class='bx bx-right-arrow-alt ml-2'></i>
                </div>
              </div>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  isDarkMode: Boolean
});

const categories = [
  {
    name: "Création de Sites Web",
    description: "Sites vitrines, e-commerce et applications web sur mesure",
    route: "web-creation"
  },
  {
    name: "Marketing Digital",
    description: "SEO, réseaux sociaux et stratégie de contenu",
    route: "marketing-digital"
  },
  {
    name: "Maintenance & Support",
    description: "Support technique, mises à jour et sécurité",
    route: "maintenance-support"
  },
  {
    name: "Consulting",
    description: "Accompagnement personnalisé pour votre transformation digitale",
    route: "conseil"
  }
];

defineEmits(['mouseover', 'mouseleave']);
</script>

<style scoped>
.bg-grid-pattern {
  background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
  background-size: 40px 40px;
}
</style>