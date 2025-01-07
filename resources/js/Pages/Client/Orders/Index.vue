<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SideBarClient from '@/Pages/Website/componentsDashboard/SideBarClient.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    orders: Array
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(price);
};
</script>

<template>
    <AppLayout title="Mes Commandes">
        <SideBarClient>
            <div class="py-12 px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded- mt-10">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-xl font-semibold mb-6">Historique de mes commandes</h2>

                        <!-- Version desktop -->
                        <div class="hidden sm:block">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            N° Commande
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
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
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr v-for="order in orders" :key="order.id">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ order.order_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ new Date(order.created_at).toLocaleString('fr-FR', {
                                            year: 'numeric',
                                            month: '2-digit',
                                            day: '2-digit',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                            }) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ formatPrice(order.total_amount) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span :class="{
                                                'px-2 py-1 text-xs rounded-full': true,
                                                'bg-yellow-100 text-yellow-800': order.status === 'pending',
                                                'bg-green-100 text-green-800': order.status === 'completed',
                                                'bg-blue-100 text-blue-800': order.status === 'in_progress'
                                            }">
                                                {{ order.status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <Link :href="route('client.orders.show', order.id)"
                                                class="text-indigo-600 hover:text-indigo-900">
                                            Voir détails
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Version mobile -->
                        <div class="sm:hidden space-y-4">
                            <div v-for="order in orders" :key="order.id"
                                class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-medium">Commande #{{ order.order_number }}</p>
                                        <p class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {{ new Date(order.created_at).toLocaleString('fr-FR', {
                                                year: 'numeric',
                                                month: '2-digit',
                                            day: '2-digit',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                            }) }}
                                        </p>
                                    </div>
                                    <span :class="{
                                        'px-2 py-1 text-xs rounded-full': true,
                                        'bg-yellow-100 text-yellow-800': order.status === 'pending',
                                        'bg-green-100 text-green-800': order.status === 'completed',
                                        'bg-blue-100 text-blue-800': order.status === 'in_progress'
                                    }">
                                        {{ order.status }}
                                    </span>
                                </div>
                                <p class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ formatPrice(order.total_amount) }}
                                </p>
                                <Link :href="route('client.orders.show', order.id)"
                                    class="text-sm text-indigo-600 hover:text-indigo-900">
                                Voir détails
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </SideBarClient>
    </AppLayout>
</template>