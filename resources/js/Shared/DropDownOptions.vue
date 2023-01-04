<template>
    <div class="ml-3 relative" v-click-outside="clickOutside">
        <a href="#;" @click.prevent="showGoalMenu = !showGoalMenu"><DotsVerticalIcon class="h-5 w-5 text-gray-400 z-10"/></a>
        <div
            class="z-20 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none transform"
            :class="{'transition ease-in duration-75 hidden opacity-0 scale-95' : !showGoalMenu,
            'transition ease-out duration-100 opacity-100 scale-100' : showGoalMenu,
            }"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="user-menu-button"
            tabindex="-1"
        >
            <a v-for="option of prop.options"
                href="#;"
                @click.prevent="clicked(option.action)"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                tabindex="-1"
            >{{option.label}}</a>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { DotsVerticalIcon, ChevronRightIcon } from '@heroicons/vue/outline';

let prop = defineProps({
    options: Array
})

const emit = defineEmits()

let showGoalMenu = ref(false)

function clicked(action) {
    showGoalMenu.value = false
    emit(action)
}

function clickOutside() {
    console.log('outside')
    showGoalMenu.value = false
}

</script>