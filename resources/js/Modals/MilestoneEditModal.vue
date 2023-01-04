<template>
  <Modal ref="modalRef" @close="closeModal">
    <p class="text-xl font-bold">Edit Milestone</p>
    <div class="py-10">
      <form class="flex py-2 space-x-2" @submit.prevent="editMilestone">
        <DatePicker v-model="form.mil_date">
          <template v-slot="{ inputValue, inputEvents }">
            <input
              class="bg-white border px-2 py-1 rounded"
              :value="inputValue"
              v-on="inputEvents"
              placeholder="Milestone date"
            />
          </template>
        </DatePicker>
        <input type="text" v-model="form.mil_content" class="flex-1 w-2/5 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="What milestone have you achieved?"/>
        <button type="submit" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Let's Go!</button>
      </form>
      <ValidationError :error="errors?.editMilestone?.mil_content"/>
      <ValidationError :error="errors?.editMilestone?.mil_date"/>
    </div>
  </Modal>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import Modal from "@/Shared/Modal";
import { DatePicker } from 'v-calendar';
import { propsToAttrMap } from '@vue/shared';

let prop = defineProps({
  errors: Object,
  milestone: Object
})

const modalRef = ref()

const form = useForm(prop.milestone);

const emit = defineEmits()

watch(() => prop.milestone, (value) =>  {
  if(value) {
    form.mil_id = value.mil_id
    form.mil_content = value.mil_content
    form.mil_date = value.mil_date
  }
})

const show = () => {
  modalRef.value.show()
}

function editMilestone() {
  Inertia.post(route("milestone.update", {milestone: form.mil_id}), form, {
    errorBag: 'editMilestone',
    preserveState: true,
    preserveScroll: true,
    onSuccess: page => {          
      emit('milestoneUpdated')
      modalRef.value.close()
    }
  });
}

function closeModal() {
  prop.errors.editMilestone = null
}

defineExpose({
    show
})
</script>