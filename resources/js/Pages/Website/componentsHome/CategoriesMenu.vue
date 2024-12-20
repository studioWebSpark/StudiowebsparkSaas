<template>
  <transition name="fade" enter-active-class="transition-opacity duration-200" leave-active-class="transition-opacity duration-200"
    enter-class="opacity-0" enter-to-class="opacity-100" leave-class="opacity-100" leave-to-class="opacity-0">
    <div :class="{ 'bg-white': !isDarkMode, 'bg-gray-800': isDarkMode }" class="py-12 lg:block"
      style="margin-top: 1rem;" @mouseover="$emit('mouseover')" @mouseleave="$emit('mouseleave')">
      <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
          <category-card v-for="(category, index) in categories" 
            :key="index"
            :category="category"
            :is-dark-mode="isDarkMode"
          />
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
import CategoryCard from './CategoryCard.vue';

defineProps({
  isDarkMode: Boolean
});

const categories = [
  { name: 'Fashion', image: 'category-1.png' },
  { name: 'Plants', image: 'category-2.png' },
  { name: 'Cosmetics', image: 'category-3.png' },
  { name: 'Gadgets', image: 'category-4.png' },
  { name: 'Pets', image: 'category-5.png' }
];

defineEmits(['mouseover', 'mouseleave']);
</script> 