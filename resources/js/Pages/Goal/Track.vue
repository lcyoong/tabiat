<template>
  <Layout title="Track Your Goal">
    <template #header>
      <div class="flex space-x-1 items-center justify-between">
        <GoalSentenceReadOnly 
          :name="goal.gol_name" 
          :days="goal.gol_days" 
          class="text-2xl"
          />
        <DropDownOptions :options="[
            { label: 'Edit', action: 'editGoalClicked'},
            { label: 'Remove', action: 'removeGoalClicked'},
          ]"
          @editGoalClicked="editGoal"
          @removeGoalClicked="removeGoal"
        />
      </div>
    </template>

    <p class="text-xl">Habits</p>
    <ul v-if="(goal.habits.length > 0)" role="list">
      <li v-for="habit of goal.habits" :key="habit.hab_id" class="bg-white shadow sm:rounded-md my-4">
        <div class="flex items-center px-4 py-4 sm:px-6">
          <div>
            <Toggle @toggleOn="onTrack(habit.hab_id)"/>
          </div>
          <div class="flex min-w-0 flex-1 items-center">
            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
              <p class="truncate text-sm font-medium">{{ habit.hab_name }}</p>
            </div>
          </div>
          <div>
            <DropDownOptions :id="('habit'+habit.hab_id)" :options="[
                { label: 'Edit', action: 'editHabitClicked'},
                { label: 'Remove', action: 'removeHabitClicked'},
              ]"
              @editHabitClicked="editHabit(habit.hab_id)"
              @removeHabitClicked="removeHabit(habit.hab_id)"
              />
          </div>
        </div>
      </li>
    </ul>
    <div v-else class="text-lg text-bold text-gray-300 my-5">
      Habits can help towards realizing your goal. Start now.
    </div>

    <form class="flex items-start space-x-2" @submit.prevent="createHabit">
      <div class="flex-1">
        <input type="text" v-model="form.hab_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Stay in bed" />
        <ValidationError :error="errors.hab_name"/>
      </div>
      <button type="submit" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add</button>
    </form>

    <GoalEditModal :errors="errors" :goal="goal" ref="editGoalModalRef"/>

    <GoalRemoveModal :errors="errors" :goal="goal" ref="removeGoalModalRef"/>

  </Layout>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import Layout from "@/Shared/Layout";
import GoalSentenceReadOnly from "@/Shared/GoalSentenceReadOnly";
import GoalEditModal from "@/Modals/GoalEditModal";
import GoalRemoveModal from "@/Modals/GoalRemoveModal";
import DropDownOptions from "@/Shared/DropDownOptions";
import Toggle from "@/Shared/Toggle";

let prop = defineProps({
  goal: Object,
  errors: Object
})

const editGoalModalRef = ref()

const removeGoalModalRef = ref()

const form = useForm({
  hab_goal: prop.goal.gol_id,
  hab_name: null,
});

function editGoal() {
  editGoalModalRef.value.show()
}

function removeGoal() {
  removeGoalModalRef.value.show()
}

function editHabit(id) {
  console.log(id)
}

function removeHabit(id) {
  console.log(id)
}

function onTrack(id) {
  console.log(id)
}

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
