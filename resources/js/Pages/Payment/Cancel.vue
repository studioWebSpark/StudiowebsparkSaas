<template>
    <AppLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Paiement annulé
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-center">
                            <XCircleIcon class="mx-auto h-12 w-12 text-red-500" />
                            <h3 class="mt-4 text-lg font-medium text-gray-900">
                                Le paiement a été annulé
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Vous pouvez retourner à l'accueil ou réessayer le paiement quand vous le souhaitez.
                            </p>
                        </div>

                        <div class="mt-6 flex justify-center space-x-4">
                            <Link href="/"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Retour à l'accueil
                            </Link>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { XCircleIcon } from '@heroicons/vue/24/solid';

defineProps({
    project: {
        type: Object,
        required: false,
        default: null
    }
});
</script>