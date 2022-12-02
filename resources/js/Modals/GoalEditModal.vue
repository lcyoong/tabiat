<template>
  <Modal ref="modalRef">
    <p class="text-xl font-bold">Edit Goal</p>
    <div class="py-10">
      <form class="flex py-2 space-x-2" @submit.prevent="editGoal">
        <GoalSentence class="flex flex-1 items-center space-x-2">
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
    </div>
  </Modal>
</template>

<script setup>
import { ref } from 'vue'
import GoalSentence from "@/Shared/GoalSentence";
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import Modal from "@/Shared/Modal";

let prop = defineProps({
  errors: Object,
  goal: Object
})

const modalRef = ref()

const form = useForm(prop.goal);

const show = () => {
  modalRef.value.show()
}

function editGoal() {
  Inertia.post(route("goal.update", {goal: form.gol_id}), form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
        }
      }); 
}

defineExpose({
    show
})
</script>