<template>
    <form class="flex items-start space-x-2" @submit.prevent="createHabit">
      <div class="flex-1">
        <input type="text" v-model="createHabitForm.hab_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Stay in bed" />
        <ValidationError :error="errors.hab_name"/>
      </div>
      <button type="submit" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add</button>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";

let prop = defineProps({
    goal: Object,
    errors: Object
})

const createHabitForm = useForm({
  hab_goal: prop.goal.gol_id,
  hab_name: null,
});

function createHabit() {
  Inertia.post(route("habit.store"), createHabitForm, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
          createHabitForm.hab_name = null
        }
      });  
}

</script>