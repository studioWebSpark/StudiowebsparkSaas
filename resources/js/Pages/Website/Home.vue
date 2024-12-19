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

        <section class="relative py-12 sm:py-16 lg:pt-20 xl:pb-0  dark:bg-gray-900">
            <div class="relative px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                <div class="max-w-3xl mx-auto text-center">
                    <p
                        class="inline-flex px-4 py-2 text-base text-gray-900 border border-gray-200 rounded-full font-pj dark:text-white dark:border-gray-700">
                        Fait par des développeurs, pour des développeurs</p>
                    <h1
                        class="mt-5 text-4xl font-bold leading-tight text-gray-900 sm:text-5xl sm:leading-tight lg:text-6xl lg:leading-tight font-pj dark:text-white">
                        Ressources de qualité partagées par la communauté</h1>
                    <p class="max-w-md mx-auto mt-6 text-base leading-7 text-gray-600 font-inter dark:text-gray-400">
                        Lorem ipsum dolor sit
                        amet, consectetur adipiscing elit. Vehicula massa in enim luctus. Rutrum arcu.</p>

                    <div class="relative inline-flex mt-10 group">
                        <div
                            class="absolute transition-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-[#44BCFF] via-[#FF44EC] to-[#FF675E] rounded-xl blur-lg group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200 animate-tilt">
                        </div>

                        <a href="#" title=""
                            class="relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-gray-900 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 dark:bg-gray-800 dark:text-white"
                            role="button">
                            Accédez à 4 958 ressources
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-16 md:mt-20">
                <img class="object-cover object-top w-full h-auto mx-auto scale-150 2xl:max-w-screen-2xl xl:scale-100"
                    src="https://d33wubrfki0l68.cloudfront.net/54780decfb9574945bc873b582cdc6156144a2ba/d9fa1/images/hero/4/illustration.png"
                    alt="" />
            </div>
        </section>

        <section class="py-12 bg-white sm:py-16 lg:py-20 dark:bg-gray-800">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="xl:flex xl:items-center xl:justify-between">
                    <h2 class="text-xl font-bold text-center text-gray-400 xl:text-left font-pj dark:text-gray-200">
                        1000+ Grandes marques nous
                        font confiance
                    </h2>

                    <div
                        class="grid items-center grid-cols-1 mt-10 gap-y-6 xl:mt-0 sm:grid-cols-2 sm:gap-y-8 lg:grid-cols-4 lg:gap-x-8">
                        <img class="object-contain w-auto mx-auto h-9"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/brands/1/logo-vertex.svg"
                            alt="" />
                        <img class="object-contain w-auto mx-auto h-9"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/brands/1/logo-squarestone.svg"
                            alt="" />
                        <img class="object-contain w-auto mx-auto h-9"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/brands/1/logo-martino.svg"
                            alt="" />
                        <img class="object-contain w-auto mx-auto h-9"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/brands/1/logo-waverio.svg"
                            alt="" />
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 bg-gray-50 sm:py-16 lg:py-20 dark:bg-gray-900">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="max-w-2xl mx-auto text-center">
                    <p class="text-lg font-medium text-gray-600 font-pj dark:text-gray-400">Créez n'importe quelle page
                        en 3 étapes simples</p>
                    <h2 class="mt-4 text-3xl font-bold text-gray-900 sm:text-4xl xl:text-5xl font-pj dark:text-white">
                        Découvrez Rareblocks,
                        le
                        kit UI le plus rare et le plus beau</h2>
                </div>

                <div
                    class="grid grid-cols-1 mt-10 text-center md:mt-20 md:max-w-full sm:max-w-sm sm:mx-auto gap-y-10 md:grid-cols-3 md:gap-x-6 lg:gap-x-16 md:text-left">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 font-pj dark:text-white">Suivez vos clients <br
                                class="hidden xl:block" />directement depuis le site web</h3>
                        <p class="mt-4 text-base leading-7 text-gray-900 font-pj dark:text-gray-300">Créez des pages
                            d'atterrissage avec
                            Rareblocks qui
                            convertissent davantage.</p>

                        <img class="object-cover w-full mx-auto mt-10 rounded-xl md:mx-0"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/features-v2/3/feature.png"
                            alt="" />
                        <p class="text-base leading-7 text-gray-700 mt-7 font-pj dark:text-gray-400">Consectetur adipis
                            cing elit. Mattis a,
                            tincidunt pulvinar sodales. Quis tellus vel eget in nulla odio. Tellus pharetra sit
                            convallis
                            vel, fermentum dignissim cras in.</p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 font-pj dark:text-white">Comprenez mieux les ventes
                            <br class="hidden xl:block" />performances
                        </h3>
                        <p class="mt-4 text-base leading-7 text-gray-900 font-pj dark:text-gray-300">Créez des pages
                            d'atterrissage avec
                            Rareblocks qui
                            convertissent davantage.</p>

                        <img class="object-cover w-full mx-auto mt-10 rounded-xl md:mx-0"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/features-v2/3/feature2.png"
                            alt="" />
                        <p class="text-base leading-7 text-gray-700 mt-7 font-pj dark:text-gray-400">Lorem ipsum dolor
                            sit amet, consectetur
                            adipis cing elit. Mattis a, tincidunt pulvinar sodales. Quis tellus vel eget in nulla odio.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 font-pj dark:text-white">Recevez des retours en
                            direct & <br class="hidden xl:block" />apportez des améliorations</h3>
                        <p class="mt-4 text-base leading-7 text-gray-900 font-pj dark:text-gray-300">Créez des pages
                            d'atterrissage avec
                            Rareblocks qui
                            convertissent davantage.</p>

                        <img class="object-cover w-full mx-auto mt-10 md:mx-0 rounded-xl"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/features-v2/3/feature3.png"
                            alt="" />
                        <p class="text-base leading-7 text-gray-700 mt-7 font-pj dark:text-gray-400">Mattis a, tincidunt
                            pulvinar sodales. Quis
                            tellus vel eget in nulla odio. Tellus pharetra sit convallis vel, fermentum dignissim cras
                            in.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 bg-gray-50 sm:py-16 lg:py-20 dark:bg-gray-900">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:items-center gap-y-8 md:grid-cols-2 md:gap-x-16">
                    <div>
                        <img class="w-full max-w-sm mx-auto"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/features-v2/5/illustration.png"
                            alt="" />
                    </div>

                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl xl:text-5xl font-pj dark:text-white">
                            Comprenez mieux les
                            ventes
                            performances</h2>
                        <p class="mt-4 text-base leading-7 text-gray-900 sm:mt-8 font-pj dark:text-gray-300">Créez des
                            pages d'atterrissage
                            personnalisées avec
                            Rareblocks qui convertissent plus de visiteurs que n'importe quel site web. Avec de nombreux
                            blocs uniques, vous pouvez
                            facilement construire une page.</p>

                        <svg class="w-auto h-4 mt-8 text-gray-300 sm:mt-10" viewBox="0 0 172 16" fill="none"
                            stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 11 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 46 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 81 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 116 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 151 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 18 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 53 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 88 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 123 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 158 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 25 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 60 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 95 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 130 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 165 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 32 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 67 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 102 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 137 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 172 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 39 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 74 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 109 1)" />
                            <line y1="-0.5" x2="18.0278" y2="-0.5"
                                transform="matrix(-0.5547 0.83205 0.83205 0.5547 144 1)" />
                        </svg>

                        <ul class="mt-5 space-y-5 sm:mt-10">
                            <li class="flex items-center text-gray-900 dark:text-gray-300">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-3 text-lg font-bold font-pj"> 150+ Blocs UI codés à la main </span>
                            </li>

                            <li class="flex items-center text-gray-900 dark:text-gray-300">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-3 text-lg font-bold font-pj"> Entièrement réactif sur n'importe quel
                                    appareil </span>
                            </li>

                            <li class="flex items-center text-gray-900 dark:text-gray-300">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-3 text-lg font-bold font-pj"> Il suffit de copier et coller </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 bg-gray-50 sm:py-16 lg:py-20 dark:bg-gray-900">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:items-center gap-y-8 md:grid-cols-2 md:gap-x-16">
                    <div class="text-center md:text-left lg:pr-16">
                        <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl xl:text-5xl font-pj dark:text-white">
                            Laissez les visiteurs
                            vous aider
                            améliorer votre expérience utilisateur</h2>
                        <p class="mt-4 text-lg text-gray-700 sm:mt-8 font-pj dark:text-gray-400">Lorem ipsum dolor sit
                            amet, consectetur adipis
                            elit. Sit enim nec, proin faucibus nibh et sagittis a. Lacinia purus ac amet pellentesque
                            aliquam enim.</p>
                    </div>

                    <div>
                        <img class="w-full max-w-md mx-auto"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/features/1/illustration.png"
                            alt="" />
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 bg-white sm:py-16 lg:py-20 dark:bg-gray-800">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="max-w-xl px-8 mx-auto text-center md:px-0">
                    <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl xl:text-5xl font-pj dark:text-white">Prenez
                        la décision sage
                        pour
                        votre entreprise</h2>
                    <p class="mt-6 text-lg font-normal text-gray-600 font-pj dark:text-gray-400">Choisissez parmi nos 3
                        forfaits abordables</p>
                </div>

                <div
                    class="grid max-w-sm grid-cols-1 gap-6 mx-auto mt-8 text-center md:text-left md:mt-16 md:max-w-6xl md:grid-cols-3">
                    <div
                        class="overflow-hidden bg-white border border-gray-200 rounded-2xl dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 lg:px-10 lg:py-8">
                            <h3 class="text-lg font-bold text-gray-900 font-pj dark:text-white">Basique</h3>
                            <p class="mt-3 text-5xl font-bold text-gray-900 font-pj dark:text-white">$99</p>
                            <p class="mt-5 text-base font-normal leading-7 text-gray-600 font-pj dark:text-gray-400">
                                Idéal pour les
                                propriétaires de petites entreprises,
                                les startups qui ont besoin d'une page d'atterrissage pour leur entreprise.</p>
                            <a href="#" title=""
                                class="inline-flex items-center justify-center px-8 py-3.5 w-full mt-8 text-base font-bold text-gray-900 transition-all duration-200 border-2 border-gray-400 rounded-xl font-pj focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 hover:bg-gray-900 focus:bg-gray-900 hover:text-white focus:text-white hover:border-gray-900 focus:border-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-gray-900">
                                Commencer
                            </a>

                            <p class="mt-8 text-base font-bold text-gray-900 font-pj dark:text-white">Ce qui est inclus
                                :</p>
                            <ul class="mt-4 space-y-3 text-base font-medium text-gray-600 font-pj dark:text-gray-400">
                                <li>130+ Blocs codés</li>
                                <li>Idéal pour les développeurs, freelances</li>
                                <li>Fabriqué avec TailwindCSS</li>
                            </ul>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -inset-4">
                            <div class="w-full h-full mx-auto rotate-180 opacity-30 blur-lg filter"
                                style="background: linear-gradient(90deg, #44ff9a -0.55%, #44b0ff 22.86%, #8b44ff 48.36%, #ff6644 73.33%, #ebff70 99.34%)">
                            </div>
                        </div>

                        <div
                            class="relative overflow-hidden bg-gray-900 border border-gray-200 rounded-2xl dark:bg-gray-800 dark:border-gray-700">
                            <div class="p-6 lg:px-10 lg:py-8">
                                <h3 class="text-lg font-bold text-white font-pj">Premium</h3>
                                <p class="mt-3 text-5xl font-bold text-white font-pj">$199</p>
                                <p class="mt-5 text-base font-normal leading-7 text-gray-400 font-pj">Idéal pour les
                                    propriétaires de moyennes entreprises,
                                    les startups qui ont besoin d'une page d'atterrissage pour leur entreprise.</p>
                                <a href="#" title=""
                                    class="inline-flex items-center justify-center px-8 py-3.5 w-full mt-8 text-base font-bold text-gray-900 bg-white transition-all duration-200 border-2 border-transparent focus:ring-offset-gray-900 rounded-xl font-pj focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white hover:bg-opacity-90">
                                    Commencer
                                </a>

                                <p class="mt-8 text-base font-bold text-white font-pj">Ce qui est inclus :</p>
                                <ul class="mt-4 space-y-3 text-base font-medium text-gray-400 font-pj">
                                    <li>130+ Blocs codés</li>
                                    <li>Idéal pour les développeurs, freelances</li>
                                    <li>Fabriqué avec TailwindCSS</li>
                                    <li>Support Premium</li>
                                    <li>Mises à jour futures</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="overflow-hidden bg-white border border-gray-200 rounded-2xl dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 lg:px-10 lg:py-8">
                            <h3 class="text-lg font-bold text-gray-900 font-pj dark:text-white">Entreprise</h3>
                            <p class="mt-3 text-5xl font-bold text-gray-900 font-pj dark:text-white">$399</p>
                            <p class="mt-5 text-base font-normal leading-7 text-gray-600 font-pj dark:text-gray-400">
                                Idéal pour les grandes
                                entreprises,
                                les propriétaires d'entreprises qui ont besoin d'une page d'atterrissage pour leur
                                entreprise.</p>
                            <a href="#" title=""
                                class="inline-flex items-center justify-center px-8 py-3.5 w-full mt-8 text-base font-bold text-gray-900 transition-all duration-200 border-2 border-gray-400 rounded-xl font-pj focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 hover:bg-gray-900 focus:bg-gray-900 hover:text-white focus:text-white hover:border-gray-900 focus:border-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-gray-900">
                                Commencer
                            </a>

                            <p class="mt-8 text-base font-bold text-gray-900 font-pj dark:text-white">Ce qui est inclus
                                :</p>
                            <ul class="mt-4 space-y-3 text-base font-medium text-gray-600 font-pj dark:text-gray-400">
                                <li>130+ Blocs codés</li>
                                <li>Idéal pour les développeurs, freelances</li>
                                <li>Fabriqué avec TailwindCSS</li>
                                <li>Support Premium</li>
                                <li>Mises à jour futures</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="py-12 bg-white sm:pt-16 lg:pt-20 dark:bg-gray-800">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="max-w-2xl mx-auto text-center">
                    <h5 class="text-3xl font-bold text-gray-900 sm:text-4xl xl:text-5xl font-pj dark:text-white">
                        Contactez-nous, nous sommes
                        ouverts aux esprits créatifs et aux collaborations !</h5>

                    <div class="relative inline-flex mt-12 group">
                        <div class="absolute duration-1000 transform rotate-180 transition-all opacity-70 -inset-1 rounded-xl blur-lg filter group-hover:opacity-100 group-hover:-inset-1.5 group-hover:duration-200"
                            style="background: linear-gradient(90deg, #44ff9a -0.55%, #44b0ff 22.86%, #8b44ff 48.36%, #ff6644 73.33%, #ebff70 99.34%)">
                        </div>

                        <a href="#" title=""
                            class="relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-gray-900 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 dark:bg-gray-800"
                            role="button">
                            Obtenez Rareblocks
                        </a>
                    </div>
                </div>

                <div class="lg:flex lg:items-center lg:justify-between mt-14 lg:mt-24">
                    <div>
                        <img class="w-auto h-8 mx-auto lg:mx-0"
                            src="https://cdn.rareblocks.xyz/collection/clarity/images/logo.svg" alt="" />
                    </div>



                    <ul class="flex items-center justify-center mt-8 space-x-3 sm:mt-12 lg:justify-end lg:mt-0">
                        <li>
                            <a href="#" target="_blank" title=""
                                class="inline-flex items-center justify-center w-10 h-10 text-gray-900 transition-all duration-200 rounded-full hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 dark:text-white dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                rel="noopener">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                        d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z">
                                    </path>
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" target="_blank" title=""
                                class="inline-flex items-center justify-center w-10 h-10 text-gray-900 transition-all duration-200 rounded-full hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 dark:text-white dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                rel="noopener">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z">
                                    </path>
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="#" target="_blank" title=""
                                class="inline-flex items-center justify-center w-10 h-10 text-gray-900 transition-all duration-200 rounded-full hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 dark:text-white dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                rel="noopener">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z">
                                    </path>
                                    <circle cx="16.806" cy="7.207" r="1.078"></circle>
                                    <path
                                        d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <hr class="mt-10 border-gray-300 dark:border-gray-600" />

                <div class="mt-10 md:flex md:items-center md:justify-between">
                    <ul class="flex items-center justify-center space-x-6 md:order-2 md:justify-end">
                        <li>
                            <a href="#" title=""
                                class="text-base font-normal text-gray-600 transition-all duration-200 font-pj hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                Politique de confidentialité </a>
                        </li>

                        <li>
                            <a href="#" title=""
                                class="text-base font-normal text-gray-600 transition-all duration-200 font-pj hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                Conditions générales </a>
                        </li>
                    </ul>

                    <p
                        class="mt-8 text-base font-normal text-center text-gray-600 md:text-left md:mt-0 md:order-1 font-pj dark:text-gray-400">
                        © Copyright 2021, Tous droits réservés</p>
                </div>
            </div>
        </footer>
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



