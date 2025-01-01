<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PaymentStatusBadge from '@/Components/PaymentStatusBadge.vue';

defineProps({
    payments: Object,
    filters: Object,
    stats: Object
});
</script>

<template>
    <AdminLayout>

        <Head title="Gestion des paiements" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-2">Total</h3>
                        <p class="text-3xl">{{ stats.total }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-2">En attente</h3>
                        <p class="text-3xl text-yellow-500">{{ stats.pending }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-2">Complétés</h3>
                        <p class="text-3xl text-green-500">{{ stats.completed }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-2">Montant total</h3>
                        <p class="text-3xl">{{ new Intl.NumberFormat('fr-FR', {
                            style: 'currency', currency: 'EUR'
                        }).format(stats.totalAmount) }}</p>
                    </div>
                </div>

                <!-- Filtres -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                    <div class="flex flex-col md:flex-row gap-4">
                        <input type="text" v-model="filters.search" placeholder="Rechercher..."
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">

                        <select v-model="filters.status"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Tous les statuts</option>
                            <option value="pending">En attente</option>
                            <option value="completed">Complétés</option>
                            <option value="cancelled">Annulés</option>
                        </select>
                    </div>
                </div>

                <!-- Liste des paiements -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Client
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Montant
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800">
                            <tr v-for="payment in payments.data" :key="payment.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ payment.order_id || `#${payment.id}` }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ payment.user.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ payment.formatted_amount }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <PaymentStatusBadge :status="payment.status" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ new Date(payment.created_at).toLocaleDateString() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <Link :href="route('admin.payments.show', payment.id)"
                                        class="text-indigo-600 hover:text-indigo-900">
                                    Détails
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>