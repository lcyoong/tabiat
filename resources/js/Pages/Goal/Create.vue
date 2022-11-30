<template>
  <Layout title="New User">
    <template #header>
      <h1>New Goal</h1>
    </template>
    <form class="flex space-x-1" @submit.prevent="createGoal">
      <GoalSentence class="flex-1 flex items-center space-x-1">
        <template #name>
          <input type="text" v-model="form.gol_name" class="flex-1 w-2/5 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="lose 5kg"/>
        </template>
        <template #days>
          <input type="number" v-model="form.gol_days" class="flex-none rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="10"/>
        </template>
      </GoalSentence>
      <button type="submit" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Let's Go!</button>
    </form>
    <ValidationError :error="errors.gol_name"/>
    <ValidationError :error="errors.gol_days"/>
  </Layout>
</template>

<script setup>
import Layout from "@/Shared/Layout";
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import GoalSentence from "@/Shared/GoalSentence";

let prop = defineProps({
  errors: Object
})

const form = useForm({
    gol_name: null,
    gol_days: null,
});

function createGoal() {
  Inertia.post(route("goal.store"), form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
        }
      });  
}

</script>
