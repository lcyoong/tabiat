<template>
    <div class="min-w-0 flex flex-1 px-4 relative shadow-sm">
        <input @keyup.enter="updateHabit" type="text" v-model="editHabitForm.hab_name" class="block w-full rounded-md border-gray-300 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="0.00" aria-describedby="price-currency" />
        <div @click.prevent="$emit('resetHabit')" class="absolute inset-y-0 right-3 flex items-center pr-3">
        <RewindIcon class="h-6 w-6" aria-hidden="true" />
        </div>              
    </div>
</template>

<script setup>
// import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { RewindIcon } from '@heroicons/vue/outline';
import { useForm } from '@inertiajs/inertia-vue3';

let prop = defineProps({
    habit: Object
})

const emit = defineEmits()

const editHabitForm = useForm(prop.habit);

function updateHabit() {
  Inertia.post(route("habit.update", {habit: editHabitForm.hab_id}), editHabitForm, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
            emit('habitUpdated')
        }
      });  
}
</script>