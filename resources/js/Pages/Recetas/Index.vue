<template>
    <Head title="Recetas" />

    <AuthenticatedLayout>
        <template #header>
            Planes Nutricionales Para Pacientes
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="bg-white rounded-md w-full">
                    <div class="flex justify-end item-center py-2">
                    <Link :href="route('recetas.create')"
                        class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                        Crear Plan Nutricional
                    </Link>
                </div>
                    <div>
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                            <div v-if="props.recetas.length > 0"
                                class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Nombre de Plan Nutricional
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Descripcion
                                            </th>
                                            <th v-if="$page.props.auth.user.roles[0].name === 'admin'"
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="receta in props.recetas" :key="receta.id">
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ receta.titulo }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{ receta.descripcion }}</p>
                                            </td>
                                            <td v-if="$page.props.auth.user.roles[0].name === 'admin'" class="px-5 py-5 border-b border-gray-200 bg-white text-sm space-x-2">
                                                <button @click="mostrarCita(receta.id)"
                                                    class="bg-yellow-600 px-2 py-1 rounded-md text-white font-semibold tracking-wide cursor-pointer">Ver
                                                    Plan Nutricional</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p v-else>
                                No Hay Planes Nutricionales
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6">
            <p class="text-3xl font-extrabold text-blue-800">Recomendaciones alimenticias en 3 categorías: Hipocalórica, normocalorica y hipercalorica</p>
        </div>

        <Modal :show="verCita">
            <div role="alert">
                <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                    <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4 text-2xl">
                        Receta
                    </h1>
                    <div>
                        <h3 class="text-gray-800 leading-tight tracking-normal text-xl">
                            Titulo: {{ citaSeleccionada.titulo }}</h3>
                    </div>
                    <div>
                        <p class="text-gray-800 leading-tight tracking-normal text-xl mt-4">Decripcion: {{ citaSeleccionada.descripcion }}</p>
                    </div>

                    <div v-html="citaSeleccionada.receta">
                    </div>


                    <div class="mt-6 flex items-center justify-start w-full">

                        <button
                            class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm w-full"
                            @click="mostrarCita">Cancel</button>
                    </div>
                    <button
                        class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
                        @click="mostrarCita" aria-label="close modal" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20"
                            height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>

                </div>
            </div>
        </Modal>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { reactive, ref } from 'vue';

const props = defineProps({
    recetas: Object,
})

let verCita = ref(false)
let citaSeleccionada = ref(null)

const form = reactive({
    id: null,
    paciente: null,
    doctor: null,
    descripcion: null,
    resultado: null
})


const mostrarCita = (id) => {
    citaSeleccionada.value = props.recetas.find((cita) => cita.id === id);
    verCita.value = !verCita.value
}

</script>
