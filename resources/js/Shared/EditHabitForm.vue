<template>
  <form class="flex flex-column justify-between space-x-2" @submit.prevent="updateHabit">
    <input
      type="text"
      v-model="form.hab_name"
      class="rounded-xl w-full grow border-gray-300 text-sm"
    />
    <button type="submit" class="rounded-full bg-indigo-500 text-white text-sm px-4">Submit</button>
    <button type="button" @click="cancelForm" class="rounded-full bg-gray-200 text-sm px-4">Cancel</button>
  </form>
  <div
    class="text-xs text-red-500"
    v-if="localErrors && localErrors.hab_name"
  >{{ localErrors.hab_name[0] }}</div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    form: {},
    errors: Object
  },

  emits: ["cancelForm", "updatedSuccessful"],

  data() {
    return {
      localErrors: this.errors
    };
  },

  watch: {
    errors(newValue) {
      this.localErrors = newValue;
    }
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
    },

    cancelForm: function() {
      this.localErrors = {};
      this.$emit("cancelForm");
    }
  }
};
</script>