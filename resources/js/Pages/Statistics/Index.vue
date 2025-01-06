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

                    <!-- Analyse des Forfaits -->
                    <div class="bg-white rounded-[32px] p-6 mb-6 shadow-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Analyse des Forfaits</h3>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Forfait Starter -->
                            <div v-for="forfait in forfaitAnalytics" :key="forfait.id"
                                class="bg-gray-50 rounded-[24px] p-6 border border-gray-200">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="text-lg font-medium text-gray-900">{{ forfait.name }}</h4>
                                    <span class="text-2xl font-bold text-blue-600">
                                        {{ formatPrice(forfait.price) }}
                                    </span>
                                </div>

                                <div class="space-y-3">
                                    <div class="flex justify-between text-gray-600">
                                        <span>URSSAF ({{ CHARGES_2025.URSSAF }}%)</span>
                                        <span>{{ formatPrice(forfait.charges.urssaf) }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600">
                                        <span>IR ({{ CHARGES_2025.IR }}%)</span>
                                        <span>{{ formatPrice(forfait.charges.ir) }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600">
                                        <span>Frais Stripe ({{ CHARGES_2025.STRIPE.PERCENT }}% + {{
                                            CHARGES_2025.STRIPE.FIXED }}€)</span>
                                        <span>{{ formatPrice(forfait.charges.stripeFees) }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600">
                                        <span>Frais fixes mensuels</span>
                                        <span>{{ formatPrice(CHARGES_2025.FIXED_MONTHLY) }}</span>
                                    </div>
                                    <div
                                        class="border-t border-gray-200 pt-3 flex justify-between font-semibold text-gray-900">
                                        <span>Revenu net</span>
                                        <span class="text-green-600">{{ formatPrice(forfait.netRevenue) }}</span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Taux horaire net: {{ formatPrice(forfait.hourlyRate) }}/h
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Analyse des Options Additionnelles -->
                        <div class="mt-8 mb-12">
                            <h3 class="text-xl font-semibold text-gray-900 mb-6">Analyse des Options Additionnelles</h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div v-for="option in optionAnalytics" :key="option.id"
                                    class="bg-gray-50 rounded-[24px] p-6 border border-gray-200">
                                    <div class="flex items-center space-x-3 mb-4">
                                        <i :class="['bx text-2xl text-blue-600', option.icon]"></i>
                                        <h4 class="text-lg font-medium text-gray-900">{{ option.name }}</h4>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex justify-between text-gray-600">
                                            <span>Prix de base</span>
                                            <span class="font-medium">{{ formatPrice(option.price) }}</span>
                                        </div>
                                        <div class="flex justify-between text-gray-600">
                                            <span>URSSAF ({{ CHARGES_2025.URSSAF }}%)</span>
                                            <span>{{ formatPrice(option.charges.urssaf) }}</span>
                                        </div>
                                        <div class="flex justify-between text-gray-600">
                                            <span>IR ({{ CHARGES_2025.IR }}%)</span>
                                            <span>{{ formatPrice(option.charges.ir) }}</span>
                                        </div>
                                        <div class="flex justify-between text-gray-600">
                                            <span>Frais Stripe</span>
                                            <span>{{ formatPrice(option.charges.stripeFees) }}</span>
                                        </div>
                                        <div class="border-t border-gray-200 pt-3 flex justify-between font-semibold">
                                            <span>Revenu net</span>
                                            <span class="text-green-600">{{ formatPrice(option.netRevenue) }}</span>
                                        </div>
                                        <div class="text-sm text-gray-500 text-center mt-2">
                                            Taux horaire: {{ formatPrice(option.hourlyRate) }}/h
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Simulateur de Revenus -->
                        <div class="mt-12">
                            <h3 class="text-xl font-semibold text-gray-900 mb-6">Simulateur de Revenus</h3>

                            <div class="bg-gray-50 rounded-[24px] p-6 border border-gray-200">
                                <!-- Sélection du forfait -->
                                <div class="mb-6">
                                    <label class="block text-gray-700 mb-2">Forfait de base</label>
                                    <select v-model="selectedForfait"
                                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                        <option v-for="forfait in FORFAITS" :key="forfait.id" :value="forfait.id">
                                            {{ forfait.name }} - {{ formatPrice(forfait.price) }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Options additionnelles -->
                                <div class="mb-6">
                                    <label class="block text-gray-700 mb-2">Options additionnelles</label>

                                    <!-- Options incluses -->
                                    <div v-if="includedOptions.length > 0" class="mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Options incluses dans votre forfait :</p>
                                        <div class="space-y-2">
                                            <div v-for="optionId in includedOptions" :key="optionId"
                                                class="flex items-center text-green-600">
                                                <i class='bx bx-check-circle mr-2'></i>
                                                <span>{{ OPTIONS.find(opt => opt.id === optionId).name }}
                                                    (Inclus)</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Options disponibles -->
                                    <div v-if="availableOptions.length > 0" class="space-y-2">
                                        <p class="text-sm text-gray-600 mb-2">Options supplémentaires disponibles :</p>
                                        <div v-for="option in availableOptions" :key="option.id"
                                            class="flex items-center">
                                            <input type="checkbox" v-model="selectedOptions" :value="option.id"
                                                :id="option.id"
                                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <label :for="option.id" class="ml-2 text-gray-600">
                                                {{ option.name }} - {{ formatPrice(option.price) }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Résultats de la simulation -->
                                <div class="bg-white rounded-lg p-4 border border-gray-200">
                                    <h4 class="text-lg font-medium text-gray-900 mb-4">Résultats de la simulation</h4>

                                    <div class="space-y-3">
                                        <div class="flex justify-between text-gray-600">
                                            <span>Prix total</span>
                                            <span class="font-medium">{{ formatPrice(simulationTotal.price) }}</span>
                                        </div>
                                        <div class="flex justify-between text-gray-600">
                                            <span>URSSAF ({{ CHARGES_2025.URSSAF }}%)</span>
                                            <span>{{ formatPrice(simulationTotal.charges.urssaf) }}</span>
                                        </div>
                                        <div class="flex justify-between text-gray-600">
                                            <span>IR ({{ CHARGES_2025.IR }}%)</span>
                                            <span>{{ formatPrice(simulationTotal.charges.ir) }}</span>
                                        </div>
                                        <div class="flex justify-between text-gray-600">
                                            <span>Frais Stripe</span>
                                            <span>{{ formatPrice(simulationTotal.charges.stripeFees) }}</span>
                                        </div>
                                        <div class="flex justify-between text-gray-600">
                                            <span>Frais fixes</span>
                                            <span>{{ formatPrice(CHARGES_2025.FIXED_MONTHLY) }}</span>
                                        </div>
                                        <div class="border-t border-gray-200 pt-3 flex justify-between font-semibold">
                                            <span>Revenu net estimé</span>
                                            <span class="text-green-600">{{ formatPrice(simulationTotal.net) }}</span>
                                        </div>
                                        <div class="text-sm text-gray-500 text-center mt-2">
                                            Temps estimé: {{ simulationTotal.hours }}h
                                            <br>
                                            Taux horaire: {{ formatPrice(simulationTotal.hourlyRate) }}/h
                                        </div>
                                    </div>
                                </div>
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
import { defineProps, ref, computed } from 'vue';
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
        currency: 'EUR',
        minimumFractionDigits: 2
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

// Constantes pour les charges et cotisations 2024/2025
const CHARGES_2025 = {
    URSSAF: 22,        // 22% au lieu de 23.1%
    IR: 2.2,           // 2.2%
    STRIPE: {
        PERCENT: 1.5,  // 1.4%
        FIXED: 0.25    // 0.25€ par transaction
    },
    FIXED_MONTHLY: 32  // Frais fixes mensuels arrondis
};

// Configuration des forfaits
const FORFAITS = [
    {
        id: 'starter',
        name: 'Starter',
        price: 999,
        badge: 'Essentiel',
        description: 'Site vitrine professionnel',
        popular: false,
        deliveryDays: 1,
        workHours: 8,
        features: [
            'Site vitrine 3 pages',
            'Design responsive',
            'Formulaire de contact',
            'Optimisation SEO de base',
            'Options additionnelles disponibles'
        ]
    },
    {
        id: 'standard',
        name: 'Standard',
        price: 2299,
        badge: 'Populaire',
        description: 'Solution complète avec options incluses',
        popular: true,
        deliveryDays: 3,
        workHours: 24,
        features: [
            'Tout du Starter +',
            'Logo personnalisé',
            'Photos professionnelles',
            'Réseaux sociaux',
            'SEO avancé',
            '5-7 pages'
        ]
    },
    {
        id: 'premium',
        name: 'Premium',
        price: 3999,
        badge: 'Tout inclus',
        description: 'Solution e-commerce complète',
        popular: false,
        deliveryDays: 5,
        workHours: 40,
        features: [
            'Tout du Standard +',
            'E-commerce complet',
            'Dashboard administrateur',
            'Pages illimitées',
            'Support prioritaire'
        ]
    }
];

// Options disponibles (principalement pour Starter)
const OPTIONS = [
    {
        id: 'logoPhotos',
        name: 'Logo + Photos Pro',
        price: 199,
        icon: 'bx-image',
        workHours: 2,
        availableFor: ['starter'],
        details: [
            'Design de logo unique',
            'Session photos pro',
            '3 révisions incluses',
            'Fichiers sources'
        ]
    },
    {
        id: 'socialMedia',
        name: 'Réseaux Sociaux',
        price: 349,
        icon: 'bx-share-alt',
        workHours: 5,
        availableFor: ['starter'],
        details: [
            'Configuration des profils',
            'Intégration au site',
            'Stratégie de base',
            'Formation utilisation'
        ]
    },
    {
        id: 'ecommerce',
        name: 'E-commerce & CRM',
        price: 899,
        icon: 'bx-store',
        workHours: 10,
        availableFor: ['standard'],
        details: [
            'Catalogue produits complet',
            'Système de paiement sécurisé',
            'Gestion des stocks avancée',
            'CRM intégré avec tableau de bord',
            'Gestion des commandes',
            'Suivi clients',
            'Rapports et statistiques',
            'Formation complète incluse'
        ]
    }
];

// Ajout d'une computed property pour gérer les options incluses par forfait
const includedOptions = computed(() => {
    switch (selectedForfait.value) {
        case 'standard':
            return ['logoPhotos', 'socialMedia'];
        case 'premium':
            return ['logoPhotos', 'socialMedia', 'ecommerce'];
        default:
            return [];
    }
});

// Modification de la computed property pour les options disponibles
const availableOptions = computed(() => {
    return OPTIONS.filter(option => {
        // Si c'est le forfait Starter, on exclut l'option e-commerce
        if (selectedForfait.value === 'starter' && option.id === 'ecommerce') {
            return false;
        }
        // Si l'option est déjà incluse dans le forfait, on ne l'affiche pas
        if (includedOptions.value.includes(option.id)) {
            return false;
        }
        // Sinon on vérifie si elle est disponible pour ce forfait
        return option.availableFor.includes(selectedForfait.value);
    }).map(option => ({
        ...option,
        included: includedOptions.value.includes(option.id)
    }));
});

// Calcul du total avec projection de revenus
const projectedRevenue = computed(() => {
    const monthlyProjects = {
        minimal: {
            starter: 1,
            standard: 1,
            premium: 0
        },
        average: {
            starter: 1,
            standard: 1,
            premium: 1
        },
        optimal: {
            starter: 0,
            standard: 2,
            premium: 2
        }
    };

    return {
        monthly: {
            minimal: calculateProjectedRevenue(monthlyProjects.minimal),
            average: calculateProjectedRevenue(monthlyProjects.average),
            optimal: calculateProjectedRevenue(monthlyProjects.optimal)
        },
        annual: {
            minimal: calculateProjectedRevenue(monthlyProjects.minimal) * 12,
            average: calculateProjectedRevenue(monthlyProjects.average) * 12,
            optimal: calculateProjectedRevenue(monthlyProjects.optimal) * 12
        }
    };
});

// Fonction helper pour calculer les revenus projetés
const calculateProjectedRevenue = (projects) => {
    let total = 0;
    for (const [type, count] of Object.entries(projects)) {
        const forfait = FORFAITS.find(f => f.id === type);
        if (forfait) {
            total += calculateNet(forfait.price) * count;
        }
    }
    return total;
};

// Fonction pour calculer les charges
const calculateCharges = (amount) => {
    return {
        urssaf: (amount * CHARGES_2025.URSSAF) / 100,
        ir: (amount * CHARGES_2025.IR) / 100,
        stripeFees: ((amount * CHARGES_2025.STRIPE.PERCENT) / 100) + CHARGES_2025.STRIPE.FIXED,
        fixedCosts: CHARGES_2025.FIXED_MONTHLY
    };
};

// Fonction pour calculer le net
const calculateNet = (amount) => {
    const charges = calculateCharges(amount);
    return amount - charges.urssaf - charges.ir - charges.stripeFees - charges.fixedCosts;
};

const calculateHourlyRate = (netAmount, hours) => {
    return netAmount / hours;
};

// Computed properties
const forfaitAnalytics = computed(() => {
    return FORFAITS.map(forfait => ({
        ...forfait,
        charges: calculateCharges(forfait.price),
        netRevenue: calculateNet(forfait.price),
        hourlyRate: calculateNet(forfait.price) / forfait.workHours
    }));
});

const optionAnalytics = computed(() => {
    return OPTIONS.map(option => ({
        ...option,
        charges: calculateCharges(option.price),
        netRevenue: calculateNet(option.price),
        hourlyRate: calculateNet(option.price) / option.workHours
    }));
});

// Pour le simulateur
const selectedForfait = ref(FORFAITS[0].id);
const selectedOptions = ref([]);

const simulationTotal = computed(() => {
    const forfait = FORFAITS.find(f => f.id === selectedForfait.value);
    let totalPrice = forfait.price;
    let totalHours = forfait.workHours;

    // Ajouter les heures des options incluses dans le forfait
    includedOptions.value.forEach(optId => {
        const includedOption = OPTIONS.find(opt => opt.id === optId);
        if (includedOption) {
            totalHours += includedOption.workHours;
        }
    });

    // Ajouter les heures des options sélectionnées manuellement
    const selectedOptionsPrices = selectedOptions.value
        .filter(optId => !includedOptions.value.includes(optId))
        .map(optId => {
            const option = OPTIONS.find(opt => opt.id === optId);
            if (option) {
                totalHours += option.workHours;
                return option.price;
            }
            return 0;
        });

    totalPrice += selectedOptionsPrices.reduce((sum, price) => sum + price, 0);

    const charges = calculateCharges(totalPrice);
    const netAmount = calculateNet(totalPrice);

    return {
        price: totalPrice,
        charges,
        net: netAmount,
        hours: totalHours, // Temps total incluant forfait + options incluses + options sélectionnées
        hourlyRate: netAmount / totalHours
    };
});
</script>