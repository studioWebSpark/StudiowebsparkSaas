<template>
    <header class="relative">
        <nav-bar :is-dark-mode="isDarkMode" :is-menu-open="isMenuOpen" :is-mobile="true"
            @toggle-dark-mode="$emit('toggle-dark-mode')" @toggle-menu="$emit('toggle-menu')"
            @toggle-categories="$emit('toggle-categories')" />

        <!-- Menu des catégories -->
        <categories-menu v-if="showCategories" :is-dark-mode="isDarkMode" @mouseover="$emit('show-categories')"
            @mouseleave="$emit('hide-categories')" />
    </header>
</template>

<script setup>
import NavBar from './NavBar.vue';
import CategoriesMenu from './CategoriesMenu.vue';

defineProps({
    isDarkMode: Boolean,
    isMenuOpen: Boolean,
    showCategories: Boolean
});

defineEmits(['toggle-dark-mode', 'toggle-menu', 'toggle-categories', 'show-categories', 'hide-categories']);
</script>