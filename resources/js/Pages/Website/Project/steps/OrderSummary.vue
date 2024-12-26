<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">
            Récapitulatif de votre commande
        </h2>

        <div class="space-y-6">
            <!-- Forfait sélectionné -->
            <div v-if="selectedForfait" class="border-b border-gray-200 dark:border-gray-700 pb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    Forfait choisi
                </h3>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">
                            {{ selectedForfait.name }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ selectedForfait.description }}
                        </p>
                    </div>
                    <p class="font-medium text-gray-900 dark:text-white">
                        {{ selectedForfait.price }}€
                    </p>
                </div>
            </div>

            <!-- Options sélectionnées -->
            <div v-if="selectedOptions.length > 0" class="border-b border-gray-200 dark:border-gray-700 pb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    Options additionnelles
                </h3>
                <div class="space-y-4">
                    <div v-for="option in selectedOptions" :key="option.id" class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ option.name }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ option.description }}
                            </p>
                        </div>
                        <p class="font-medium text-gray-900 dark:text-white">
                            {{ option.price }}€
                        </p>
                    </div>
                </div>
            </div>

            <!-- Plan de maintenance -->
            <div v-if="selectedMaintenancePlan" class="border-b border-gray-200 dark:border-gray-700 pb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    Plan de maintenance
                </h3>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-white">
                            {{ selectedMaintenancePlan.name }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ selectedMaintenancePlan.description }}
                        </p>
                    </div>
                    <p class="font-medium text-gray-900 dark:text-white">
                        {{ selectedMaintenancePlan.price }}€/an
                    </p>
                </div>
            </div>

            <!-- Total -->
            <div class="pt-4">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                        Total HT
                    </p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ totalPrice }}€
                    </p>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    TVA non applicable, art. 293 B du CGI
                </p>
            </div>

            <!-- Section Authentification -->
            <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-6">
                    Connexion requise
                </h3>

                <div v-if="!isAuthenticated" class="space-y-6">
                    <!-- Choix de connexion -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button @click="showLoginForm = true; showRegisterForm = false" :class="[
                            'px-6 py-3 rounded-lg font-medium transition-colors w-full sm:w-auto text-center',
                            showLoginForm
                                ? 'bg-blue-600 text-white hover:bg-blue-700'
                                : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600'
                        ]">
                            J'ai déjà un compte
                        </button>
                        <button @click="showRegisterForm = true; showLoginForm = false" :class="[
                            'px-6 py-3 rounded-lg font-medium transition-colors w-full sm:w-auto text-center',
                            showRegisterForm
                                ? 'bg-blue-600 text-white hover:bg-blue-700'
                                : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600'
                        ]">
                            Créer un compte
                        </button>
                    </div>

                    <!-- Formulaire de connexion -->
                    <div v-if="showLoginForm" class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                        <form @submit.prevent="login" class="space-y-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Email
                                </label>
                                <input type="email" id="email" v-model="loginForm.email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            </div>
                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Mot de passe
                                </label>
                                <input type="password" id="password" v-model="loginForm.password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            </div>
                            <button type="submit"
                                class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Se connecter
                            </button>
                        </form>
                    </div>

                    <!-- Formulaire d'inscription -->
                    <div v-if="showRegisterForm" class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                        <form @submit.prevent="register" class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nom complet
                                </label>
                                <input type="text" id="name" v-model="registerForm.name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            </div>
                            <div>
                                <label for="register-email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Email
                                </label>
                                <input type="email" id="register-email" v-model="registerForm.email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            </div>
                            <div>
                                <label for="register-password"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Mot de passe
                                </label>
                                <input type="password" id="register-password" v-model="registerForm.password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            </div>
                            <div>
                                <label for="password-confirmation"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Confirmer le mot de passe
                                </label>
                                <input type="password" id="password-confirmation"
                                    v-model="registerForm.password_confirmation"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            </div>
                            <button type="submit"
                                class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Créer mon compte
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Message utilisateur connecté -->
                <div v-else class="text-center text-gray-600 dark:text-gray-400">
                    Connecté en tant que <span class="font-medium text-gray-900 dark:text-white">{{
                        page.props.auth.user.name }}</span>
                </div>

                <!-- Bouton de validation -->
                <button @click="handleSubmit" :disabled="!isAuthenticated"
                    class="w-full mt-8 px-6 py-3 text-base font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ isAuthenticated ? 'Valider ma commande' : 'Connectez-vous pour continuer' }}
                </button>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, ref } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'

const page = usePage()
const isAuthenticated = computed(() => page.props.auth?.user)

const props = defineProps({
    formData: {
        type: Object,
        required: true
    }
})

const showLoginForm = ref(false)
const showRegisterForm = ref(false)

const loginForm = useForm({
    email: '',
    password: ''
})

const registerForm = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

// Définition des forfaits
const forfaits = [
    {
        id: 'starter',
        name: 'Starter',
        price: 349,
        badge: 'Essentiel',
        description: 'Idéal pour les petites entreprises qui souhaitent établir leur présence en ligne.',
        popular: false
    },
    {
        id: 'standard',
        name: 'Standard',
        price: 699,
        badge: 'Populaire',
        description: 'Solution complète pour une présence web professionnelle et impactante.',
        popular: true
    },
    {
        id: 'premium',
        name: 'Premium',
        price: 1399,
        badge: 'Sur-mesure',
        description: 'Solution premium tout inclus avec accompagnement personnalisé.',
        popular: false
    }
]

// Définition des options additionnelles
const additionalOptions = [
    {
        id: 'logoPhotos',
        name: 'Création de logo + Photos Pro',
        description: 'Design professionnel de votre identité visuelle',
        price: 59,
        icon: 'bx-palette'
    },
    {
        id: 'socialMedia',
        name: 'Réseaux Sociaux',
        description: 'Création et gestion de vos réseaux sociaux',
        price: 199,
        icon: 'bx-share-alt'
    },
    {
        id: 'Dashboard',
        name: 'Dashboard (CRM)',
        description: 'Suivi détaillé de vos performances',
        price: 299,
        icon: 'bx-line-chart'
    },
    {
        id: 'ecommerce',
        name: 'E-commerce',
        description: 'Solution complète de vente en ligne',
        price: 499,
        icon: 'bx-store'
    }
]

// Définition des plans de maintenance
const maintenancePlans = [
    {
        id: 'basic',
        name: 'Essentiel',
        description: 'Maintenance de base annuelle',
        price: 49,
        features: [
            'Mises à jour de sécurité',
            'Sauvegardes mensuelles',
            'Support par email',
            'Temps de réponse sous 72h',
            'Modifications mineures'
        ]
    },
    {
        id: 'pro',
        name: 'Professionnel',
        description: 'Maintenance complète annuelle',
        price: 129,
        features: [
            'Mises à jour prioritaires',
            'Sauvegardes hebdomadaires',
            'Support prioritaire',
            'Temps de réponse sous 24h',
            'Modifications illimitées'
        ]
    }
]

// Computed properties
const selectedForfait = computed(() => {
    if (!props.formData.template?.selectedForfait) return null
    return forfaits.find(f => f.id === props.formData.template.selectedForfait)
})

const selectedOptions = computed(() => {
    if (!props.formData.options?.selectedOptions) return []
    return additionalOptions.filter(opt =>
        props.formData.options.selectedOptions.includes(opt.id)
    )
})

const selectedMaintenancePlan = computed(() => {
    if (!props.formData.options?.maintenancePlan) return null
    return maintenancePlans.find(p => p.id === props.formData.options.maintenancePlan)
})

const totalPrice = computed(() => {
    let total = selectedForfait.value?.price || 0
    total += selectedOptions.value.reduce((sum, opt) => sum + opt.price, 0)
    total += selectedMaintenancePlan.value?.price || 0
    return total
})

const login = () => {
    loginForm.post(route('login'), {
        onSuccess: () => {
            showLoginForm.value = false
        }
    })
}

const register = () => {
    registerForm.post(route('register'), {
        onSuccess: () => {
            showRegisterForm.value = false
        }
    })
}

const handleSubmit = () => {
    if (!isAuthenticated.value) return;

    // Ajout du log des données finales
    console.log('Récapitulatif final de la commande :', {
        forfait: {
            nom: selectedForfait.value?.name,
            prix: selectedForfait.value?.price
        },
        options: {
            selections: selectedOptions.value.map(opt => ({
                nom: opt.name,
                prix: opt.price
            })),
            maintenance: {
                plan: selectedMaintenancePlan.value?.name,
                prix: selectedMaintenancePlan.value?.price
            }
        },
        total: totalPrice.value,
        client: {
            authentifie: isAuthenticated.value,
            utilisateur: page.props.auth?.user
        }
    });

    emit('submit');
};
</script>
