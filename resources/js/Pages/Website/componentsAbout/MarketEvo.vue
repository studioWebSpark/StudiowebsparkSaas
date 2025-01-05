<template>
    <section class="py-10 sm:py-16 lg:py-24 relative">
        <!-- Fond avec motif -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8 relative">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">
                    Un Marché en Evolution
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-8 mt-10 text-center lg:mt-24 sm:gap-x-8 md:grid-cols-3">
                <div
                    class="transform transition-all duration-300 hover:scale-105 p-6 rounded-[32px] bg-blue-500/20 backdrop-blur-sm">
                    <h3 class="font-bold text-7xl">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-600 to-blue-600">
                            92%
                        </span>
                    </h3>
                    <p class="mt-4 text-xl font-medium text-white">
                        des consommateurs recherchent les entreprises en ligne avant tout achat
                    </p>
                    <p class="mt-2 text-sm text-white/70">
                        Source: Hubspot, 2024
                    </p>
                </div>

                <div
                    class="transform transition-all duration-300 hover:scale-105 p-6 rounded-[32px] bg-blue-500/20 backdrop-blur-sm">
                    <h3 class="font-bold text-7xl">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-600 to-blue-600">
                            67%
                        </span>
                    </h3>
                    <p class="mt-4 text-xl font-medium text-white">
                        des PME considèrent leur site web comme crucial pour leur croissance
                    </p>
                    <p class="mt-2 text-sm text-white/70">
                        Source: Deloitte Digital, 2024
                    </p>
                </div>

                <div
                    class="transform transition-all duration-300 hover:scale-105 p-6 rounded-[32px] bg-blue-500/20 backdrop-blur-sm">
                    <h3 class="font-bold text-7xl">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-600 to-blue-600">
                            2.3s
                        </span>
                    </h3>
                    <p class="mt-4 text-xl font-medium text-white">
                        temps de chargement maximum attendu par les utilisateurs
                    </p>
                    <p class="mt-2 text-sm text-white/70">
                        Source: Google Page Experience, 2024
                    </p>
                </div>
            </div>

            <h2 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl mt-20 text-center">
                Notre solution vous permet de vous démarquer rapidement et efficacement.
            </h2>
        </div>
    </section>
</template>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
