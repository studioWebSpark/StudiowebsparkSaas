<template>
    <section class="py-12 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">
                Nous Contacter
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Chat -->
                <div class="text-center p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <i class='bx bx-message-dots text-4xl text-indigo-600'></i>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Chat en direct</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        Disponible 24/7 pour une assistance immédiate
                    </p>
                    <button class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Démarrer le chat
                    </button>
                </div>

                <!-- Email -->
                <div class="text-center p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <i class='bx bx-envelope text-4xl text-indigo-600'></i>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Email</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        Réponse sous 24h ouvrées
                    </p>
                    <a href="mailto:support@studiowebspark.com" 
                        class="mt-4 inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Envoyer un email
                    </a>
                </div>

                <!-- Téléphone -->
                <div class="text-center p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <i class='bx bx-phone text-4xl text-indigo-600'></i>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Téléphone</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        Lun-Ven, 9h-18h
                    </p>
                    <a href="tel:+33123456789" 
                        class="mt-4 inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Appeler
                    </a>
                </div>
            </div>
        </div>
    </section>
</template> 