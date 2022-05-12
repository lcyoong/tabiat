<template>
  <span
    v-if="realCounter > 0"
    class="inline-flex transition items-center ease-linear origin-center duration-300 px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800"
    :class="{'scale-110 bg-indigo-200': hurray}"
  >{{ realCounter }}</span>
</template>

<script>
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
  props: {
    counter: Number
  },

  data() {
    return {
      realCounter: this.counter,
      hurray: false
    };
  },

  created() {
    Echo.private("achievement." + this.user.id).listen(
      "SomethingAchieved",
      e => {
        // console.log(e.achievement);
        this.hurray = true;
        this.realCounter++;
        setTimeout(() => {
          this.hurray = false;
        }, 1000);
      }
    );

    Echo.private("reset-achievement-notification." + this.user.id).listen(
      "AchievementVisited",
      e => {
        this.realCounter = 0;
        // console.log(this.realCounter);
        // setTimeout(() => {
        // }, 1000);
      }
    );
  },

  setup() {
    const user = computed(() => usePage().props.value.user);
    return { user };
  }
};
</script>