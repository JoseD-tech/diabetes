<template>
    <Head title="Inicio De Sesion" />
    <!-- component -->
    <div class="bg-white dark:bg-gray-900">
        <div class="flex justify-center h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/3"
                style="background-image: url(https://junctionroadfp.com/wp-content/uploads/2022/04/shutterstock_1182539971.jpg)">
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-50">
                    <div>
                        <h2 class="text-4xl font-bold text-white">Sistema Experto Para El Diagnostico Diabetico</h2>

                        <p class="max-w-xl mt-3 text-gray-300">Lorem ipsum dolor sit, amet consectetur adipisicing elit. In
                            autem ipsa, nulla laboriosam dolores, repellendus perferendis libero suscipit nam temporibus
                            molestiae</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
                <div class="flex-1">
                    <div class="text-center">
                        <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">DiaSyS</h2>

                        <p class="mt-3 text-gray-500 dark:text-gray-300">Inicia Sesion con tu cuenta</p>
                    </div>

                    <div class="mt-8">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Direccion de
                                    Correo</label>
                                <input type="email" v-model="form.email" name="email" id="email" required autofocus
                                    placeholder="example@example.com"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                                <InputError class="mt-2" :message="form.errors.email" />

                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password"
                                        class="text-sm text-gray-600 dark:text-gray-200">Contraseña</label>
                                    <a href="#"
                                        class="text-sm text-gray-400 focus:text-blue-500 hover:text-blue-500 hover:underline">¿Olvidates
                                        tu contraseña?</a>
                                </div>

                                <input type="password" name="password" id="password" v-model="form.password" placeholder="tu calve de acceso aqui"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                                <InputError class="mt-2" :message="form.errors.password" />

                            </div>

                            <div class="mt-6">
                                <button
                                    class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Inicion de Sesion
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
