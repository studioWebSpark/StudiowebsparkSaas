<template>
    <div :class="{ 'dark': isDarkMode }" class="overflow-x-hidden bg-gray-50 dark:bg-gray-900">
        <header class="relative">
            <div :class="{ 'bg-gray-50': !isDarkMode, 'bg-gray-900': isDarkMode }" class="border-b border-gray-200">
                <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                    <div class="flex justify-between h-16 lg:h-[72px]">
                        <div class="flex items-center flex-shrink-0 -m-1">
                            <a href="#" title="" class="flex">
                                <span class="sr-only"> Rareblocks logo </span>
                                <img class="w-auto h-8"
                                    src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/logo.svg"
                                    alt="" />
                            </a>
                        </div>

                        <div class="hidden lg:flex lg:justify-start lg:ml-16 lg:space-x-8 xl:space-x-14">
                            <a href="/home" title="accueil"
                                class="inline-flex items-center font-sans text-sm font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base hover:border-gray-900 focus:outline-none focus:border-gray-900"
                                :class="{ 'text-gray-900 dark:text-white': !isDarkMode, 'text-white': isDarkMode }">Home</a>
                            <a href="/about" title="à propos"
                                class="inline-flex items-center font-sans text-sm font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base hover:border-gray-900 focus:outline-none focus:border-gray-900"
                                :class="{ 'text-gray-900 dark:text-white': !isDarkMode, 'text-white': isDarkMode }">À
                                propos</a>

                            <a href="#" title="services"
                                class="inline-flex items-center font-sans text-sm font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base hover:border-gray-900 focus:outline-none focus:border-gray-900"
                                :class="{ 'text-gray-900': !isDarkMode, 'text-white': isDarkMode }"
                                @click.prevent="toggleCategories">Nos Services</a>
                            <a href="/tarifs" title="tarifs"
                                class="inline-flex items-center font-sans text-sm font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base hover:border-gray-900 focus:outline-none focus:border-gray-900"
                                :class="{ 'text-gray-900 dark:text-white': !isDarkMode, 'text-white': isDarkMode }">Tarifs</a>

                        </div>

                        <div class="flex items-center justify-end ml-2 space-x-4 ">
                            <button type="button"
                                :class="['p-2 -m-2 transition-all duration-200 lg:hidden', isDarkMode ? 'hover:text-gray-300 text-white' : 'hover:text-gray-700 text-gray-900']"
                                @click="toggleMenu">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <button @click="toggleDarkMode" class="text-gray-900 dark:text-white">
                                <i v-if="!isDarkMode" class='bx bx-sun text-yellow-500 text-3xl'></i>
                                <i v-else class='bx bxs-moon text-3xl'></i>
                            </button>



                            <template v-if="$page.props.auth.user">
                                <div class="flex items-center">
                                    <a href="/dashboard" title="Dashboard"
                                        class="hidden sm:inline-flex items-center font-sans text-sm font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base hover:border-gray-900 focus:outline-none focus:border-gray-900"
                                        :class="{ 'text-gray-900 dark:text-white': !isDarkMode, 'text-white': isDarkMode }">
                                        Dashboard
                                    </a>
                                </div>
                            </template>
                            <template v-else>
                                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                                    <a href="/login" title="se connecter"
                                        class="inline-flex items-center font-sans text-sm font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base hover:border-gray-900 focus:outline-none focus:border-gray-900"
                                        :class="{ 'text-gray-900 dark:text-white': !isDarkMode, 'text-white': isDarkMode }">Se
                                        connecter</a>
                                    <a href="/register" title=""
                                        class="inline-flex items-center justify-center px-6 py-3 text-base font-bold leading-7 text-white transition-all duration-200 bg-gray-900 border border-transparent rounded-xl hover:bg-gray-600 font-pj focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
                                        role="button">
                                        Créer un compte
                                    </a>
                                </div>
                            </template>


                        </div>
                    </div>
                </div>
            </div>

            <transition name="fade" enter-active-class="transition-opacity duration-200"
                leave-active-class="transition-opacity duration-200" enter-class="opacity-0"
                enter-to-class="opacity-100" leave-class="opacity-100" leave-to-class="opacity-0">
                <div v-if="showCategories" :class="{ 'bg-white': !isDarkMode, 'bg-gray-800': isDarkMode }"
                    class="py-12 lg:block" style="margin-top: 1rem;" @mouseover="showCategories = true"
                    @mouseleave="hideCategories">
                    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                            <div class="relative overflow-hidden rounded-lg group">
                                <div>
                                    <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
                                        src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/category-1.png"
                                        alt="aa" />
                                </div>
                                <div class="absolute inset-x-0 bottom-0">
                                    <div class="px-4 py-3 xl:px-5 xl:py-4">
                                        <p class="text-base font-bold text-gray-900 dark:text-white xl:text-lg">Fashion
                                        </p>
                                    </div>
                                </div>
                                <a href="#" title="" class="">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </div>

                            <div class="relative overflow-hidden rounded-lg group">
                                <div>
                                    <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
                                        src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/category-2.png"
                                        alt="" />
                                </div>
                                <div class="absolute inset-x-0 bottom-0">
                                    <div class="px-4 py-3 xl:px-5 xl:py-4">
                                        <p class="text-base font-bold text-gray-900 dark:text-white xl:text-lg">Plants
                                        </p>
                                    </div>
                                </div>
                                <a href="#" title="" class="">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </div>

                            <div class="relative overflow-hidden rounded-lg group">
                                <div>
                                    <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
                                        src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/category-3.png"
                                        alt="" />
                                </div>
                                <div class="absolute inset-x-0 bottom-0">
                                    <div class="px-4 py-3 xl:px-5 xl:py-4">
                                        <p class="text-base font-bold text-gray-900 dark:text-white xl:text-lg">
                                            Cosmetics</p>
                                    </div>
                                </div>
                                <a href="#" title="" class="">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </div>

                            <div class="relative overflow-hidden rounded-lg group">
                                <div>
                                    <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
                                        src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/category-4.png"
                                        alt="" />
                                </div>
                                <div class="absolute inset-x-0 bottom-0">
                                    <div class="px-4 py-3 xl:px-5 xl:py-4">
                                        <p class="text-base font-bold text-gray-900 dark:text-white xl:text-lg">Gadgets
                                        </p>
                                    </div>
                                </div>
                                <a href="#" title="" class="">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </div>

                            <div class="relative overflow-hidden rounded-lg group">
                                <div>
                                    <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
                                        src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/category-5.png"
                                        alt="" />
                                </div>
                                <div class="absolute inset-x-0 bottom-0">
                                    <div class="px-4 py-3 xl:px-5 xl:py-4">
                                        <p class="text-base font-bold text-gray-900 dark:text-white xl:text-lg">Pets</p>
                                    </div>
                                </div>
                                <a href="#" title="" class="">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </transition>

            <div v-if="isMenuOpen" :class="{ 'bg-gray-800': isDarkMode, 'bg-white': !isDarkMode }"
                class="py-8 lg:hidden">
                <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                    <div class="flex items-center justify-between">

                        <button type="button"
                            class="p-2 -m-2 text-gray-500 transition-all duration-200 bg-transparent rounded-md hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
                            @click="toggleMenu">

                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <button v-if="isMobile" @click="toggleDarkMode" class="text-gray-900 dark:text-white">
                            <i v-if="!isDarkMode" class='bx bx-sun text-yellow-500 text-3xl'></i>
                            <i v-else class='bx bxs-moon text-3xl'></i>
                        </button>
                    </div>

                    <div class="mt-8 space-y-5">
                        <div>
                            <a href="/home" title="accueil"
                                :class="['inline-flex items-center text-base font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base', isDarkMode ? 'text-white hover:border-gray-400' : 'text-gray-900 hover:border-gray-900']">Home</a>
                        </div>

                        <div>
                            <a href="/about" title="à propos"
                                :class="['inline-flex items-center text-base font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base hover:border-gray-900 focus:outline-none focus:border-gray-900', isDarkMode ? 'text-white hover:border-gray-400' : 'text-gray-900 hover:border-gray-900']">À
                                propos</a>
                        </div>

                        <div>
                            <a href="#" title="services"
                                :class="['inline-flex items-center text-base font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base hover:border-gray-900 focus:outline-none focus:border-gray-900', isDarkMode ? 'text-white hover:border-gray-400' : 'text-gray-900 hover:border-gray-900']">
                                <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                    </path>
                                </svg>
                                Nos Services
                            </a>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-4 sm:grid-cols-3">
                            <div class="relative overflow-hidden rounded-lg group">
                                <div>
                                    <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
                                        src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/category-1.png"
                                        alt="" />
                                </div>
                                <div class="absolute inset-x-0 bottom-0">
                                    <div class="px-4 py-3">
                                        <p class="text-xs font-bold text-gray-900 sm:text-base">Fashion</p>
                                    </div>
                                </div>
                                <a href="#" title="" class="">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </div>

                            <div class="relative overflow-hidden rounded-lg group">
                                <div>
                                    <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
                                        src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/category-2.png"
                                        alt="" />
                                </div>
                                <div class="absolute inset-x-0 bottom-0">
                                    <div class="px-4 py-3">
                                        <p class="text-xs font-bold text-gray-900 sm:text-base">Plants</p>
                                    </div>
                                </div>
                                <a href="#" title="" class="">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </div>

                            <div class="relative overflow-hidden rounded-lg group">
                                <div>
                                    <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
                                        src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/category-3.png"
                                        alt="" />
                                </div>
                                <div class="absolute inset-x-0 bottom-0">
                                    <div class="px-4 py-3">
                                        <p class="text-xs font-bold text-gray-900 sm:text-base">Cosmetics</p>
                                    </div>
                                </div>
                                <a href="#" title="" class="">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </div>

                            <div class="relative overflow-hidden rounded-lg group">
                                <div>
                                    <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
                                        src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/category-4.png"
                                        alt="" />
                                </div>
                                <div class="absolute inset-x-0 bottom-0">
                                    <div class="px-4 py-3">
                                        <p class="text-xs font-bold text-gray-900 sm:text-base">Gadgets</p>
                                    </div>
                                </div>
                                <a href="#" title="" class="">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </div>

                            <div class="relative overflow-hidden rounded-lg group">
                                <div>
                                    <img class="object-cover w-full h-full transition-all duration-300 group-hover:-rotate-3 group-hover:scale-125"
                                        src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/navigation/3/category-5.png"
                                        alt="" />
                                </div>
                                <div class="absolute inset-x-0 bottom-0">
                                    <div class="px-4 py-3">
                                        <p class="text-xs font-bold text-gray-900 sm:text-base">Pets</p>
                                    </div>
                                </div>
                                <a href="#" title="" class="">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                        <div>
                            <a href="/tarifs" title=""
                                :class="['inline-flex items-center text-base font-medium transition-all duration-200 border-b-2 border-transparent xl:text-base hover:border-gray-900 focus:outline-none focus:border-gray-900', isDarkMode ? 'text-white hover:border-gray-400' : 'text-gray-900 hover:border-gray-900']">Tarifs</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const isDarkMode = ref(false);
const isMenuOpen = ref(false);
const showCategories = ref(false);

function toggleDarkMode() {
    isDarkMode.value = !isDarkMode.value;
}

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value;
}

function toggleCategories() {
    showCategories.value = !showCategories.value;
}

function hideCategories() {
    showCategories.value = false;
}
</script>
