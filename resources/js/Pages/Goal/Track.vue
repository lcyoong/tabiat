<template>
  <Layout title="New User">
    <template #header>
      <div class="flex space-x-1">
        <GoalSentence class="truncate flex space-x-1 text-2xl">
          <template #name>
            <div class="text-indigo-600">{{goal.gol_name}}</div>
          </template>
          <template #days>
            <div class="text-indigo-600">{{goal.gol_days}}</div>
          </template>
        </GoalSentence>
      </div>
    </template>

    <form class="flex items-start space-x-2" @submit.prevent="createHabit">
      <div class="flex-1">
        <input type="text" v-model="form.hab_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Stay in bed" />
        <ValidationError :error="errors.hab_name"/>
      </div>
      <button type="submit" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add</button>
    </form>

    <!--Track-->
    <div class="overflow-hidden bg-white shadow sm:rounded-md mt-4">
      <ul role="list" class="divide-y divide-gray-200">
        <li v-for="habit of goal.habits" :key="habit.hab_id">
            <div class="flex items-center px-4 py-4 sm:px-6">
              <div class="flex min-w-0 flex-1 items-center">
                <div class="flex-shrink-0">
                  <!-- <img class="h-12 w-12 rounded-full" :src="application.applicant.imageUrl" alt="" /> -->
                </div>
                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                  <div>
                    <p class="truncate text-sm font-medium">{{ habit.hab_name }}</p>
                  </div>
                </div>
              </div>
              <div>
                <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
              </div>
            </div>
        </li>
      </ul>
    </div>    
  </Layout>
</template>

<script setup>
import Layout from "@/Shared/Layout";
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import GoalSentence from "@/Shared/GoalSentence";

let prop = defineProps({
  goal: Object,
  errors: Object
})

const form = useForm({
  hab_goal: prop.goal.gol_id,
  hab_name: null,
});

function createHabit() {
  Inertia.post(route("habit.store"), form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
          form.hab_name = null
        }
      });  
}

</script>
