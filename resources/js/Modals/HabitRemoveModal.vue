<template>
    <Modal ref="modalRef">
      <p class="text-xl font-bold">Remove Habit</p>
      <div class="text-lg text-bold text-gray-600 my-5">
        Are you sure you want to remove this habit?
      </div>
      <div class="py-10 flex gap-2">
        <button type="submit" @click.prevent="removeHabit" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Yes. Remove the habit</button>
        <button type="button" @click.prevent="modalRef.close()" class="flex-none justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">No. Keep the habit</button>
      </div>
    </Modal>
  </template>
  
  <script setup>
  import { ref, watch } from 'vue';
  import { useForm } from '@inertiajs/inertia-vue3';
  import { Inertia } from "@inertiajs/inertia";
  import Modal from "@/Shared/Modal";
  
  let prop = defineProps({
    habit: Object,
    errors: Object
  })
  
  const form = useForm(prop.habit);
  
  const modalRef = ref()

  watch(() => prop.habit, (value) =>  {
    form.hab_id = value.hab_id
  })
  
  function removeHabit() {
    Inertia.delete(route("habit.remove", {habit: form.hab_id}), {
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