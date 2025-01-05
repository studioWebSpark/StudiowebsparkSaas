<template>
    <section class="py-12 sm:py-16 lg:py-20 relative">
        <!-- Ajout du fond avec motif -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 relative">
            <div class="lg:max-w-xl lg:mx-auto sm:text-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj">
                    Le Web en 2024 : Un Marché en Pleine Expansion
                </h2>
                <p class="mt-8 text-lg font-normal text-white/90 font-pj">
                    Voici les statistiques qui montrent l'importance du web dans notre quotidien.
                </p>
            </div>

            <div
                class="grid max-w-6xl grid-cols-1 gap-6 mx-auto mt-8 sm:mt-12 lg:mt-16 xl:mt-20 sm:grid-cols-3 lg:gap-x-12 xl:gap-x-20">
                <div class="overflow-hidden bg-blue-500/20 backdrop-blur-sm rounded-[32px]">
                    <div class="p-6 lg:py-10 lg:px-9">
                        <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-24 text-5xl font-bold text-white font-pj">68%</p>
                        <p class="mt-4 text-lg font-normal leading-tight text-white/90 font-pj">
                            des interactions client commencent par une recherche en ligne
                        </p>
                    </div>
                </div>

                <div class="overflow-hidden bg-blue-500/20 backdrop-blur-sm rounded-[32px]">
                    <div class="p-6 lg:py-10 lg:px-9">
                        <svg class="w-16 h-16  text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-24 text-5xl font-bold text-white font-pj">68%</p>
                        <p class="mt-4 text-lg font-normal leading-tight text-white/90 font-pj">
                            des interactions client commencent par une recherche en ligne
                        </p>
                    </div>
                </div>

                <div class="overflow-hidden bg-blue-500/20 backdrop-blur-sm rounded-[32px]">
                    <div class="p-6 lg:py-10 lg:px-9">
                        <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <p class="mt-24 text-5xl font-bold text-white font-pj">75%</p>
                        <p class="mt-4 text-lg font-normal leading-tight text-white/90 font-pj">
                            des consommateurs jugent la crédibilité d'une entreprise par son site web
                        </p>
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
