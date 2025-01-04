<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import SideBarClient from '../Website/componentsDashboard/SideBarClient.vue';

const props = defineProps({
    orders: {
        type: Array,
        required: true
    },
    projects: {
        type: Array,
        required: true
    },
    stats: {
        type: Object,
        default: () => ({
            total_orders: 0,
            active_projects: 0,
            completed_projects: 0
        })
    },
    auth: {
        type: Object,
        required: true
    }
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(price);
};
</script>

<template>
    <AppLayout title="Mon Tableau de Bord">
        <SideBarClient>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Message de bienvenue -->
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-xl p-6 mb-8">
                        <div class="flex items-start space-x-4">
                            <div class="flex-1">
                                <h1 class="text-2xl font-bold text-white mb-2">
                                    Bienvenue sur votre espace client {{ auth.user.name }} ! 👋
                                </h1>
                                <p class="text-white/90 mb-4">
                                    Voici votre tableau de bord personnel où vous pouvez suivre vos projets, gérer vos
                                    commandes et contacter notre support.
                                </p>
                                <div class="bg-white/10 rounded-lg p-4 text-white/90">
                                    <h2 class="font-semibold mb-2">Comment utiliser votre tableau de bord :</h2>
                                    <ul class="space-y-2">
                                        <li class="flex items-center">
                                            <i class='bx bx-check-circle mr-2'></i>
                                            Suivez l'avancement de vos projets en temps réel
                                        </li>
                                        <li class="flex items-center">
                                            <i class='bx bx-check-circle mr-2'></i>
                                            Consultez l'historique de vos commandes
                                        </li>
                                        <li class="flex items-center">
                                            <i class='bx bx-check-circle mr-2'></i>
                                            Contactez notre support pour toute question
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="hidden md:block">
                                <i class='bx bx-user-circle text-8xl text-white/80'></i>
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <!-- ... reste de votre code existant ... -->

                </div>
            </div>
        </SideBarClient>
    </AppLayout>
</template>