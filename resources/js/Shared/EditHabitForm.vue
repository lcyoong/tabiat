<template>
  <form class="flex flex-column justify-between space-x-2" @submit.prevent="updateHabit">
    <input
      type="text"
      v-model="form.hab_name"
      class="rounded-xl w-full grow border-gray-300 text-sm"
    />
    <button type="submit" class="rounded-full bg-indigo-500 text-white text-sm px-4">Submit</button>
    <button
      type="button"
      @click="$emit('cancelForm')"
      class="rounded-full bg-gray-200 text-sm px-4"
    >Cancel</button>
  </form>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    form: {}
  },

  methods: {
    updateHabit: function(id) {
      Inertia.post("/habit/" + this.form.hab_id, this.form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
          //   this.form = {};
          this.$emit("updatedSuccessful");
        }
      });
    }
  }
};
</script>