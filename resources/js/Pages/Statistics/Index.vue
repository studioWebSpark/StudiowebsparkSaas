<template>
    <AppLayout title="Statistiques">
        <div class="flex flex-col md:flex-row min-h-screen bg-gray-100 dark:bg-gray-900">
            <SideBar>
                <div class="p-4 md:p-6 flex-1 overflow-y-auto mt-14">
                    <!-- Vue d'ensemble -->
                    <div
                        class="bg-white overflow-hidden shadow-xl rounded-[32px]  sm:rounded-lg p-4 md:p-6 mb-4 md:mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Vue d'ensemble</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
                            <!-- CA Total -->
                            <div class="bg-purple-50 p-3 md:p-4 rounded-lg">
                                <h4 class="text-base md:text-lg font-medium text-purple-800">CA Total</h4>
                                <p class="text-xl md:text-2xl font-bold text-purple-600">
                                    {{ formatPrice(stats.totalRevenue) }}
                                </p>
                                <p class="text-sm text-purple-600">Sur l'année {{ currentYear }}</p>
                            </div>

                            <!-- Commandes -->
                            <div class="bg-blue-50 p-3 md:p-4 rounded-lg">
                                <h4 class="text-base md:text-lg font-medium text-blue-800">Commandes</h4>
                                <p class="text-xl md:text-2xl font-bold text-blue-600">{{ stats.totalOrders }}</p>
                                <div class="text-sm text-blue-600">
                                    <span class="font-medium">{{ stats.paidOrders }}</span> payées
                                </div>
                            </div>

                            <!-- Panier moyen -->
                            <div class="bg-green-50 p-3 md:p-4 rounded-lg">
                                <h4 class="text-base md:text-lg font-medium text-green-800">Panier moyen</h4>
                                <p class="text-xl md:text-2xl font-bold text-green-600">
                                    {{ formatPrice(stats.averageOrderValue) }}
                                </p>
                            </div>

                            <!-- Taux de conversion -->
                            <div class="bg-yellow-50 p-3 md:p-4 rounded-lg">
                                <h4 class="text-base md:text-lg font-medium text-yellow-800">Taux de conversion</h4>
                                <p class="text-xl md:text-2xl font-bold text-yellow-600">
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
                                                <span>{{OPTIONS.find(opt => opt.id === optionId).name}}
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
                                            Temps estimé: {{ simulationTotal.hours || 0 }}h
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

                    <!-- Analyse des taux horaires pour toutes les options -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Analyse des Taux Horaires - Options
                            Additionnelles</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Option</th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Prix</th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Heures</th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Taux Horaire Net</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="option in optionAnalytics" :key="option.id"
                                        class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ option.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">
                                            {{ formatPrice(option.price) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">
                                            {{ option.workHours || option.hours || 0 }}h
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium"
                                            :class="option.hourlyRate > 50 ? 'text-green-600' : 'text-yellow-600'">
                                            {{ formatPrice(option.hourlyRate) }}/h
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>



                    <!-- Options de marketing digital -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Options de Marketing Digital</h3>

                        <!-- Note sur les frais de gestion de publicité -->
                        <div class="bg-blue-50 p-4 rounded-lg mb-4">
                            <p class="text-sm text-blue-800">
                                <i class="bx bx-info-circle mr-2"></i>
                                <strong>Note sur les campagnes publicitaires :</strong> Le tarif de gestion reste fixe à
                                199€ quel que soit le budget publicitaire choisi. Seul le montant investi dans les
                                plateformes publicitaires varie selon l'option sélectionnée.
                            </p>
                        </div>

                        <!-- Table pour marketingOptions -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Option</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Prix</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Heures</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Taux Horaire Net</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="option in marketingOptions" :key="option.id"
                                    class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ option.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">
                                        {{ formatPrice(option.price) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">
                                        {{ option.workHours || option.hours || 0 }}h
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium"
                                        :class="option.hourlyRate > 50 ? 'text-green-600' : 'text-yellow-600'">
                                        {{ formatPrice(option.hourlyRate) }}/h
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Options d'impression -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Options d'Impression</h3>
                        <!-- Table pour printOptions -->
                    </div>

                    <!-- Analyse de Rentabilité -->
                    <div class="bg-white overflow-hidden shadow-xl rounded-[32px] p-6 mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Analyse de Rentabilité</h3>

                        <!-- Top 5 des options les plus rentables -->
                        <div class="mb-8">
                            <h4 class="text-lg font-medium text-gray-800 mb-4">Top 5 des options les plus rentables</h4>
                            <div class="bg-blue-50 p-4 rounded-lg mb-4">
                                <p class="text-sm text-blue-800">
                                    <i class="bx bx-info-circle mr-2"></i>
                                    <strong>Note :</strong> Cette analyse est basée sur le taux horaire net après
                                    déduction des charges.
                                </p>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 rounded-lg">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Rang</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Option</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Prix</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Heures</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Taux Horaire Net</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Rentabilité</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="(option, index) in topProfitableOptions" :key="option.id"
                                            class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{
                                                index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex items-center">
                                                    <i :class="['bx text-lg mr-2 text-blue-600', option.icon]"></i>
                                                    <span>{{ option.name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">{{
                                                formatPrice(option.price) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">{{
                                                option.workHours }}h</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium"
                                                :class="getHourlyRateColorClass(option.hourlyRate)">
                                                {{ formatPrice(option.hourlyRate) }}/h
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium"
                                                :class="getHourlyRateColorClass(option.hourlyRate)">
                                                {{ getRentabilityText(option.hourlyRate) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Analyse par catégorie -->
                        <div class="mb-8">
                            <h4 class="text-lg font-medium text-gray-800 mb-4">Analyse par catégorie</h4>

                            <!-- Onglets pour les catégories -->
                            <div class="border-b border-gray-200 mb-4">
                                <nav class="-mb-px flex space-x-8">
                                    <button @click="activeTab = 'web'"
                                        :class="[activeTab === 'web' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']">
                                        Site Web
                                    </button>
                                    <button @click="activeTab = 'marketing'"
                                        :class="[activeTab === 'marketing' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']">
                                        Marketing Digital
                                    </button>
                                    <button @click="activeTab = 'print'"
                                        :class="[activeTab === 'print' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']">
                                        Impression
                                    </button>
                                </nav>
                            </div>

                            <!-- Contenu des onglets -->
                            <div v-if="activeTab === 'web'" class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 rounded-lg">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Option</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Prix</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Heures</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Taux Horaire Net</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Rentabilité</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="option in topWebOptions" :key="option.id" class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex items-center">
                                                    <i :class="['bx text-lg mr-2 text-blue-600', option.icon]"></i>
                                                    <span>{{ option.name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">{{
                                                formatPrice(option.price) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">{{
                                                option.workHours }}h</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium"
                                                :class="getHourlyRateColorClass(option.hourlyRate)">
                                                {{ formatPrice(option.hourlyRate) }}/h
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium"
                                                :class="getHourlyRateColorClass(option.hourlyRate)">
                                                {{ getRentabilityText(option.hourlyRate) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div v-if="activeTab === 'marketing'" class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 rounded-lg">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Option</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Prix</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Heures</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Taux Horaire Net</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Rentabilité</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="option in topMarketingOptions" :key="option.id"
                                            class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex items-center">
                                                    <i :class="['bx text-lg mr-2 text-blue-600', option.icon]"></i>
                                                    <span>{{ option.name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">{{
                                                formatPrice(option.price) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">{{
                                                option.workHours }}h</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium"
                                                :class="getHourlyRateColorClass(option.hourlyRate)">
                                                {{ formatPrice(option.hourlyRate) }}/h
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium"
                                                :class="getHourlyRateColorClass(option.hourlyRate)">
                                                {{ getRentabilityText(option.hourlyRate) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div v-if="activeTab === 'print'" class="overflow-x-auto">
                                <div class="bg-blue-50 p-4 rounded-lg mb-4">
                                    <p class="text-sm text-blue-800">
                                        <i class="bx bx-info-circle mr-2"></i>
                                        <strong>Note sur les prix d'impression :</strong> Les prix de Vistaprint sont
                                        indiqués à titre de comparaison. Votre offre inclut des services à valeur
                                        ajoutée comme la création personnalisée, la distribution et le suivi, ce qui
                                        justifie la différence de prix.
                                    </p>
                                </div>
                                <table class="min-w-full divide-y divide-gray-200 rounded-lg">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Option</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Votre Prix</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Prix Vistaprint</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Différence</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Heures</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Taux Horaire Net</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="option in printOptionsWithComparison" :key="option.id"
                                            class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex items-center">
                                                    <i :class="['bx text-lg mr-2 text-blue-600', option.icon]"></i>
                                                    <span>{{ option.name }}</span>
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900 font-medium">
                                                {{ formatPrice(option.price) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">
                                                {{ option.competitorPrice ? formatPrice(option.competitorPrice) : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                                <span v-if="option.comparison"
                                                    :class="option.comparison.difference > 0 ? 'text-yellow-600' : 'text-green-600'">
                                                    {{ option.comparison.difference > 0 ? '+' : '' }}{{
                                                        formatPrice(option.comparison.difference) }}
                                                    ({{ option.comparison.difference > 0 ? '+' : '' }}{{
                                                        option.comparison.percentageDifference }}%)
                                                </span>
                                                <span v-else class="text-gray-400">-</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">
                                                {{ option.workHours }}h
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium"
                                                :class="getHourlyRateColorClass(option.hourlyRate)">
                                                {{ formatPrice(option.hourlyRate) }}/h
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Explication de la valeur ajoutée -->
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                                    <h5 class="font-medium text-gray-800 mb-2">Valeur ajoutée de vos services
                                        d'impression</h5>
                                    <ul class="space-y-1 text-sm text-gray-700">
                                        <li class="flex items-start">
                                            <i class="bx bx-check-circle text-green-500 mt-0.5 mr-2"></i>
                                            <span><strong>Flyers :</strong> Contrairement à Vistaprint qui ne propose
                                                que l'impression, votre service inclut la création personnalisée, la
                                                distribution et le suivi.</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="bx bx-check-circle text-green-500 mt-0.5 mr-2"></i>
                                            <span><strong>Papier à imprimer + Carte de visite :</strong> Vous proposez 3
                                                modèles différents et un design cohérent entre tous les supports.</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="bx bx-check-circle text-green-500 mt-0.5 mr-2"></i>
                                            <span><strong>Service personnalisé :</strong> Vous offrez un accompagnement
                                                et des conseils que les imprimeurs en ligne ne peuvent pas
                                                fournir.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Recommandations pour optimiser davantage -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-800 mb-4">Recommandations pour optimiser davantage
                            </h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-start">
                                        <i class="bx bx-check-circle text-green-500 mt-0.5 mr-2"></i>
                                        <span><strong>Packs flyers :</strong> Proposer un service de distribution
                                            optionnel (séparé de l'impression) et créer des templates réutilisables pour
                                            réduire le temps de conception.</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="bx bx-check-circle text-green-500 mt-0.5 mr-2"></i>
                                        <span><strong>Création de Papier à Imprimer + Carte de Visite :</strong>
                                            Proposer des options premium (papier spécial, finitions luxe) avec un
                                            supplément.</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="bx bx-check-circle text-green-500 mt-0.5 mr-2"></i>
                                        <span><strong>Marketing Digital :</strong> Proposer des forfaits trimestriels ou
                                            annuels avec remise et ajouter des services d'analyse de performance et de
                                            ROI.</span>
                                    </li>
                                </ul>
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

// Configuration des forfaits modifiée
const FORFAITS = [
    {
        id: 'starter',
        name: 'Starter',
        price: 499,
        badge: 'Essentiel',
        description: 'Site vitrine professionnel',
        popular: false,
        deliveryDays: 1,
        workHours: 7,
        features: [
            'Site vitrine 3 pages',
            'Design responsive',
            'Formulaire de contact',
            'Optimisation SEO de base',
            'Options additionnelles disponibles'
        ]
    },
    {
        id: 'starter+',
        name: 'Starter +',
        price: 699,
        badge: 'Recommandé',
        description: 'Site vitrine professionnel avec Logo et Photos',
        popular: true,
        deliveryDays: 2,
        workHours: 9,
        features: [
            'Tout du Starter',
            'Logo personnalisé inclus',
            'Photos professionnelles incluses',
            'Design responsive',
            'Formulaire de contact',
            'Optimisation SEO de base'
        ]
    },
    {
        id: 'standard',
        name: 'Standard',
        price: 1499,
        badge: 'Business',
        description: 'Solution complète avec réseaux sociaux',
        popular: false,
        deliveryDays: 3,
        workHours: 24,
        features: [
            'Tout du Starter +',
            'Logo et Photos inclus',
            'Réseaux sociaux inclus',
            'SEO avancé',
            '5-7 pages',
            'Formation utilisation',
            'Support technique'
        ]
    }
];

// Optimisation de la rentabilité des produits
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
        price: 299,
        icon: 'bx-share-alt',
        workHours: 3,
        availableFor: ['starter'],
        details: [
            'Configuration des profils',
            'Intégration au site',
            'Stratégie de base',
            'Formation utilisation'
        ]
    },
    {
        id: 'crm',
        name: 'CRM Intégré',
        price: 599,
        icon: 'bx-data',
        workHours: 5,
        availableFor: ['starter', 'starter+', 'standard'],
        details: [
            'Gestion des clients',
            'Suivi des interactions',
            'Tableau de bord personnalisé',
            'Formation incluse',
            'Support technique'
        ]
    },
    {
        id: 'google_my_business',
        name: 'Pack complet Google My Business',
        price: 299,
        icon: 'bx-map-pin',
        workHours: 2,
        availableFor: ['starter', 'starter+', 'standard'],
        description: 'Création, optimisation image, prospection locale, diffusion des informations commerciales',
        details: [
            'Création et optimisation du profil',
            'Gestion des avis et de la réputation',
            'Diffusion d\'informations commerciales ciblées'
        ]
    },
    {
        id: 'flyers_500',
        name: 'Pack 500 flyers',
        price: 219,
        icon: 'bx-paper-plane',
        workHours: 4,
        description: 'Conception, impression et distribution de 500 flyers',
        details: [
            'Distribution: 500 × 0,07 = 35 €',
            'Frais kilométriques: 15,60 €',
            'Impression: 54,50 €',
            'Création flyer: 40 €',
            'Service de suivi et rapport de distribution'
        ]
    },
    {
        id: 'flyers_1000',
        name: 'Pack 1000 flyers',
        price: 379,
        icon: 'bx-paper-plane',
        workHours: 8,
        description: 'Conception, impression et distribution de 1000 flyers',
        details: [
            'Distribution: 1000 × 0,07 = 70 €',
            'Frais kilométriques: 25 €',
            'Impression: 95 €',
            'Création flyer: 40 €',
            'Service de suivi et rapport de distribution'
        ]
    },
    {
        id: 'flyers_1500',
        name: 'Pack 1500 flyers',
        price: 529,
        icon: 'bx-paper-plane',
        workHours: 12,
        description: 'Conception, impression et distribution de 1500 flyers',
        details: [
            'Distribution: 1500 × 0,07 = 105 €',
            'Frais kilométriques: 35 €',
            'Impression: 130 €',
            'Création flyer: 40 €',
            'Service de suivi et rapport de distribution'
        ]
    },
    {
        id: 'print_design',
        name: 'Création de Papier à Imprimer + Carte de Visite (3 modèles)',
        price: 129,
        icon: 'bx-printer',
        workHours: 1,
        availableFor: ['starter', 'starter+', 'standard'],
        description: 'Conception professionnelle de documents prêts à imprimer et cartes de visite',
        details: [
            'Design personnalisé selon votre charte graphique',
            'Création de carte de visite assortie',
            'Format optimisé pour l\'impression',
            'Fichiers sources inclus',
            'Deux révisions incluses',
            'Trois modèles différents au choix'
        ]
    },
    {
        id: 'ads_management',
        name: 'Gestion de Campagne Publicitaire',
        price: 199,
        icon: 'bx-target-lock',
        workHours: 2,
        availableFor: ['starter', 'starter+', 'standard'],
        description: 'Gestion professionnelle de vos campagnes publicitaires (budget publicitaire non inclus)',
        details: [
            'Tarif fixe de 199€ pour la gestion (quel que soit le budget)',
            'Budget publicitaire facturé séparément selon vos besoins',
            'Ciblage précis et création des visuels',
            'Optimisation continue et suivi des performances'
        ]
    },
    {
        id: 'social_visuals_8',
        name: 'Réseaux sociaux - 8 visuels/mois',
        price: 99,
        icon: 'bx-image',
        description: 'Création et gestion de 8 visuels par mois pour vos réseaux sociaux',
        hours: 1,
        details: [
            'Création de designs professionnels',
            'Rédaction des légendes optimisées',
            'Planification et publication'
        ]
    },
    {
        id: 'social_visuals_15',
        name: 'Réseaux sociaux - 15 visuels/mois',
        price: 179,
        icon: 'bx-image',
        description: 'Création et gestion de 15 visuels par mois pour vos réseaux sociaux',
        hours: 2,
        details: [
            'Création de designs professionnels',
            'Rédaction des légendes optimisées',
            'Planification et publication'
        ]
    },
    {
        id: 'social_visuals_30',
        name: 'Réseaux sociaux - 30 visuels/mois',
        price: 299,
        icon: 'bx-image',
        description: 'Création et gestion de 30 visuels par mois pour vos réseaux sociaux',
        hours: 4,
        details: [
            'Création de designs professionnels',
            'Rédaction des légendes optimisées',
            'Planification et publication'
        ]
    },
    {
        id: 'social_videos_4',
        name: 'Réseaux sociaux - 4 vidéos/mois',
        price: 169,
        icon: 'bx-video',
        description: 'Création et gestion de 4 vidéos par mois pour vos réseaux sociaux',
        hours: 2,
        details: [
            'Vidéos adaptées aux réseaux sociaux',
            'Ajout d\'animations, textes et sous-titres',
            'Montage optimisé pour l\'engagement',
            'Analyse des performances'
        ]
    },
    {
        id: 'social_videos_8',
        name: 'Réseaux sociaux - 8 vidéos/mois',
        price: 299,
        icon: 'bx-video',
        description: 'Création et gestion de 8 vidéos par mois pour vos réseaux sociaux',
        hours: 3,
        details: [
            'Vidéos adaptées aux réseaux sociaux',
            'Ajout d\'animations, textes et sous-titres',
            'Montage optimisé pour l\'engagement',
            'Analyse des performances'
        ]
    },
    {
        id: 'social_videos_15',
        name: 'Réseaux sociaux - 15 vidéos/mois',
        price: 529,
        icon: 'bx-video',
        description: 'Création et gestion de 15 vidéos par mois pour vos réseaux sociaux',
        hours: 5,
        details: [
            'Vidéos adaptées aux réseaux sociaux',
            'Ajout d\'animations, textes et sous-titres',
            'Montage optimisé pour l\'engagement',
            'Analyse des performances et recommandations'
        ]
    },
    {
        id: 'social_pack_small',
        name: 'Pack Complet - 8 visuels + 4 vidéos',
        price: 229,
        icon: 'bx-package',
        workHours: 3,
        description: 'Pack mensuel de 8 visuels et 4 vidéos pour vos réseaux sociaux',
        details: [
            '8 visuels statiques professionnels',
            '4 vidéos optimisées pour les réseaux sociaux',
            'Planification et publication',
            'Rapport mensuel de performance'
        ]
    },
    {
        id: 'social_pack_medium',
        name: 'Pack Complet - 15 visuels + 8 vidéos',
        price: 429,
        icon: 'bx-package',
        workHours: 5,
        description: 'Pack mensuel de 15 visuels et 8 vidéos pour vos réseaux sociaux',
        details: [
            '15 visuels statiques professionnels',
            '8 vidéos optimisées pour les réseaux sociaux',
            'Planification et publication',
            'Rapport mensuel de performance'
        ]
    },
    {
        id: 'social_pack_large',
        name: 'Pack Complet - 30 visuels + 15 vidéos',
        price: 799,
        icon: 'bx-package',
        workHours: 9,
        description: 'Pack mensuel de 30 visuels et 15 vidéos pour vos réseaux sociaux',
        details: [
            '30 visuels statiques professionnels',
            '15 vidéos optimisées pour les réseaux sociaux',
            'Planification et publication',
            'Rapport mensuel de performance',
            'Recommandations stratégiques'
        ]
    }
];

// 1. Assurons-nous que toutes les options ont une propriété workHours valide
// Cette ligne doit être placée APRÈS la définition de OPTIONS mais AVANT les computed properties
OPTIONS.forEach(option => {
    // Si l'option a hours mais pas workHours, copier hours vers workHours
    if (option.hours && !option.workHours) {
        option.workHours = option.hours;
    }
    // Si l'option n'a ni workHours ni hours, définir une valeur par défaut
    if (!option.workHours && !option.hours) {
        option.workHours = 1; // Valeur par défaut
    }
});

// Modification de la computed property pour gérer les options incluses par forfait
const includedOptions = computed(() => {
    switch (selectedForfait.value) {
        case 'starter+':
            return ['logoPhotos'];
        case 'standard':
            return ['logoPhotos', 'socialMedia'];
        default:
            return [];
    }
});

// Modification de la computed property availableOptions pour gérer les options sans availableFor
const availableOptions = computed(() => {
    return OPTIONS.filter(option => {
        // Si l'option n'a pas de propriété availableFor, on considère qu'elle est disponible pour tous les forfaits
        if (!option.availableFor) {
            return true;
        }

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

// 2. Correction de la computed property optionAnalytics pour s'assurer qu'elle utilise workHours
const optionAnalytics = computed(() => {
    return OPTIONS.map(option => {
        const workHours = option.workHours || option.hours || 1; // Utiliser une valeur par défaut si nécessaire
        const netRevenue = calculateNet(option.price);
        return {
            ...option,
            workHours, // S'assurer que workHours est défini
            charges: calculateCharges(option.price),
            netRevenue,
            hourlyRate: netRevenue / workHours
        };
    });
});

// 3. Correction de la fonction calculateHourlyRate pour éviter les divisions par zéro
const calculateHourlyRate = (netAmount, hours) => {
    return hours > 0 ? netAmount / hours : 0; // Éviter la division par zéro
};

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
            totalHours += includedOption.workHours || includedOption.hours || 0;
        }
    });

    // Ajouter les heures des options sélectionnées manuellement
    const selectedOptionsPrices = selectedOptions.value
        .filter(optId => !includedOptions.value.includes(optId))
        .map(optId => {
            const option = OPTIONS.find(opt => opt.id === optId);
            if (option) {
                totalHours += option.workHours || option.hours || 0;
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
        hours: totalHours,
        hourlyRate: totalHours > 0 ? netAmount / totalHours : 0 // Éviter la division par zéro
    };
});

// Grouper les options par catégorie
const marketingOptions = computed(() => {
    return optionAnalytics.value.filter(option =>
        option.id.startsWith('social_') ||
        option.id.startsWith('ads_') ||
        option.id === 'google_my_business'
    );
});

const printOptions = computed(() => {
    return optionAnalytics.value.filter(option =>
        option.id.startsWith('flyers_') ||
        option.id === 'print_design'
    );
});

const websiteOptions = computed(() => {
    return optionAnalytics.value.filter(option =>
        !option.id.startsWith('social_') &&
        !option.id.startsWith('ads_') &&
        !option.id.startsWith('flyers_') &&
        option.id !== 'google_my_business'
    );
});

// Trier les options par taux horaire (du plus élevé au plus bas)
const sortedByHourlyRate = computed(() => {
    return [...optionAnalytics.value].sort((a, b) => b.hourlyRate - a.hourlyRate);
});

// Top 5 des options les plus rentables
const topProfitableOptions = computed(() => {
    return sortedByHourlyRate.value.slice(0, 5);
});

// Ajout des computed properties pour l'analyse de rentabilité
const activeTab = ref('web'); // Pour gérer les onglets d'analyse par catégorie

// Options Web les plus rentables
const topWebOptions = computed(() => {
    return optionAnalytics.value
        .filter(option =>
            option.id === 'crm' ||
            option.id === 'logoPhotos' ||
            option.id === 'socialMedia' ||
            option.id === 'ecommerce'
        )
        .sort((a, b) => b.hourlyRate - a.hourlyRate)
        .slice(0, 3);
});

// Options Marketing Digital les plus rentables
const topMarketingOptions = computed(() => {
    return optionAnalytics.value
        .filter(option =>
            option.id === 'ads_management' ||
            option.id.startsWith('social_') ||
            option.id === 'google_my_business'
        )
        .sort((a, b) => b.hourlyRate - a.hourlyRate)
        .slice(0, 5);
});

// Mise à jour de la computed property pour les options d'impression avec les prix Vistaprint
const printOptionsWithComparison = computed(() => {
    // Prix Vistaprint pour différents produits
    const vistaprint = {
        flyers_500: 69,
        flyers_1000: 109,
        flyers_1500: 149,
        print_design: 49 // Prix estimé pour cartes de visite + papier à en-tête chez Vistaprint
    };

    return printOptions.value.map(option => {
        let competitorPrice = null;

        // Attribuer le prix Vistaprint correspondant
        if (option.id === 'flyers_500') competitorPrice = vistaprint.flyers_500;
        if (option.id === 'flyers_1000') competitorPrice = vistaprint.flyers_1000;
        if (option.id === 'flyers_1500') competitorPrice = vistaprint.flyers_1500;
        if (option.id === 'print_design') competitorPrice = vistaprint.print_design;

        // Calculer la différence si un prix concurrent existe
        let comparison = null;
        if (competitorPrice) {
            comparison = {
                competitorPrice,
                difference: option.price - competitorPrice,
                percentageDifference: ((option.price - competitorPrice) / competitorPrice * 100).toFixed(0)
            };
        }

        return {
            ...option,
            competitorPrice,
            comparison
        };
    });
});

// Fonction pour déterminer la classe de couleur en fonction du taux horaire
const getHourlyRateColorClass = (rate) => {
    if (rate >= 70) return 'text-green-600';
    if (rate >= 50) return 'text-green-500';
    if (rate >= 30) return 'text-yellow-500';
    return 'text-red-500';
};

// Fonction pour obtenir un texte d'évaluation en fonction du taux horaire
const getRentabilityText = (rate) => {
    if (rate >= 70) return 'Excellent';
    if (rate >= 50) return 'Très bon';
    if (rate >= 30) return 'Bon';
    if (rate >= 20) return 'Acceptable';
    return 'À optimiser';
};
</script>
