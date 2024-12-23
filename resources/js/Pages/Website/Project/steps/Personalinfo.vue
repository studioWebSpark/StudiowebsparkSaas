<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">
            Vos informations
        </h2>

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Type de client
                </label>
                <div class="mt-2 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" v-model="localFormData.clientType" value="individual" class="form-radio">
                        <span class="ml-2">Particulier</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" v-model="localFormData.clientType" value="professional" class="form-radio">
                        <span class="ml-2">Professionnel</span>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nom
                    </label>
                    <input type="text" v-model="localFormData.lastName"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Prénom
                    </label>
                    <input type="text" v-model="localFormData.firstName"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" v-model="localFormData.email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Téléphone
                    </label>
                    <input type="tel" v-model="localFormData.phone"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <div v-if="localFormData.clientType === 'professional'">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nom de l'entreprise
                        </label>
                        <input type="text" v-model="localFormData.companyName"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            SIRET
                        </label>
                        <input type="text" v-model="localFormData.siret"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    formData: {
        type: Object,
        required: true
    }
})

const emit = defineEmits(['update:formData'])

const localFormData = ref({
    clientType: 'individual',
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    companyName: '',
    siret: '',
    ...props.formData.personal
})

watch(localFormData, (newValue) => {
    emit('update:formData', { personal: newValue })
}, { deep: true })
</script>
