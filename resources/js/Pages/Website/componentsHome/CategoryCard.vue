<template>
  <div class="relative overflow-hidden rounded-lg group">
    <div>
      <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
        :src="`https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/${category.image}`"
        :alt="category.name" />
    </div>
    <div class="absolute inset-x-0 bottom-0">
      <div class="px-4 py-3 xl:px-5 xl:py-4">
        <p class="text-base font-bold text-gray-900 dark:text-white xl:text-lg">{{ category.name }}</p>
      </div>
    </div>
    <a href="#" title="" class="">
      <span class="absolute inset-0" aria-hidden="true"></span>
    </a>
  </div>
</template>

<script setup>
defineProps({
  category: Object,
  isDarkMode: Boolean
});
</script> 