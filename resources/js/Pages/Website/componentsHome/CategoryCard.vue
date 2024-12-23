<template>
  <div class="relative overflow-hidden rounded-xl group h-[200px] transition-all duration-300 hover:shadow-2xl">
    <!-- Image de fond avec overlay -->
    <div class="absolute inset-0">
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-black/20 z-10"></div>
      <img class="object-cover w-full h-full transition-all duration-500 group-hover:scale-110"
        :src="`/images/${category.image}`" :alt="category.name" />
    </div>

    <!-- Contenu centré -->
    <div class="absolute inset-0 z-20 flex flex-col items-center justify-center p-4">
      <h3 class="text-xl font-bold text-white mb-2">
        {{ category.name }}
      </h3>
      <p
        class="text-xs text-gray-200 opacity-0 transform translate-y-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0 max-w-[200px]">
        {{ category.description }}
      </p>
    </div>

    <!-- Lien cliquable -->
    <Link :href="route(category.route)" class="absolute inset-0 z-30">
    <span class="sr-only">En savoir plus sur {{ category.name }}</span>
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  category: {
    type: Object,
    required: true
  },
  isDarkMode: Boolean
});
</script>

<style scoped>
.group:hover .group-hover\:scale-110 {
  transform: scale(1.1);
}

.group:hover .group-hover\:opacity-100 {
  opacity: 1;
}

.group:hover .group-hover\:translate-y-0 {
  transform: translateY(0);
}
</style>