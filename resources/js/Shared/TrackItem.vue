<template>
  <div class="flex items-center justify-between">
    <div>
      <MiniKudos :id="habit.hab_id" :triggerId="$store.getters.lastAchieved"></MiniKudos>
      <Toggle
        :init_value="$store.getters.isOn(habit.hab_id)"
        :key-value="habit.hab_id"
        @toggled="toggled"
      />
    </div>

    <div class="ml-4 grow">{{ habit.hab_name }}</div>

    <div
      class="text-right flex items-center justify-between"
      :class="{
                'inline-block': is_active,
                hidden: !is_active,
            }"
    >
      <a href="#" @click.prevent="$emit('clickEdit')" class="mr-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-4 w-4 hover:text-green-500"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
          />
        </svg>
      </a>
      <!--edit habit button-->

      <DeleteHabitButton :habit="habit" />
      <!--delete habit button-->
    </div>
    <!--end habit controls-->
  </div>
</template>

<script>
import Toggle from "../Shared/Toggle";
import DeleteHabitButton from "../Shared/DeleteHabitButton";
import MiniKudos from "../Shared/MiniKudos";

export default {
  props: {
    habit: {},
    is_active: null,
    date: String
  },

  components: {
    Toggle,
    DeleteHabitButton,
    MiniKudos
  },

  data() {
    return {
      lastToggledOn: null,
      tracks: []
    };
  },

  emits: ["clickEdit"],

  methods: {
    // When habit tracking is toggled
    toggled: function(id) {
      this.$store.dispatch("toggleTrack", {
        id: id,
        date: this.date
      });
      // if (this.tracks[id] != undefined) {
      //     this.tracks[id] = !this.tracks[id];
      // } else {
      //     this.tracks[id] = true;
      // }

      // Post action according to the toggle state
      // if (this.tracks[id]) {
      //     this.lastToggledOn = id;
      //     axios.post(this.$route("track.store"), {
      //         date: this.date,
      //         habit: id,
      //     });
      // } else {
      //     this.lastToggledOn = null;
      //     axios.post(this.$route("track.delete"), {
      //         date: this.date,
      //         habit: id,
      //     });
      // }
    }
  }
};
</script>
