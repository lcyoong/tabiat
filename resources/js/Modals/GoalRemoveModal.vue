<template>
  <Modal ref="modalRef">
    <p class="text-xl font-bold">Remove Goal</p>
    <div class="py-10">
      <button type="submit" @click.prevent="removeGoal" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Remove Goal</button>
    </div>
  </Modal>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import Modal from "@/Shared/Modal";

let prop = defineProps({
  errors: Object,
  goal: Object
})

const form = useForm(prop.goal);

const modalRef = ref()

function removeGoal() {
  Inertia.post(route("goal.remove", {goal: form.gol_id}), form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
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