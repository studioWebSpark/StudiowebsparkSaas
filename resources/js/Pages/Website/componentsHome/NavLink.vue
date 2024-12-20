<template>
  <a :href="href" :title="title"
    class="inline-flex items-center font-sans text-sm font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base hover:border-gray-900 focus:outline-none focus:border-gray-900"
    :class="{ 'text-gray-900 dark:text-white': !isDarkMode, 'text-white': isDarkMode }">
    <slot></slot>
  </a>
</template>

<script setup>
defineProps({
  href: String,
  title: String,
  isDarkMode: Boolean
});
</script> 