<template>
    <section class="py-12 sm:py-16 lg:py-20 relative">
        <!-- Ajout du fond avec motif -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl">
                    Le Marché du Développement Web
                </h2>
                <p class="mt-4 text-lg text-white/80">
                    Découvrez les tendances actuelles du marché du développement web
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 mt-12 lg:mt-16 md:grid-cols-3">
                <div class="overflow-hidden bg-blue-500/20 backdrop-blur-sm rounded-[32px]">
                    <div class="p-6 lg:py-10 lg:px-9">
                        <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-24 text-5xl font-bold text-white font-pj">76%</p>
                        <p class="mt-4 text-lg font-normal leading-tight text-white/90 font-pj">
                            des consommateurs achètent des produits en ligne en 2024
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
                        <p class="mt-24 text-5xl font-bold text-white font-pj">88%</p>
                        <p class="mt-4 text-lg font-normal leading-tight text-white/90 font-pj">
                            des utilisateurs ne retournent pas sur un site après une mauvaise expérience
                        </p>
                    </div>
                </div>

                <div class="overflow-hidden bg-blue-500/20 backdrop-blur-sm rounded-[32px]">
                    <div class="p-6 lg:py-10 lg:px-9">
                        <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-24 text-5xl font-bold text-white font-pj">67%</p>
                        <p class="mt-4 text-lg font-normal leading-tight text-white/90 font-pj">
                            des petites entreprises ont un site web en France en 2024
                        </p>
                    </div>
                </div>
            </div>

            <!-- Ajout des informations de source -->
            <div class="mt-12 text-center">
                <p class="text-sm text-white/60">
                    Statistiques 2024
                </p>
                <div class="mt-2 space-y-1">
                    <p class="text-sm text-white/80">
                        Sources :
                    </p>
                    <a href="https://www.fevad.com" target="_blank"
                        rel="noopener noreferrer" class="text-sm text-blue-300 hover:text-blue-200 transition-colors">
                        FEVAD
                    </a>
                    <span class="text-white/60 mx-2">•</span>
                    <a href="https://www.insee.fr/fr/statistiques/6687000" target="_blank" rel="noopener noreferrer"
                        class="text-sm text-blue-300 hover:text-blue-200 transition-colors">
                        INSEE
                    </a>
                    <span class="text-white/60 mx-2">•</span>
                    <a href="https://www.statista.com/statistics/1335977/france-digital-market-overview/"
                        target="_blank" rel="noopener noreferrer"
                        class="text-sm text-blue-300 hover:text-blue-200 transition-colors">
                        Statista Digital Market Outlook
                    </a>
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
