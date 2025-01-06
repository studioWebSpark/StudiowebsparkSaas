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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Remplacement de l'image par des icônes animées -->
                <div class="relative group">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl blur-2xl opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div class="relative overflow-hidden rounded-xl bg-white/10 backdrop-blur-sm p-8">
                        <div class="flex items-center justify-center h-80 relative">
                            <!-- Icônes principales -->
                            <i class='bx bx-rocket text-8xl text-white animate-float absolute top-8 left-1/4'></i>
                            <i
                                class='bx bx-laptop text-7xl text-white/80 animate-float-delayed absolute bottom-8 right-1/4'></i>

                            <!-- Icônes secondaires -->
                            <i
                                class='bx bx-code-alt text-6xl text-white/60 animate-float-delayed-2 absolute top-1/3 right-8'></i>
                            <i
                                class='bx bx-line-chart text-5xl text-white/60 animate-float absolute bottom-1/3 left-8'></i>
                            <i class='bx bx-bulb text-6xl text-white/70 animate-float-delayed bottom-16 left-1/2'></i>
                        </div>
                    </div>
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

@keyframes float {

    0%,
    100% {
        transform: translateY(0) rotate(0deg);
    }

    50% {
        transform: translateY(-20px) rotate(5deg);
    }
}

@keyframes float-delayed {

    0%,
    100% {
        transform: translateY(-20px) rotate(-5deg);
    }

    50% {
        transform: translateY(0) rotate(0deg);
    }
}

@keyframes float-delayed-2 {

    0%,
    100% {
        transform: translateY(0) rotate(-5deg);
    }

    50% {
        transform: translateY(-15px) rotate(5deg);
    }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 4s ease-in-out infinite;
}

.animate-float-delayed-2 {
    animation: float-delayed-2 4s ease-in-out infinite;
    animation-delay: 2s;
}

/* Effet de brillance */
.group:hover .bx {
    filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.8));
    transition: all 0.3s ease;
}
</style>
