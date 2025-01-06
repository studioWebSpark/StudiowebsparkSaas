<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Log in" />

    <div class="min-h-screen lg:flex lg:justify-between">
        <div class="flex flex-col justify-center flex-1 px-4 py-12 bg-white sm:px-6 lg:px-20 xl:px-24">
            <div class="flex-1 max-w-sm mx-auto lg:max-w-md">
                <AuthenticationCardLogo class="w-auto h-8 mx-auto lg:mx-0" />

                <h1
                    class="mt-10 text-3xl font-bold text-center text-gray-900 lg:mt-20 xl:mt-32 sm:text-4xl xl:text-5xl font-pj lg:text-left">
                    Connexion à votre compte
                </h1>

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="mt-10">
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <TextInput id="email" v-model="form.email" type="email"
                                    class="block w-full py-4 pl-12 pr-4 text-base font-normal text-gray-900 placeholder-gray-600 transition-all duration-200 border border-gray-300 rounded-xl bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-900 focus:ring-gray-900"
                                    required autofocus placeholder="Email" />
                            </div>
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <label for="password" class="sr-only">Mot de passe</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <TextInput id="password" v-model="form.password" type="password"
                                    class="block w-full py-4 pl-12 pr-4 text-base font-normal text-gray-900 placeholder-gray-600 transition-all duration-200 border border-gray-300 rounded-xl bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-900 focus:ring-gray-900"
                                    required placeholder="Mot de passe" />
                            </div>
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-5">
                        <label class="flex items-center">
                            <Checkbox v-model:checked="form.remember" name="remember"
                                class="w-5 h-5 text-gray-900 border-gray-300 rounded focus:ring-gray-900" />
                            <span class="ml-3 text-base font-normal text-gray-900">Se souvenir de moi</span>
                        </label>

                        <Link v-if="canResetPassword" :href="route('password.request')"
                            class="text-base font-medium text-gray-500 rounded hover:text-gray-900 hover:underline focus:outline-none focus:ring-1 focus:ring-gray-900 focus:ring-offset-2">
                        Mot de passe oublié ?
                        </Link>
                    </div>

                    <div class="relative mt-8">
                        <div class="absolute -inset-2">
                            <div class="w-full h-full mx-auto opacity-30 blur-lg filter"
                                style="background: linear-gradient(90deg, #44ff9a -0.55%, #44b0ff 22.86%, #8b44ff 48.36%, #ff6644 73.33%, #ebff70 99.34%)">
                            </div>
                        </div>

                        <PrimaryButton
                            class="relative flex items-center justify-center w-full px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-gray-900 border border-transparent rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 hover:bg-gray-600"
                            :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Se connecter
                        </PrimaryButton>
                    </div>
                </form>

                <p class="mt-10 text-base font-normal text-center text-gray-900 lg:mt-20 xl:mt-32 lg:text-left">
                    Pas encore de compte ?
                    <Link :href="route('register')"
                        class="font-bold rounded focus:outline-none focus:ring-1 focus:ring-gray-900 focus:ring-offset-2 hover:underline">
                    Inscrivez-vous maintenant
                    </Link>
                </p>
            </div>
        </div>

        <div class="relative hidden lg:grid flex-1 w-full bg-gray-900 lg:max-w-2xl">
            <div class="absolute inset-0">
                <img class="object-cover object-top w-full h-full scale-150 -rotate-90 opacity-10"
                    src="https://cdn.rareblocks.xyz/collection/clarity/images/sign-up/4/background-pattern.png"
                    alt="" />
            </div>

            <div class="relative max-w-sm mx-auto px-20 xl:px-24 py-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-800 rounded-xl">
                    <svg class="w-auto h-5 text-white" viewBox="0 0 33 23" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M32.0011 4.7203L30.9745 0C23.5828 0.33861 18.459 3.41404 18.459 12.4583V22.8687H31.3725V9.78438H26.4818C26.4819 6.88236 28.3027 5.17551 32.0011 4.7203Z" />
                        <path
                            d="M13.5421 4.7203L12.5155 0C5.12386 0.33861 0 3.41413 0 12.4584V22.8687H12.914V9.78438H8.02029C8.02029 6.88236 9.84111 5.17551 13.5421 4.7203Z" />
                    </svg>
                </div>

                <blockquote class="mt-14">
                    <p class="text-2xl font-medium leading-relaxed text-white lg:text-3xl">
                        "Créez votre site web sur mesure avec notre équipe d'experts. Simple, rapide et professionnel."
                    </p>
                </blockquote>

                <div class="flex items-center mt-12">
                    <div class="ml-4">
                        <p class="text-xl font-bold text-white">Studio Webspark</p>
                        <p class="mt-px text-lg font-normal text-gray-400">Agence Web</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
