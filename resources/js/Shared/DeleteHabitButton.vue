<template>
  <a href="#" @click="deleteHabit()">
    <svg
      class="h-4 w-4 flex-none hover:text-red-500"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
      />
    </svg>
  </a>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    habit: Object
  },

  methods: {
    deleteHabit: function() {
      Inertia.delete("/habit/" + this.habit.hab_id, {
        preserveState: true,
        preserveScroll: true,
        onBefore: () => confirm("Are you sure you want to delete this user?"),
        onSuccess: page => {
          this.$emit("deleteSuccessful");
        }
      });
    }
  }
};
</script>