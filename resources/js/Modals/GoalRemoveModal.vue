<template>
  <Modal ref="modalRef">
    <p class="text-xl font-bold">Remove Goal</p>
    <div class="text-lg text-bold text-gray-600 my-5">
      Are you sure you want to remove this goal?
    </div>
    <div class="py-10 flex gap-2">
      <button type="submit" @click.prevent="removeGoal" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Yes. Remove the goal</button>
      <button type="button" @click.prevent="modalRef.close()" class="flex-none justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">No. Keep the goal</button>
    </div>
  </Modal>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import Modal from "@/Shared/Modal";

let prop = defineProps({
  goal: Object,
  errors: Object
})

const form = useForm(prop.goal);

const modalRef = ref()

watch(() => prop.goal, (value) =>  {
  form.gol_id = value.gol_id
})

function removeGoal() {
  Inertia.delete(route("goal.remove", {goal: form.gol_id}), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
          modalRef.value.close()
        }
      }); 
}

const show = () => {
  modalRef.value.show()
}

defineExpose({
    show
})

</script>