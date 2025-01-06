<template>
  <div class="mb-36">
    <!-- Navbar principale avec effet "pill" -->
    <div class="fixed w-full top-4 z-50 px-4 mb-20">
      <div class="max-w-7xl mx-auto">
        <!-- Ajout des classes pour le style "pill" tout en gardant la structure existante -->
        <div :class="{
          'bg-white/90 dark:bg-gray-900/90': !isDarkMode,
          'bg-gray-900/90': isDarkMode
        }" class="backdrop-blur-lg rounded-full border border-gray-200/20 shadow-lg">
          <!-- Le reste de la structure de la navbar reste identique -->
          <div class="px-6 mx-auto">
            <div class="flex justify-between h-16 lg:h-[72px]">
              <!-- Logo -->
              <div class="flex items-center flex-shrink-0 -m-1">
                <a href="/" title="" class="flex items-center gap-3">
                  <span class="sr-only">StudioWebSpark-logo</span>
                  <svg class="w-auto h-10" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Cercle extérieur -->
                    <circle cx="20" cy="20" r="18.5" stroke="#111827" stroke-width="2.5"
                      class="transition-all duration-300 ease-in-out" />

                    <!-- Aiguille de la boussole -->
                    <g transform="translate(20 20)">
                      <!-- Flèche Nord -->
                      <path d="M0 -13L4 0L-4 0Z" fill="#111827" class="transition-all duration-300 ease-in-out" />
                      <!-- Flèche Sud -->
                      <path d="M0 13L3 0L-3 0Z" fill="#374151" class="transition-all duration-300 ease-in-out" />
                    </g>

                    <!-- Point central -->
                    <circle cx="20" cy="20" r="2" fill="#111827" class="transition-all duration-300 ease-in-out" />

                    <!-- Lignes de repère -->
                    <path d="M20 4L20 7" stroke="#111827" stroke-width="2" />
                    <path d="M20 33L20 36" stroke="#111827" stroke-width="2" />
                    <path d="M33 20L36 20" stroke="#111827" stroke-width="2" />
                    <path d="M4 20L7 20" stroke="#111827" stroke-width="2" />

                    <!-- Cercle intérieur -->
                    <circle cx="20" cy="20" r="15" stroke="#111827" stroke-width="0.5"
                      class="transition-all duration-300 ease-in-out" />
                  </svg>

                  <!-- Ajout du titre -->
                  <div class="flex flex-col">
                    <span class="text-lg font-bold text-gray-900 dark:text-white transition-colors duration-300">
                      Studio Webspark
                    </span>
                    <span class="text-xs text-gray-600 dark:text-gray-300 transition-colors duration-300">
                      Agence Web
                    </span>
                  </div>
                </a>
              </div>

              <!-- Navigation Desktop -->
              <div class="hidden lg:flex lg:justify-start lg:ml-16 lg:space-x-8 xl:space-x-14">
                <nav-link href="/home" title="accueil">Home</nav-link>
                <nav-link href="/about" title="à propos">À propos</nav-link>
                <nav-link href="#" title="services" @click.prevent="$emit('toggle-categories')">Nos Services</nav-link>
                <nav-link href="/tarifs" title="tarifs">Tarifs</nav-link>
                <nav-link href="/support" title="tarifs">Support</nav-link>
              </div>

              <!-- Right Side Menu -->
              <div class="flex items-center justify-end ml-2 space-x-4">
                <!-- Mobile Menu Button -->
                <button type="button"
                  :class="['p-2 -m-2 transition-all duration-200 lg:hidden', isDarkMode ? 'hover:text-gray-300 text-white' : 'hover:text-gray-700 text-gray-900']"
                  @click="toggleMenu">
                  <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  </svg>
                </button>

                <!-- Dark Mode Toggle -->
                <button @click="$emit('toggle-dark-mode')" class="text-gray-900 dark:text-white">
                  <i v-if="!isDarkMode" class='bx bx-sun text-yellow-500 text-3xl'></i>
                  <i v-else class='bx bxs-moon text-3xl'></i>
                </button>

                <!-- Auth Links - Desktop Only -->
                <div class="hidden lg:flex items-center space-x-4">
                  <template v-if="$page.props.auth.user">
                    <nav-link href="/dashboard" title="Dashboard">Dashboard</nav-link>
                  </template>
                  <template v-else>
                    <nav-link href="/login" title="se connecter">Se connecter</nav-link>
                    <a href="/register" title=""
                      class="inline-flex items-center justify-center px-6 py-3 text-base font-bold leading-7 text-white transition-all duration-200 bg-gray-900 border border-transparent rounded-xl hover:bg-gray-600 font-pj focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
                      role="button">
                      Créer un compte
                    </a>
                  </template>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Menu mobile - Garder la structure existante mais adapter le style -->
    <transition enter-active-class="transition-opacity ease-linear duration-300" enter-from-class="opacity-0"
      enter-to-class="opacity-100" leave-active-class="transition-opacity ease-linear duration-300"
      leave-from-class="opacity-100" leave-to-class="opacity-0">
      <div v-if="isMenuOpen" class="fixed inset-x-4 top-24 z-50 lg:hidden">
        <div :class="{
          'bg-white/90 dark:bg-gray-900/90': !isDarkMode,
          'bg-gray-900/90': isDarkMode
        }" class="rounded-2xl backdrop-blur-lg border border-gray-200/20 shadow-lg p-6">
          <!-- Contenu du menu mobile existant inchangé -->
          <div class="flex items-center justify-between p-4 border-b"
            :class="{ 'border-gray-700': isDarkMode, 'border-gray-200': !isDarkMode }">
            <img class="w-auto h-8" src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/logo.svg"
              alt="" />
            <button @click="toggleMenu" class="p-2" :class="{ 'text-white': isDarkMode, 'text-gray-500': !isDarkMode }">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Menu principal -->
          <nav class="flex-1 overflow-y-auto">
            <ul class="px-4 py-6 space-y-4">
              <li>
                <nav-link href="/home" title="accueil" class="block py-3 text-lg font-medium border-b" :class="{
                  'text-white border-gray-700': isDarkMode,
                  'text-gray-900 border-gray-200': !isDarkMode
                }">
                  Home
                </nav-link>
              </li>
              <li>
                <nav-link href="/about" title="à propos" class="block py-3 text-lg font-medium border-b" :class="{
                  'text-white border-gray-700': isDarkMode,
                  'text-gray-900 border-gray-200': !isDarkMode
                }">
                  À propos
                </nav-link>
              </li>
              <li>
                <nav-link href="#" title="services" class="block py-3 text-lg font-medium border-b" :class="{
                  'text-white border-gray-700': isDarkMode,
                  'text-gray-900 border-gray-200': !isDarkMode
                }" @click.prevent="$emit('toggle-categories')">
                  Nos Services
                </nav-link>
              </li>
              <li>
                <nav-link href="/tarifs" title="tarifs" class="block py-3 text-lg font-medium border-b" :class="{
                  'text-white border-gray-700': isDarkMode,
                  'text-gray-900 border-gray-200': !isDarkMode
                }">
                  Tarifs
                </nav-link>
              </li>

              <!-- Auth Links intégrés dans la liste principale -->
              <template v-if="$page.props.auth.user">
                <li>
                  <nav-link href="/dashboard" title="Dashboard" class="block py-3 text-lg font-medium border-b"
                    :class="{ 'text-white border-gray-700': isDarkMode, 'text-gray-900 border-gray-200': !isDarkMode }">
                    Dashboard
                  </nav-link>
                </li>
              </template>
              <template v-else>
                <li>
                  <nav-link href="/login" title="se connecter" class="block py-3 text-lg font-medium border-b"
                    :class="{ 'text-white border-gray-700': isDarkMode, 'text-gray-900 border-gray-200': !isDarkMode }">
                    Se connecter
                  </nav-link>
                </li>
                <li>
                  <a href="/register"
                    class="block py-3 text-lg font-medium text-center text-white bg-gray-900 rounded-xl hover:bg-gray-600 transition-all duration-200"
                    role="button">
                    Créer un compte
                  </a>
                </li>
              </template>
            </ul>
          </nav>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import NavLink from './NavLink.vue';

defineProps({
  isDarkMode: Boolean,
  isMenuOpen: Boolean,
  isMobile: Boolean
});

const emit = defineEmits(['toggle-dark-mode', 'toggle-menu', 'toggle-categories']);

const toggleMenu = () => {
  emit('toggle-menu');
};
</script>