<template>
    <Head title="Consultas" />

    <AuthenticatedLayout>
        <template #header>
            Consultas
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="bg-white rounded-md w-full">
                    <div>
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                            <div v-if="props.citas.length > 0"
                                class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Nombre y Apellido
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Doctor
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Fecha de Cita
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cita in props.citas" :key="cita.id">
                                            <template
                                                v-if="cita.doctor == $page.props.auth.user.name || $page.props.auth.user.roles[0].name == 'admin'">
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ cita.paciente_cita.nombre }} {{ cita.paciente_cita.apellido }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">{{ cita.doctor }}</p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ cita.fecha_cita }}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <template v-if="cita.estado_id == 1">
                                                        <span
                                                            class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                            <span aria-hidden
                                                                class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">En Espera</span>
                                                        </span>
                                                    </template>
                                                    <template v-if="cita.estado_id == 2">
                                                        <span
                                                            class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                            <span aria-hidden
                                                                class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                            <span class="relative">Atentedido</span>
                                                        </span>
                                                    </template>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm space-x-2">
                                                    <button @click="mostrarCita(cita.id)"
                                                        class="bg-yellow-600 px-2 py-1 rounded-md text-white font-semibold tracking-wide cursor-pointer">Ver
                                                        Cita</button>
                                                    <template v-if="cita.estado_id == 1">
                                                        <button @click="atenderCita(cita.id)"
                                                            class="bg-cyan-600 px-2 py-1 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                                                            Atender</button>
                                                    </template>

                                                    <template v-if="cita.estado_id == 2">
                                                        <Link :href="route('doctor.edit', cita.paciente_cita.id)"
                                                            class="bg-red-600 px-2 py-1 rounded-md text-white font-semibold tracking-wide cursor-pointer">
                                                            Diagnóstico Médico</Link>
                                                            {{  }}
                                                    </template>

                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p v-else>
                                No Hay Consultas
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Modal :show="verCita">
            <div role="alert">
                <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                    <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4 text-2xl">
                        Registro De Cita
                    </h1>
                    <div>
                        <h3 class="text-gray-800 font-bold leading-tight tracking-normal text-xl">
                            Estado</h3>
                        <template v-if="citaSeleccionada.estado_id === 1">
                            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                <span class="relative">En Espera</span>
                            </span>
                        </template>
                        <template v-else>
                            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                <span class="relative">Atentedido</span>
                            </span>
                        </template>
                    </div>
                    <div>
                        <h3 class="text-gray-800 font-bold leading-tight tracking-normal text-xl mt-4">
                            Paciente</h3>
                        <p>Nombre y Apellido: {{ citaSeleccionada.paciente_cita.nombre }} {{
                            citaSeleccionada.paciente_cita.apellido }}</p>
                        <p>Cedula: {{ citaSeleccionada.paciente_cita.cedula }}</p>
                        <p>Telefono: {{ citaSeleccionada.paciente_cita.telefono }}</p>
                        <p>Sintomas: {{ citaSeleccionada.decripcion }}</p>
                        <p>Edad: {{ citaSeleccionada.paciente_cita.edad }}</p>
                        <p>Sexo: {{ (citaSeleccionada.sexo == 1 ? 'Masculino' : 'Femenino') }}</p>
                    </div>
                    <div>
                        <h3 class="mt-4 text-gray-800 font-bold leading-tight tracking-normal text-xl">
                            Doctor</h3>
                        <p>Nombre Del Doctor: {{ citaSeleccionada.doctor }}</p>
                    </div>
                    <div>
                        <h3 class="mt-4 text-gray-800 font-bold leading-tight tracking-normal text-xl">
                            Fecha De La Cita</h3>
                        <p>Fecha de la Cita: {{ citaSeleccionada.fecha_cita }}</p>
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

        <Modal :show="modalAtender">
            <div role="alert">
                <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                    <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4 text-2xl">
                        Consulta N° {{ citaAtenderSeleccionada.id }}
                    </h1>
                    <div>
                        <h3 class="text-gray-800 font-bold leading-tight tracking-normal text-xl">
                            Estado</h3>
                        <template v-if="citaAtenderSeleccionada.estado_id === 1">
                            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                <span class="relative">En Espera</span>
                            </span>
                        </template>
                        <template v-else>
                            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                <span class="relative">Atentedido</span>
                            </span>
                        </template>
                    </div>
                    <div>
                        <h3 class="text-gray-800 font-bold leading-tight tracking-normal text-xl mt-4">
                            Paciente</h3>
                        <p>Nombre y Apellido: {{ citaAtenderSeleccionada.paciente_cita.nombre }} {{
                            citaAtenderSeleccionada.paciente_cita.apellido }}</p>
                        <p>Cedula: {{ citaAtenderSeleccionada.paciente_cita.cedula }}</p>
                        <p>Telefono: {{ citaAtenderSeleccionada.paciente_cita.telefono }}</p>
                        <p>Sintomas: {{ citaAtenderSeleccionada.decripcion }}</p>
                        <p>Edad: {{ citaAtenderSeleccionada.paciente_cita.edad }}</p>
                        <p>Sexo: {{ (citaAtenderSeleccionada.paciente_cita.sexo == 1 ? 'Masculino' : 'Femenino') }}</p>
                    </div>
                    <div>
                        <h3 class="mt-4 text-gray-800 font-bold leading-tight tracking-normal text-xl">
                            Doctor</h3>
                        <p>Nombre Del Doctor: {{ citaAtenderSeleccionada.doctor }}</p>
                    </div>
                    <div>
                        <h3 class="mt-4 text-gray-800 font-bold leading-tight tracking-normal text-xl">
                            Fecha De La Cita</h3>
                        <p>Fecha de la Cita: {{ citaAtenderSeleccionada.fecha_cita }}</p>
                    </div>

                    <div class="col-span-2">
                        <h3 class="text-2xl capitalize mb-4">Motor de Inferencia</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]">
                                    Peso:
                                </label>
                                <input type="number" id="peso" v-model="form.peso" placeholder="40 Kg"
                                            class="block mt-1 w-full rounded-md form-input focus:border-indigo-600" />
                            </div>
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]">
                                    Altura (Centimetros):
                                </label>
                                <input type="number" id="altura" v-model="form.altura" placeholder="(Ejemplo: 167)"
                                            class="block mt-1 w-full rounded-md form-input focus:border-indigo-600" />
                            </div>
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]">
                                    Glisemia (mg/dL):
                                </label>
                                <input type="number" id="glisemia" v-model="form.glisemia" placeholder="(Ejemplo: 147)"
                                            class="block mt-1 w-full rounded-md form-input focus:border-indigo-600" />
                            </div>
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
                                            <label for="pp1" class="pl-3 text-base font-medium text-[#07074D]">
                                                Si
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" :value="false" id="pp2" v-model="form.pp" class="h-5 w-5" />
                                            <label for="pp2" class="pl-3 text-base font-medium text-[#07074D]">
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
                                            <input type="radio" id="phe1" :value="true" v-model="form.phe"
                                                class="h-5 w-5" />
                                            <label for="phe1" class="pl-3 text-base font-medium text-[#07074D]">
                                                Si
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" id="phe2" :value="false" v-model="form.phe"
                                                class="h-5 w-5" />
                                            <label for="phe2" class="pl-3 text-base font-medium text-[#07074D]">
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
                                            <input type="radio" id="emp1" :value="true" v-model="form.emp"
                                                class="h-5 w-5" />
                                            <label for="emp1" class="pl-3 text-base font-medium text-[#07074D]">
                                                Si
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" id="emp2" :value="false" v-model="form.emp"
                                                class="h-5 w-5" />
                                            <label for="emp2" class="pl-3 text-base font-medium text-[#07074D]">
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
                                            <input type="radio" id="he1" :value="true" v-model="form.he" class="h-5 w-5" />
                                            <label for="he1" class="pl-3 text-base font-medium text-[#07074D]">
                                                Si
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" id="he2" :value="false" v-model="form.he" class="h-5 w-5" />
                                            <label for="he2" class="pl-3 text-base font-medium text-[#07074D]">
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
                                            <input type="radio" id="efd1" :value="true" v-model="form.afd"
                                                class="h-5 w-5" />
                                            <label for="efd1" class="pl-3 text-base font-medium text-[#07074D]">
                                                Si
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" id="efd2" :value="false" v-model="form.afd"
                                                class="h-5 w-5" />
                                            <label for="edf2" class="pl-3 text-base font-medium text-[#07074D]">
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
                                            <input type="radio" id="pem1" :value="true" v-model="form.pem"
                                                class="h-5 w-5" />
                                            <label for="pem1" class="pl-3 text-base font-medium text-[#07074D]">
                                                Si
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" id="pem2" :value="false" v-model="form.pem"
                                                class="h-5 w-5" />
                                            <label for="pem2" class="pl-3 text-base font-medium text-[#07074D]">
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
                                            <label for="dc1" class="pl-3 text-base font-medium text-[#07074D]">
                                                Si
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" id="dc2" :value="false" v-model="form.dc" class="h-5 w-5" />
                                            <label for="dc2" class="pl-3 text-base font-medium text-[#07074D]">
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
                                            <label for="oa1" class="pl-3 text-base font-medium text-[#07074D]">
                                                Si
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" id="oa2" :value="false" v-model="form.oa" class="h-5 w-5" />
                                            <label for="oa2" class="pl-3 text-base font-medium text-[#07074D]">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="resultado"
                            class="text-gray-800 text-xl font-bold leading-tight tracking-normal mt-4 block">Sintomas del paciente:</label>
                        <textarea v-model="form.resultado" required
                            class="mt-2 h-24 w-full border rounded-xl overflow-hidden resize-none focus:border-blue-500 ring-1 ring-transparent focus:ring-blue-500 focus:outline-none text-black p-2 transition ease-in-out duration-300"
                            :placeholder="`Ingrese los resultados de la cita con el paciente ${citaAtenderSeleccionada.paciente_cita.nombre} ${citaAtenderSeleccionada.paciente_cita.apellido}`"></textarea>
                    </div>


                    <div class="mt-6 flex items-center justify-start w-full">
                        <button @click="guardarCita"
                            class="focus:outline-none focus:ring-2 focus:ring-green-2 focus:ring-green-700 transition duration-150 ease-in-out hover:bg-green-600 bg-green-700 rounded text-white px-8 py-2 text-sm">Guardar
                            Consulta</button>
                        <button
                            class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm ml-4"
                            @click="atenderCita">Cancel</button>
                    </div>
                    <button
                        class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
                        @click="atenderCita" aria-label="close modal" role="button">
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

        <Modal :show="verReporte">
            <div role="alert">
                <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                    <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4 text-2xl">
                        Diagnostico De Cita
                    </h1>
                    <div>
                        <h3 class="text-gray-800 font-bold leading-tight tracking-normal text-xl">
                            Estado</h3>
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                            <span class="relative">Atentedido</span>
                        </span>
                    </div>
                    <div>
                        <h3 class="text-gray-800 font-bold leading-tight tracking-normal text-xl mt-4">
                            Paciente</h3>
                        <p>Nombre y Apellido: {{ citaReporte.historia_paciente.nombre }} {{
                            citaReporte.historia_paciente.apellido }}</p>
                        <p>Cedula: {{ citaReporte.historia_paciente.cedula }}</p>
                        <p>Telefono: {{ citaReporte.historia_paciente.telefono }}</p>
                        <p>Sintomas: {{ citaReporte.descripcion }}</p>
                    </div>
                    <div>
                        <h3 class="mt-4 text-gray-800 font-bold leading-tight tracking-normal text-xl">
                            Doctor</h3>
                        <p>Nombre Del Doctor: {{ citaReporte.doctor }}</p>
                    </div>
                    <div>
                        <h3 class="mt-4 text-gray-800 font-bold leading-tight tracking-normal text-xl">
                            Fecha De La Cita</h3>
                        <p>Fecha de la Cita: {{ Date(citaReporte.historia_paciente.created_at) }}</p>
                    </div>

                    <div>
                        <h3 class="mt-4 text-gray-800 font-bold leading-tight tracking-normal text-xl">
                            Resultado De La Cita</h3>
                        <p>Resultado: {{ citaReporte.resultado }}</p>
                    </div>


                    <div class="mt-6 flex items-center justify-start w-full">

                        <button
                            class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm w-full"
                            @click="mostrarReporte">Cancel</button>
                    </div>
                    <button
                        class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
                        @click="mostrarReporte" aria-label="close modal" role="button">
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
import { Head } from '@inertiajs/vue3';
import { router, Link } from '@inertiajs/vue3'
import { reactive, ref } from 'vue';

const props = defineProps({
    citas: Object,
    reporte: Object
})

let modalAtender = ref(false)
let verCita = ref(false)
let verReporte = ref(false)
let citaSeleccionada = ref(null)
let citaAtenderSeleccionada = ref(null)
let citaReporte = ref(null)

const form = reactive({
    id: null,
    paciente: null,
    doctor: null,
    descripcion: null,
    resultado: null,
    peso: null,
    altura: null,
    glisemia: null,
    oc: false,
    pp: false,
    phe: false,
    emp: false,
    he: false,
    afd: false,
    pem: false,
    dc: false,
    oa: false,
})

const atenderCita = (id) => {
    citaAtenderSeleccionada.value = props.citas.find((cita) => cita.id === id);
    form.id = id
    modalAtender.value = !modalAtender.value
}

const mostrarCita = (id) => {
    citaSeleccionada.value = props.citas.find((cita) => cita.id === id);
    verCita.value = !verCita.value
}

const mostrarReporte = (id) => {
    citaReporte.value = props.reporte.find((reporte) => reporte.id === id);
    verReporte.value = !verReporte.value
}

const guardarCita = () => {
    if (citaAtenderSeleccionada) {
        form.descripcion = citaAtenderSeleccionada.value.decripcion
        form.doctor = citaAtenderSeleccionada.value.doctor
        form.paciente = citaAtenderSeleccionada.value.paciente_id
    }
    router.post(`/doctor`, form)

    //resetear valores
    form.id.value = null
    form.descripcion.value = null
    form.doctor.value = null
    form.paciente.value = null
    form.resultado.value = null

    modalAtender.value = !modalAtender.value
}

const exportData = () => {
    window.open('/citas/export', '_blank')
}


</script>
