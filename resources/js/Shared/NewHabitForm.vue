<template>
  <div>
    <button
      v-if="showAddHabitForm == false"
      @click="showAddHabitForm = true"
      type="button"
      class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >New habit</button>
    <!--New habit button-->

    <form v-else class="flex flex-column justify-between space-x-2" @submit.prevent="addNewHabit">
      <input
        type="text"
        v-model="form.hab_name"
        class="rounded-xl w-full border-gray-300 grow text-sm"
      />
      <button type="submit" class="rounded-full bg-indigo-500 text-white text-sm px-4">Submit</button>
      <button type="button" @click="cancel" class="rounded-full bg-gray-200 text-sm px-4">Cancel</button>
    </form>
    <div class="text-xs text-red-500" v-if="localErrors.hab_name">{{ localErrors.hab_name[0] }}</div>

    <!--New habit form-->
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    errors: Object
  },

  data() {
    return {
      showAddHabitForm: false,
      form: {},
      localErrors: this.errors
    };
  },

  watch: {
    errors(newValue) {
      this.localErrors = newValue;
    }
  },

  methods: {
    addNewHabit: function() {
      Inertia.post("/habit", this.form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
          this.showAddHabitForm = false;
          this.form = {};
          this.$emit("storedSuccessful");
        }
      });
    },

    cancel() {
      this.showAddHabitForm = false;
      this.localErrors = {};
      this.form = {};
    }
  }
};
</script>