<template>
    <section class="py-12 sm:py-16 lg:py-20 relative">
        <!-- Fond avec motif -->
        <div class="absolute inset-0 bg-blue-600 dark:bg-blue-900">
            <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
        </div>

        <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-xl px-8 mx-auto text-center md:px-0">
                <span class="text-base font-semibold tracking-wide text-white uppercase">
                    Notre Vision
                </span>
                <h2 class="mt-4 text-3xl font-bold text-white sm:text-4xl xl:text-5xl font-pj">
                    Des Solutions Web Accessibles pour Tous
                </h2>
                <p class="mt-4 text-lg font-normal text-white/90 font-pj mb-14">
                    Accompagnement personnalisé et tarifs adaptés pour les entrepreneurs en démarrage
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 lg:gap-x-16 xl:gap-x-24 gap-y-12">
                <div class="">
                    <img class="w-full rounded-[32px] shadow-xl"
                        src="https://landingfoliocom.imgix.net/store/collection/saasui/images/features/11/feature-11.png"
                        alt="Mesut Kircil - Fondateur" />
                </div>

                <div class="xl:pr-8">
                    <div class="max-w-lg lg:max-w-none">
                        <p class="text-base font-semibold text-white/90">
                            Fondateur & Développeur Web
                        </p>
                        <h2
                            class="mt-6 text-3xl font-semibold tracking-tight text-white lg:mt-8 sm:text-4xl lg:text-4xl">
                            "Je crois en l'accessibilité du digital pour tous les entrepreneurs"
                        </h2>

                        <blockquote class="mt-4 lg:mt-6">
                            <p class="text-base font-normal leading-7 text-white/90">
                                "Ayant moi-même démarré de zéro, je comprends parfaitement les défis financiers auxquels
                                font face les nouveaux entrepreneurs. C'est pourquoi j'ai développé une approche
                                flexible avec des tarifs justes et adaptés, permettant à chacun d'avoir une présence web
                                professionnelle sans compromettre la qualité."
                            </p>
                            <div class="flex items-center mt-6">
                                <p class="text-sm font-semibold text-white">Mesut Kircil</p>
                                <p class="ml-3 text-sm font-medium text-white/70">Fondateur</p>
                            </div>
                        </blockquote>

                        <hr class="mt-8 border-white/20" />

                        <div class="mt-8 space-y-4">
                            <div class="flex items-center">
                                <i class='bx bx-check-circle text-2xl text-white mr-2'></i>
                                <span class="text-white/90">Prix adaptés aux entrepreneurs en démarrage</span>
                            </div>
                            <div class="flex items-center">
                                <i class='bx bx-check-circle text-2xl text-white mr-2'></i>
                                <span class="text-white/90">Accompagnement personnalisé</span>
                            </div>
                            <div class="flex items-center">
                                <i class='bx bx-check-circle text-2xl text-white mr-2'></i>
                                <span class="text-white/90">Solutions sur mesure et évolutives</span>
                            </div>
                        </div>

                        <div class="mt-12">
                            <a href="#contact" title="Discutons de votre projet"
                                class="inline-flex items-center text-sm font-semibold text-white transition-all duration-200 group hover:text-white/80">
                                Parlons de votre projet
                                <svg class="w-5 h-5 ml-1 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all duration-200"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="7" y1="17" x2="17" y2="7"></line>
                                    <polyline points="7 7 17 7 17 17"></polyline>
                                </svg>
                            </a>
                        </div>
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
