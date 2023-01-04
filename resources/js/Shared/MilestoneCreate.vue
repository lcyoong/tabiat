<template>
    <form class="flex items-start space-x-2" @submit.prevent="createMilestone">
      <div>
        <DatePicker v-model="createMilestoneForm.mil_date">
          <template v-slot="{ inputValue, inputEvents }">
            <input
              class="bg-white border px-2 py-1 rounded"
              :value="inputValue"
              v-on="inputEvents"
              placeholder="Milestone date"
            />
          </template>
        </DatePicker>
      </div>
      <div class="flex-1">
        <input type="text" v-model="createMilestoneForm.mil_content" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="What milestone have you achieved?" />
      </div>
      <button type="submit" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add</button>
    </form>
    <ValidationError :error="errors.mil_date"/>
    <ValidationError :error="errors.mil_content"/>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { DatePicker } from 'v-calendar';

let prop = defineProps({
    gol_id: String,
    errors: Object
})

const createMilestoneForm = useForm({
  mil_goal: prop.gol_id,
  mil_content: null,
  mil_date: null,
});

function createMilestone() {
  Inertia.post(route("milestone.store"), createMilestoneForm, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
          createMilestoneForm.mil_content = null
          createMilestoneForm.mil_date = null
        }
      });  
}

</script>