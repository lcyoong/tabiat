<template>
    <div v-if="show">
        <div class="text-center bg-gray-500/70 w-full h-full fixed left-0 top-0 flex items-center justify-center" style="backgroundx: rgba(204, 204, 204, 0.5)">
            <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                <XIcon class="h-10 w-10 cursor-pointer" aria-hidden="true" @click="close"/>
            </div>

            <div class="flex flex-col gap-2 px-8 md:px-28">
                <div class="text-3xl md:text-6xl font-semibold flex items-center text-green-600">
                    <div class="grow"><StarIcon class="h-8 w-8 min-w-8 text-yellow-600 grow" aria-hidden="true"/></div>
                    <div class="grow-0">{{ milestone.mil_content }}</div>
                </div>
                <div class="text-left font-semibold">on {{ milestone.mil_date }}</div>                
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { StarIcon, XIcon } from '@heroicons/vue/outline';

let prop = defineProps({
    milestone: Object
})

let show = ref(false)

function open() {
    show.value = true
}

function close() {
    show.value = false
}

defineExpose({
    open, close
})
</script>