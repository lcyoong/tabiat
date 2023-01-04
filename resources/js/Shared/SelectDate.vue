<template>
    <Popover class="relative" v-slot="{ open }">
    <PopoverButton :class="[open ? 'text-gray-900' : 'text-gray-500', 'group inline-flex items-center rounded-md bg-white text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2']">
        <span>Date : {{ moment(date).format("DD MMM YYYY") }}</span>
        <ChevronDownIcon :class="[open ? 'text-gray-600' : 'text-gray-400', 'ml-2 h-5 w-5 group-hover:text-gray-500']" aria-hidden="true" />
    </PopoverButton>

    <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
        <PopoverPanel class="absolute left-1/2 z-10 mt-3 w-screen max-w-xs -translate-x-1/2 transform px-2 sm:px-0">
        <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
            <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                <DatePicker v-model="date"/>
            </div>
        </div>
        </PopoverPanel>
    </transition>
    </Popover>
</template>

<script setup>
import { watch } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/solid'
import { DatePicker } from 'v-calendar';
import moment from "moment";
import 'v-calendar/dist/style.css';

let prop = defineProps({
    date: String,
    goal: String
})

watch(() => prop.date, (value) =>  {
    Inertia.get(route('goal.track', {goal: prop.goal, date: moment(value).format('YYYY-MM-DD')}))
})

</script>