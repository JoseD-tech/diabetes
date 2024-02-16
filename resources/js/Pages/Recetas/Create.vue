<template>
    <Head title="About us" />

    <AuthenticatedLayout>
        <template #header>
            Crear Plan Nutricional
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-center">
                    <form @submit.prevent="submit" class="w-full">
                        <div class="grid gap-6 mb-6 lg:grid-cols-2">
                            <div>
                                <label for="nombre" class="block mb-2 text-sm font-medium text-black">Nombre De
                                    Receta:</label>
                                <input type="text" v-model="form.titulo"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="nombre de la receta" required>
                            </div>
                            <div>
                                <label for="apellido" class="block mb-2 text-sm font-medium text-black">Descripcion:</label>
                                <input type="text" v-model="form.descripcion"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="escribe una descripcion guia de la receta" required>
                            </div>
                            <!--<div class="col-span-2">
                                <h3 class="text-2xl capitalize mb-4">Motor de Inferencia</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                    <div class="mb-5">
                                        <label class="mb-3 block text-base font-medium text-[#07074D]">
                                            ¿Usted presenta orina constante? (OC)
                                        </label>
                                        <div class="flex items-center space-x-6">
                                            <div class="flex items-center">
                                                <input type="radio" id="oc1" :value="true" v-model="form.oc" class="h-5 w-5" />
                                                <label for="oc1" class="pl-3 text-base font-medium text-[#07074D]">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" id="oc2" :value="false" v-model="form.oc" class="h-5 w-5" />
                                                <label for="oc2" class="pl-3 text-base font-medium text-[#07074D]">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="mb-5">
                                            <label class="mb-3 block text-base font-medium text-[#07074D]">
                                                ¿Usted presenta pérdida de peso inexplicable? (PP)
                                            </label>
                                            <div class="flex items-center space-x-6">
                                                <div class="flex items-center">
                                                    <input type="radio" :value="true" id="pp1" v-model="form.pp" class="h-5 w-5" />
                                                    <label for="pp1"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="radio" :value="false" id="pp2" v-model="form.pp" class="h-5 w-5" />
                                                    <label for="pp2"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="mb-5">
                                            <label class="mb-3 block text-base font-medium text-[#07074D]">
                                                ¿Usted presenta hinchazón en extremidades? (PHE)
                                            </label>
                                            <div class="flex items-center space-x-6">
                                                <div class="flex items-center">
                                                    <input type="radio" id="phe1" :value="true" v-model="form.phe" class="h-5 w-5" />
                                                    <label for="phe1"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="radio" id="phe2" :value="false" v-model="form.phe" class="h-5 w-5" />
                                                    <label for="phe2"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="mb-5">
                                            <label class="mb-3 block text-base font-medium text-[#07074D]">
                                                ¿Usted presenta Entumecimiento de manos y pies? (EMP)
                                            </label>
                                            <div class="flex items-center space-x-6">
                                                <div class="flex items-center">
                                                    <input type="radio" id="emp1" :value="true" v-model="form.emp" class="h-5 w-5" />
                                                    <label for="emp1"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="radio" id="emp2" :value="false" v-model="form.emp" class="h-5 w-5" />
                                                    <label for="emp2"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="mb-5">
                                            <label class="mb-3 block text-base font-medium text-[#07074D]">
                                                ¿Usted presenta hambre excesiva? (HE)
                                            </label>
                                            <div class="flex items-center space-x-6">
                                                <div class="flex items-center">
                                                    <input type="radio"  id="he1" :value="true" v-model="form.he" class="h-5 w-5" />
                                                    <label for="he1"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="radio"  id="he2" :value="false" v-model="form.he" class="h-5 w-5" />
                                                    <label for="he2"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="mb-5">
                                            <label class="mb-3 block text-base font-medium text-[#07074D]">
                                                ¿Usted presenta Aumento de fatiga y debilidad? (AFD)
                                            </label>
                                            <div class="flex items-center space-x-6">
                                                <div class="flex items-center">
                                                    <input type="radio" id="efd1" :value="true" v-model="form.afd" class="h-5 w-5" />
                                                    <label for="efd1"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="radio" id="efd2" :value="false" v-model="form.afd" class="h-5 w-5" />
                                                    <label for="edf2"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="mb-5">
                                            <label class="mb-3 block text-base font-medium text-[#07074D]">
                                                ¿Usted presenta perdida de equilibrio o mareo? (PEM)
                                            </label>
                                            <div class="flex items-center space-x-6">
                                                <div class="flex items-center">
                                                    <input type="radio" id="pem1" :value="true" v-model="form.pem" class="h-5 w-5" />
                                                    <label for="pem1"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="radio" id="pem2" :value="false" v-model="form.pem" class="h-5 w-5" />
                                                    <label for="pem2"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="mb-5">
                                            <label class="mb-3 block text-base font-medium text-[#07074D]">
                                                ¿Usted presenta dolor de cabeza? (DC)
                                            </label>
                                            <div class="flex items-center space-x-6">
                                                <div class="flex items-center">
                                                    <input type="radio" id="dc1" :value="true" v-model="form.dc" class="h-5 w-5" />
                                                    <label for="dc1"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="radio" id="dc2" :value="false" v-model="form.dc" class="h-5 w-5" />
                                                    <label for="dc2"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="mb-5">
                                            <label class="mb-3 block text-base font-medium text-[#07074D]">
                                                ¿Usted presenta ojos amarillos? (OA)
                                            </label>
                                            <div class="flex items-center space-x-6">
                                                <div class="flex items-center">
                                                    <input type="radio" id="oa1" :value="true" v-model="form.oa" class="h-5 w-5" />
                                                    <label for="oa1"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="radio" id="oa2" :value="false" v-model="form.oa" class="h-5 w-5" />
                                                    <label for="oa2"
                                                        class="pl-3 text-base font-medium text-[#07074D]">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <div>
                                <label for="telefono" class="block mb-2 text-sm font-medium text-black">Categoria de la receta</label>
                                <select v-model="form.categoria"
                                    class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border">
                                    <option selected disabled>Seleccione un categoria</option>
                                    <template v-for="categoria in $attrs.categorias" :key="categoria.id">
                                        <option :value="categoria.id">
                                            {{ categoria.categoria }}</option>
                                    </template>

                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="receta" class="block mb-2 text-sm font-medium text-black capitalize">Como hacer
                                    la dieta</label>
                                <QuillEditor class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" theme="snow" contentType="html"  v-model:content="form.receta"></QuillEditor>
                            </div>
                        </div>
                        <div class="w-100">
                            <button type="submit"
                                class="block m-auto w-full  border border-green-500 bg-green-500 text-white rounded-md py-2 px-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline mt-20">Registrar
                                Plan Nutricional</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <div class="pt-6">
            <p class="text-3xl font-extrabold text-blue-800">Recomendaciones alimenticias en 3 categorías: Hipocalórica, normocalorica y hipercalorica</p>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = reactive({
    categorias: Object
})

const form = reactive({
    titulo: '',
    descripcion: '',
    categoria: '',
    receta: '',
    /*oc: false,
    pp: false,
    phe: false,
    emp: false,
    he: false,
    afd: false,
    pem: false,
    dc: false,
    oa: false,*/
})

function submit() {
    router.post('/recetas', form)
}

</script>
