<template>

</template>

<script setup>

const props = defineProps({
    titulo: {
        type: String,
        default: 'Titulo'
    },
    subtitulo: {
        type: String,
        default: 'Subtitulo'
    },
    color: {
        type: String,
        default: 'i'
    },
    colorIcon: {
        type: String,
        default: 'text-red'
    }
})

</script>
