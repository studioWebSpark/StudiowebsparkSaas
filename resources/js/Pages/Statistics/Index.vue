<template>
    <AppLayout title="Statistiques">
        <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
            <SideBar>
                <div class="p-6 flex-1 overflow-y-auto">
                    <!-- Vue d'ensemble -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Vue d'ensemble</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- CA Total -->
                            <div class="bg-purple-50 p-4 rounded-lg">
                                <h4 class="text-lg font-medium text-purple-800">CA Total</h4>
                                <p class="text-2xl font-bold text-purple-600">{{ formatPrice(stats.totalRevenue) }}</p>
                                <p class="text-sm text-purple-600">Sur l'année {{ currentYear }}</p>
                            </div>

                            <!-- Commandes -->
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <h4 class="text-lg font-medium text-blue-800">Commandes</h4>
                                <p class="text-2xl font-bold text-blue-600">{{ stats.totalOrders }}</p>
                                <div class="text-sm text-blue-600">
                                    <span class="font-medium">{{ stats.paidOrders }}</span> payées
                                </div>
                            </div>

                            <!-- Panier moyen -->
                            <div class="bg-green-50 p-4 rounded-lg">
                                <h4 class="text-lg font-medium text-green-800">Panier moyen</h4>
                                <p class="text-2xl font-bold text-green-600">
                                    {{ formatPrice(stats.averageOrderValue) }}
                                </p>
                            </div>

                            <!-- Taux de conversion -->
                            <div class="bg-yellow-50 p-4 rounded-lg">
                                <h4 class="text-lg font-medium text-yellow-800">Taux de conversion</h4>
                                <p class="text-2xl font-bold text-yellow-600">
                                    {{ stats.conversionRate }}%
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Graphique -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Évolution mensuelle du CA 2025</h3>
                        <div class="h-64 w-full">
                            <Line :data="stats.revenueChart" :options="chartOptions" />
                        </div>
                    </div>

                    <!-- Charges Sociales -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Charges Sociales</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- URSSAF -->
                            <div class="border rounded-lg p-4">
                                <h4 class="text-lg font-medium text-gray-800">URSSAF</h4>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ formatPrice(stats.charges_sociales.urssaf.total_urssaf) }}
                                </p>
                                <p class="text-sm text-gray-500">23.10% du CA</p>
                            </div>

                            <!-- Versement libératoire IR -->
                            <div class="border rounded-lg p-4">
                                <h4 class="text-lg font-medium text-gray-800">Versement libératoire IR</h4>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ formatPrice(stats.charges_sociales.impots.versement_liberatoire.amount) }}
                                </p>
                                <p class="text-sm text-gray-500">2.20% du CA</p>
                            </div>
                        </div>

                        <!-- Total des charges -->
                        <div class="mt-6 border rounded-lg p-4 bg-blue-50">
                            <h4 class="text-lg font-medium text-gray-800">Total des charges sociales</h4>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ formatPrice(stats.charges_sociales.total_charges) }}
                            </p>
                            <p class="text-sm text-gray-500">25.30% du CA</p>
                        </div>
                    </div>

                    <!-- Frais et Abonnements -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Frais et Abonnements</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Frais Stripe -->
                            <div class="border rounded-lg p-4">
                                <h4 class="text-lg font-medium text-gray-800">Frais Stripe</h4>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ formatPrice(stats.stripe.fees) }}
                                </p>
                                <p class="text-sm text-gray-500">1.4% + 0.25€ par transaction</p>
                            </div>

                            <!-- Curso Pro -->
                            <div class="border rounded-lg p-4">
                                <h4 class="text-lg font-medium text-gray-800">Curso Pro</h4>
                                <p class="text-2xl font-bold text-gray-900">20,00 €</p>
                                <p class="text-sm text-gray-500">Abonnement mensuel</p>
                            </div>

                            <!-- Adobe Express -->
                            <div class="border rounded-lg p-4">
                                <h4 class="text-lg font-medium text-gray-800">Adobe Express</h4>
                                <p class="text-2xl font-bold text-gray-900">11,99 €</p>
                                <p class="text-sm text-gray-500">Abonnement mensuel</p>
                            </div>

                            <!-- Total des frais -->
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <h4 class="text-lg font-medium text-gray-800">Total des frais</h4>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ formatPrice(stats.stripe.fees + 31.99) }}
                                </p>
                                <p class="text-sm text-gray-500">Frais Stripe + Abonnements</p>
                            </div>
                        </div>

                        <!-- Résumé financier -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Total à déduire -->
                            <div class="border rounded-lg p-4 bg-red-50">
                                <h4 class="text-lg font-medium text-gray-800">Total à déduire</h4>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ formatPrice(stats.charges_sociales.total_charges + stats.stripe.fees + 31.99) }}
                                </p>
                                <p class="text-sm text-gray-500">Charges sociales + Frais Stripe + Abonnements</p>
                            </div>

                            <!-- Revenu net final -->
                            <div class="border rounded-lg p-4 bg-green-50">
                                <h4 class="text-lg font-medium text-gray-800">Revenu net final</h4>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ formatPrice(stats.totalRevenue - stats.charges_sociales.total_charges -
                                    stats.stripe.fees - 31.99) }}
                                </p>
                                <p class="text-sm text-gray-500">CA - (Charges sociales + Frais + Abonnements)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </SideBar>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Line } from 'vue-chartjs';
import { defineProps, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
} from 'chart.js';
import SideBar from '../Website/componentsDashboard/SideBar.vue';

// Enregistrer les composants nécessaires pour Chart.js
ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
);

const props = defineProps({
    stats: {
        type: Object,
        required: true
    }
});

const currentYear = new Date().getFullYear();

const changePeriod = (period) => {
    router.get(route('admin.statistics.index'), { period }, {
        preserveState: true,
        preserveScroll: true,
    });
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(price);
};

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        y: {
            beginAtZero: true,
            ticks: {
                callback: (value) => formatPrice(value)
            }
        }
    },
    plugins: {
        tooltip: {
            callbacks: {
                label: (context) => formatPrice(context.raw)
            }
        }
    }
};
</script>