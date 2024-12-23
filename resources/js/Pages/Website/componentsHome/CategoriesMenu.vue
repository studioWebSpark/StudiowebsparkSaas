<template>
  <transition name="fade" enter-active-class="transition-opacity duration-200"
    leave-active-class="transition-opacity duration-200" enter-class="opacity-0" enter-to-class="opacity-100"
    leave-class="opacity-100" leave-to-class="opacity-0">
    <div :class="{ 'bg-white': !isDarkMode, 'bg-gray-800': isDarkMode }" class="py-16 lg:block"
      style="margin-top: 1rem;" @mouseover="$emit('mouseover')" @mouseleave="$emit('mouseleave')">
      <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-6xl">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
            Nos Services
          </h2>
          <p class="text-gray-600 dark:text-gray-400">
            Des solutions complètes pour votre présence digitale
          </p>
        </div>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
          <category-card v-for="(category, index) in categories" :key="index" :category="category"
            :is-dark-mode="isDarkMode" />
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import CategoryCard from './CategoryCard.vue';

defineProps({
  isDarkMode: Boolean
});

const categories = [
  {
    name: "Création de Sites Web",
    description: "Sites vitrines, e-commerce et applications web sur mesure",
    image: "category-1.png",
    route: "web-creation"
  },
  {
    name: "Marketing Digital",
    description: "SEO, réseaux sociaux et stratégie de contenu",
    image: "category-2.png",
    route: "marketing-digital"
  },
  {
    name: "Maintenance & Support",
    description: "Support technique, mises à jour et sécurité",
    image: "category-3.png",
    route: "maintenance-support"
  },
  {
    name: "Conseil",
    description: "Accompagnement personnalisé ",
    image: "category-4.png",
    route: "conseil"
  }
];

defineEmits(['mouseover', 'mouseleave']);
</script>