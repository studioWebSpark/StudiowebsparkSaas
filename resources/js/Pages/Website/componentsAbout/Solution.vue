<template>
    <section class="py-12 sm:py-16 lg:py-20 relative">
        <!-- Fond avec motif -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 relative">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="mt-4 text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj">
                    Pourquoi Choisir Notre Solution ?
                </h2>
            </div>

            <div
                class="grid grid-cols-1 mt-10 text-center md:mt-20 md:max-w-full sm:max-w-sm sm:mx-auto gap-y-10 md:grid-cols-3 md:gap-x-6 lg:gap-x-16 md:text-left">
                <div
                    class="p-6 transition-all duration-300 bg-blue-500/20 backdrop-blur-sm rounded-[32px] hover:bg-blue-500/30">
                    <h3 class="text-2xl font-bold text-white font-pj">
                        Rapidité d'Exécution
                    </h3>
                    <p class="mt-4 text-base leading-7 text-white/90 font-pj">
                        Site web livré au minimum en 24heures et maximum en 7 jours
                    </p>
                    <div class="flex items-center justify-center mt-10 md:justify-start">
                        <i
                            class='bx bx-time-five text-8xl text-white/90 transition-transform duration-300 hover:scale-110'></i>
                    </div>
                </div>

                <div
                    class="p-6 transition-all duration-300 bg-blue-500/20 backdrop-blur-sm rounded-[32px] hover:bg-blue-500/30">
                    <h3 class="text-2xl font-bold text-white font-pj">
                        Prix Transparent
                    </h3>
                    <p class="mt-4 text-base leading-7 text-white/90 font-pj">
                        Tarification claire et prévisible, sans frais cachés ni mauvaises surprises
                    </p>
                    <div class="flex items-center justify-center mt-10 md:justify-start">
                        <i
                            class='bx bx-euro text-8xl text-white/90 transition-transform duration-300 hover:scale-110'></i>
                    </div>
                </div>

                <div
                    class="p-6 transition-all duration-300 bg-blue-500/20 backdrop-blur-sm rounded-[32px] hover:bg-blue-500/30">
                    <h3 class="text-2xl font-bold text-white font-pj">
                        Expertise Technique
                    </h3>
                    <p class="mt-4 text-base leading-7 text-white/90 font-pj">
                        Technologies modernes et solutions performantes pour un site web optimal
                    </p>
                    <div class="flex items-center justify-center mt-10 md:justify-start">
                        <i
                            class='bx bx-code-alt text-8xl text-white/90 transition-transform duration-300 hover:scale-110'></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.bg-grid-pattern {
    background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
    background-size: 40px 40px;
}
</style>
