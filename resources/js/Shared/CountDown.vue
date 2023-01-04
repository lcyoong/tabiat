<template>
    <div><span class="inline-flex items-center rounded-full bg-green-600 px-3 py-1 text-sm font-large text-white"><b>{{ countDown }}</b>&nbsp;days to go</span></div>
</template>

<script setup>
import { computed, ref, onMounted } from "vue"
import moment from "moment";

let prop = defineProps({
    fromDate: String,
    days: Number
})

const endDate = computed(() => {
    return moment(prop.fromDate).add(prop.days, 'days')
})

let countDown = ref(endDate.value.diff(moment(), 'days'))

onMounted(() => {
    setInterval(() => {
      countDown.value = endDate.value.diff(moment(), 'days')
    }, 60000);
})
</script>