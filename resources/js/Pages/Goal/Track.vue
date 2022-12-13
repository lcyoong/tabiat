<template>
  <Layout title="Track Your Goal">
    <template #header>
      <div class="flex space-x-1 items-center justify-between">
        <GoalSentenceReadOnly 
          :name="goal.gol_name" 
          :days="goal.gol_days" 
          class="text-2xl"
        />
        <CountDown 
          :fromDate="goal.created_at"
          :days="goal.gol_days"
          :key="key['countDown']"
        />
        <DropDownOptions :options="[
            { label: 'Edit', action: 'editGoalClicked'},
            { label: 'Remove', action: 'removeGoalClicked'},
            { label: 'Milestone', action: 'goalMilestoneClicked'},
          ]"
          @editGoalClicked="editGoal"
          @removeGoalClicked="removeGoal"
          @goalMilestoneClicked="removeGoal"
        />
      </div>
    </template>

    <div class="flex flex-row items-center justify-between">
      <p class="text-xl">Habits</p>
      <SelectDate :date="today" :goal="goal.gol_id"/>
    </div>
    <ul v-if="(goal.habits.length > 0)" role="list">
      <li v-for="habit of goal.habits" :key="habit.hab_id" class="bg-white shadow sm:rounded-md my-4">
        <div class="flex items-center px-4 py-4 sm:px-6">
          <!--Toggle-->
          <div>
            <Toggle 
              :enabled="habit.tracks.length > 0" 
              @toggleOn="onTrack(habit.hab_id)"
              @toggleOff="offTrack(habit.hab_id)"
            />
          </div>

          <!--Habit edit/display-->
          <div class="flex min-w-0 flex-1 items-center">
            <HabitEdit 
              v-if="(editHabitForm === habit || errors['editHabit' + habit.hab_id] != null)"
              :habit="editHabitForm" 
              :errors="errors"
              @resetHabit="resetHabit(habit)"
              @habitUpdatedx="resetHabit"
            />
            <div v-else class="min-w-0 flex-1 px-4">
              <p class="truncate text-sm font-medium">{{ habit.hab_name }}</p>
            </div>
          </div>

          <!--Habit options-->
          <div>
            <DropDownOptions :id="('habit'+habit.hab_id)" :options="[
                { label: 'Edit', action: 'editHabitClicked'},
                { label: 'Remove', action: 'removeHabitClicked'},
              ]"
              @editHabitClicked="editHabit(habit)"
              @removeHabitClicked="removeHabit(habit)"
              />
          </div>
        </div>
      </li>
    </ul>
    <div v-else class="text-lg text-bold text-gray-300 my-5">
      Habits can help towards realizing your goal. Start now.
    </div>

    <HabitCreate :goal="goal" :errors="errors"/>    

    <GoalEditModal :errors="errors" :goal="goal" ref="editGoalModalRef" @goalUpdated="key['countDown'] = Date()"/>

    <GoalRemoveModal :errors="errors" :goal="goal" ref="removeGoalModalRef"/>

    <HabitRemoveModal :key="1" :errors="errors" :habit="removeHabitForm" ref="removeHabitModalRef"/>

  </Layout>
</template>

<script setup>
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3';
import Layout from "@/Shared/Layout";
import GoalSentenceReadOnly from "@/Shared/GoalSentenceReadOnly";
import GoalEditModal from "@/Modals/GoalEditModal";
import GoalRemoveModal from "@/Modals/GoalRemoveModal";
import DropDownOptions from "@/Shared/DropDownOptions";
import Toggle from "@/Shared/Toggle";
import CountDown from "@/Shared/CountDown";
import HabitEdit from "@/Shared/HabitEdit";
import HabitCreate from "@/Shared/HabitCreate";
import HabitRemoveModal from "@/Modals/HabitRemoveModal";
import SelectDate from "@/Shared/SelectDate";

let prop = defineProps({
  goal: Object,
  errors: Object,
  today: String
})

const editGoalModalRef = ref()

const removeGoalModalRef = ref()

const removeHabitModalRef = ref()

let key = ref({
  countDown: Date()
})

// let inErrors = ref(prop.errors)

let editHabitForm = ref()

let removeHabitForm = ref()

// watch(() => prop.errors, (value) =>  {
//     inErrors.value = value
// })
// let today = moment().format('YYYY-MM-DD')

function editGoal() {
  editGoalModalRef.value.show()
}

function removeGoal() {
  removeGoalModalRef.value.show()
}

function resetHabit(value) {
  prop.errors['editHabit' + value.hab_id] = null
  editHabitForm.value = null
}

function editHabit(habit) {
  editHabitForm.value = habit
}

function removeHabit(habit) {
  editHabitForm.value = null
  removeHabitForm.value = habit
  removeHabitModalRef.value.key = 2
  removeHabitModalRef.value.show()
}

function onTrack(id) {
  console.log(id)
  Inertia.post(route("track.store"), useForm({
      tra_habit: id,
      tra_date: prop.today
    }), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: page => {
      }
    });
}

function offTrack(id) {
  console.log(id)
  Inertia.delete(route("track.remove", {habit: id, date: prop.today}), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: page => {
      }
    });   
}

</script>
