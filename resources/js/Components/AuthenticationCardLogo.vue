<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link :href="'/'">
    <div class="flex flex-col items-center gap-3">
        <svg class="w-16 h-16" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Cercle extérieur -->
            <circle cx="20" cy="20" r="18.5" class="stroke-gray-900 dark:stroke-white transition-colors duration-300"
                stroke-width="2.5" />

            <!-- Aiguille de la boussole -->
            <g transform="translate(20 20)">
                <path d="M0 -13L4 0L-4 0Z" class="fill-gray-900 dark:fill-white transition-colors duration-300" />
                <path d="M0 13L3 0L-3 0Z" class="fill-gray-700 dark:fill-gray-300 transition-colors duration-300" />
            </g>

            <!-- Point central -->
            <circle cx="20" cy="20" r="2" class="fill-gray-900 dark:fill-white transition-colors duration-300" />

            <!-- Lignes de repère -->
            <path d="M20 4L20 7" class="stroke-gray-900 dark:stroke-white" stroke-width="2" />
            <path d="M20 33L20 36" class="stroke-gray-900 dark:stroke-white" stroke-width="2" />
            <path d="M33 20L36 20" class="stroke-gray-900 dark:stroke-white" stroke-width="2" />
            <path d="M4 20L7 20" class="stroke-gray-900 dark:stroke-white" stroke-width="2" />

            <!-- Cercle intérieur -->
            <circle cx="20" cy="20" r="15" class="stroke-gray-900 dark:stroke-white transition-colors duration-300"
                stroke-width="0.5" />
        </svg>

        <div class="flex flex-col items-center">
            <span class="text-2xl font-bold text-gray-900 dark:text-white transition-colors duration-300">
                Studio Webspark
            </span>
            <span class="text-sm text-gray-600 dark:text-gray-300 transition-colors duration-300">
                Agence Web
            </span>
        </div>
    </div>
    </Link>
</template>

<style scoped>
/* Effet hover plus subtil */
svg:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease-in-out;
}

svg {
    transition: transform 0.3s ease-in-out;
}

svg:hover circle,
svg:hover path {
    stroke-opacity: 0.9;
    fill-opacity: 0.9;
}
</style>
