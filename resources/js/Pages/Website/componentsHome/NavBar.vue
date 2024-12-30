<template>
  <div>
    <!-- Navbar principale -->
    <div :class="{ 'bg-gray-50': !isDarkMode, 'bg-gray-900': isDarkMode }" class="border-b border-gray-200">
      <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="flex justify-between h-16 lg:h-[72px]">
          <!-- Logo -->
          <div class="flex items-center flex-shrink-0 -m-1">
            <a href="#" title="" class="flex">
              <span class="sr-only">Rareblocks logo</span>
              <img class="w-auto h-8" src="https://cdn.rareblocks.xyz/collection/clarity-ecommerce/images/logo.svg"
                alt="" />
            </a>
          </div>

          <!-- Navigation Desktop -->
          <div class="hidden lg:flex lg:justify-start lg:ml-16 lg:space-x-8 xl:space-x-14">
            <nav-link href="/home" title="accueil">Home</nav-link>
            <nav-link href="/about" title="à propos">À propos</nav-link>
            <nav-link href="#" title="services" @click.prevent="$emit('toggle-categories')">Nos Services</nav-link>
            <nav-link href="/tarifs" title="tarifs">Tarifs</nav-link>
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

            <!-- Newsletter Subscription Button -->
            <button @click="openNewsletterModal"
              class="hidden lg:inline-flex items-center px-6 py-3 text-base font-bold leading-7 text-white transition-all duration-200 bg-green-600 border border-transparent rounded-xl hover:bg-green-700 font-pj focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
              <i class='bx bx-envelope mr-2'></i>
              Newsletter
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Menu mobile fullscreen -->
    <transition enter-active-class="transition-opacity ease-linear duration-300" enter-from-class="opacity-0"
      enter-to-class="opacity-100" leave-active-class="transition-opacity ease-linear duration-300"
      leave-from-class="opacity-100" leave-to-class="opacity-0">
      <div v-if="isMenuOpen" class="fixed inset-0 z-50 lg:hidden flex flex-col"
        :class="{ 'bg-gray-800': isDarkMode, 'bg-white': !isDarkMode }">

        <!-- En-tête avec logo et bouton fermer -->
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

            <!-- Newsletter Button - Mobile -->
            <li>
              <button @click="openNewsletterModal"
                class="w-full py-3 text-lg font-medium text-center text-white bg-green-600 rounded-xl hover:bg-green-700 transition-all duration-200">
                <i class='bx bx-envelope mr-2'></i>
                Newsletter
              </button>
            </li>
          </ul>
        </nav>
      </div>
    </transition>

    <!-- Newsletter Modal -->
    <transition enter-active-class="transition-opacity ease-linear duration-300" enter-from-class="opacity-0"
      enter-to-class="opacity-100" leave-active-class="transition-opacity ease-linear duration-300"
      leave-from-class="opacity-100" leave-to-class="opacity-0">
      <div v-if="showNewsletterModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl max-w-md w-full mx-4">
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">Newsletter</h3>
            <button @click="showNewsletterModal = false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <form @submit.prevent="subscribeToNewsletter" class="space-y-4">
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
              <input type="email" id="email" v-model="newsletterEmail" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
            </div>
            <button type="submit"
              class="w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
              S'inscrire
              <i class='bx bx-right-arrow-alt ml-2'></i>
            </button>
          </form>
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
const showNewsletterModal = ref(false);
const newsletterEmail = ref('');

const toggleMenu = () => {
  emit('toggle-menu');
};

const openNewsletterModal = () => {
  showNewsletterModal.value = true;
};

const subscribeToNewsletter = async () => {
  try {
    // Ici, ajoutez la logique pour envoyer l'email à votre backend
    console.log('Email inscrit:', newsletterEmail.value);
    showNewsletterModal.value = false;
    newsletterEmail.value = '';
    // Ajouter une notification de succès
  } catch (error) {
    console.error('Erreur lors de l\'inscription:', error);
    // Ajouter une notification d'erreur
  }
};
</script>