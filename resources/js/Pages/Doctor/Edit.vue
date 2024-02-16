<template>
    <Head title="Editar" />

    <AuthenticatedLayout>
        <template #header>
            Historia Medica del Paciente {{ pacientes.nombre }} {{ pacientes.apellido }}
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="">
                    <h4 class="text-2xl mb-2 font-bold">Datos del paciente:</h4>
                    <p class="text-lg ">Nombre: {{ pacientes.nombre }}</p>
                    <p class="text-lg">Apellido: {{ pacientes.apellido }}</p>
                    <p class="text-lg">Telefono: {{ pacientes.telefono }}</p>
                    <p class="text-lg">Cedula: {{ pacientes.cedula }}</p>
                    <p class="text-lg">Edad: {{ pacientes.edad }}</p>
                    <p class="text-lg">Sexo: {{ pacientes.sexo == 1 ? 'Masculino' : 'Femenino' }}</p>
                    <div>
                        <template v-if="pacientes.edad >= 18 && pacientes.edad <= 30">
                            <p class="text-lg ">Persona: Joven </p>
                        </template>
                        <template v-else-if="pacientes.edad >= 31 && pacientes.edad <= 59">
                            <p class="text-lg ">Persona: Adulta</p>
                        </template>
                        <template v-if="pacientes.edad >= 60">
                            <p class="text-lg ">Persona: Adulto Mayor</p>
                        </template>
                    </div>
                    <p class="text-lg ">Peso: {{ historial[0].peso }}</p>
                    <p class="text-lg">Altura: {{ historial[0].altura }}</p>
                    <p class="text-lg">Glisemia: {{ historial[0].glisemia }}</p>
                    <p class="text-lg capitalize">Indice de masa corporal: {{ indice.toFixed(2) }}</p>
                </div>
                <div class="my-4    ">
                    <h4 class="text-2xl mb-2 font-bold">Diagnóstico Médico:</h4>
                    <p class="text-lg">Descripcion: {{ historial[0].descripcion }}</p>
                    <template
                        v-if="props.historial[0].oc == 1 && props.historial[0].pp == 1 && props.historial[0].emp == 1 && props.historial[0].he == 1 && props.historial[0].afd == 1">
                        <p class="text-lg ">Estado de diabetes: Paciente en estado diabetico</p>
                    </template>
                    <template v-else>
                        <p class="text-lg ">Estado de diabetes: No diabetico</p>
                    </template>
                    <div>
                        <template v-if="(pacientes.edad >= 18 && pacientes.edad <= 30) && indice.toFixed(2) <= 18.5">
                            <p class="text-lg ">Estado Nutricional: Delgadez (Bajo peso: IMC menor a 18.5) </p>
                        </template>
                        <template v-else-if="(pacientes.edad >= 31 && pacientes.edad <= 59) && indice.toFixed(2) <= 18.5">
                            <p class="text-lg ">Estado Nutricional: Delgadez (Bajo peso: IMC menor a 18.5)</p>
                        </template>
                        <template v-else-if="(pacientes.edad >= 60) && indice.toFixed(2) <= 23">
                            <p class="text-lg ">Estado Nutricional: Delgadez (Bajo peso: IMC menor a 18.5) </p>
                        </template>
                        <template
                            v-else-if="(pacientes.edad >= 18 && pacientes.edad <= 30) && (indice.toFixed(2) > 18.5 && indice.toFixed(2) < 24.9)">
                            <p class="text-lg ">Estado Nutricional: Normopeso (Peso normal: IMC entre 18.5 y 24.9) </p>
                        </template>
                        <template
                            v-else-if="(pacientes.edad >= 31 && pacientes.edad <= 59) && (indice.toFixed(2) > 18.5 && indice.toFixed(2) < 24.9)">
                            <p class="text-lg ">Estado Nutricional: Normopeso (Peso normal: IMC entre 18.5 y 24.9) </p>
                        </template>
                        <template v-else-if="(pacientes.edad >= 60) && (indice.toFixed(2) > 23 && indice.toFixed(2) < 28)">
                            <p class="text-lg ">Estado Nutricional: Normopeso (Peso normal: IMC entre 18.5 y 24.9) </p>
                        </template>
                        <template v-else-if="(pacientes.edad >= 18 && pacientes.edad <= 59) && indice.toFixed(2) >= 25">
                            <p class="text-lg ">Estado Nutricional: Sobrepeso (Sobrepeso: IMC entre 25 y 29.9)</p>
                        </template>
                        <template v-else-if="(pacientes.edad >= 60) && indice.toFixed(2) >= 28">
                            <p class="text-lg ">Estado Nutricional: Sobrepeso (Sobrepeso: IMC entre 25 y 29.9) </p>
                        </template>
                    </div>
                    <div>
                        <template v-if="historial[0].glisemia < 140">
                            <p class="text-lg ">Estado de Glucosa: Normal (Glicemia en ayunas (antes de comer): Normalmente se considera un rango de 70 a 100 mg/dL.)</p>
                        </template>
                        <template v-else-if="historial[0].glisemia >= 140">
                            <p class="text-lg ">Estado de Glucosa: Alterada (Glicemia en ayunas (antes de comer): Normalmente se considera un rango de 70 a 100 mg/dL.)</p>
                        </template>
                    </div>
                    <div>
                        <template v-if="(indice.toFixed(2) <= 18.5) && historial[0].glisemia < 140">
                            <p class="text-lg ">Tipo de Dieta: Hipercalorica </p>
                        </template>
                        <template
                            v-else-if="(indice.toFixed(2) > 18.5 && indice.toFixed(2) < 24.9) && historial[0].glisemia < 140">
                            <p class="text-lg ">Tipo de Dieta: Normocalórica </p>
                        </template>
                        <template v-else-if="(indice.toFixed(2) >= 25) && historial[0].glisemia >= 140">
                            <p class="text-lg ">Tipo de Dieta: Hipocalórica </p>
                        </template>

                    </div>
                    <div>
                        <h4 class="text-2xl my-2 font-bold">Plan Nutricional:</h4>
                        <h4 class="text-xl my-2 font-bold">Nombre de la receta: {{ recetas[ramdonreceta].titulo }}</h4>
                        <p class="text-md my-2 font-bold">Descripcion de la receta: {{ recetas[ramdonreceta].descripcion }}</p>
                        <p class="text-md my-2 font-bold">Receta: <br>
                        <div v-html="recetas[ramdonreceta].receta"></div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    pacientes: Object,
    historial: Object,
    recetas: Object
})

const receta = props.recetas.length
const ramdonreceta = Math.floor(Math.random() * receta)


const indice = props.historial[0].peso / (Math.pow((props.historial[0].altura / 100), 2))


</script>
