<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <TrackNav :date="date" />

    <div class="my-4">
      <span
        class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800"
      >{{ track_count() }}/ {{ habit_count() }}</span>
      daily habits achieved
    </div>
    <!--end track counter-->

    <ul class="space-y-6 my-6" @mouseout="active_habit = 0">
      <li
        class="rounded-full hover:bg-indigo-50 px-4 py-2"
        v-for="habit in habits"
        @mouseover="hoverOnHabit(habit.hab_id)"
      >
        <EditHabitForm
          v-if="edit_habit_form == habit"
          :form="habit"
          @cancel-form="edit_habit_form = {}"
          @updated-successful="edit_habit_form = {}"
        />
        <!--end: Edit habit form-->

        <div v-else class="flex items-center justify-between">
          <Toggle :init_value="tracks[habit.hab_id]" :key-value="habit.hab_id" @toggled="toggled" />

          <div class="ml-4 grow">{{ habit.hab_name }}</div>

          <div
            class="text-right flex items-center justify-between"
            :class="{
              'inline-block': active_habit == habit.hab_id,
              hidden: active_habit != habit.hab_id,
          }"
          >
            <a href="#" @click.prevent="edit_habit_form = habit" class="mr-2">
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
      </li>
    </ul>
    <!--end habit list-->

    <NewHabitForm />
    <!--end new habit-->
  </div>
</template>

<script>
import Toggle from "../Shared/Toggle";
import TrackNav from "../Shared/TrackNav";
import EditHabitForm from "../Shared/EditHabitForm";
import NewHabitForm from "../Shared/NewHabitForm";
import DeleteHabitButton from "../Shared/DeleteHabitButton";
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    date: String,
    habits: Array,
    tracking: Array
  },

  components: {
    Toggle,
    TrackNav,
    EditHabitForm,
    NewHabitForm,
    DeleteHabitButton
  },

  data() {
    return {
      tracks: [],
      active_habit: null,
      edit_habit_form: {}
    };
  },

  methods: {
    toggled: function(id) {
      this.tracks[id] = !this.tracks[id];
      if (this.tracks[id]) {
        axios.post("/track/", {
          date: this.date,
          habit: id
        });
      } else {
        axios.post("/track/delete", {
          date: this.date,
          habit: id
        });
      }
    },

    habit_count: function() {
      return this.habits.length;
    },

    track_count: function() {
      for (
        var i = 0, len = 0;
        i < this.tracks.length;
        i++, this.tracks[i] == true && len++
      );

      return len;
    },

    hoverOnHabit: function(id) {
      this.active_habit = id;
    },

    removeLocalHabit: function(id, response) {
      let index = this.habits.findIndex(item => item.hab_id === id);
      this.habits.splice(index, 1);
      this.tracks.splice(id, 1);
    }
  },

  created() {
    this.tracking.forEach(element => {
      this.tracks[element.tra_habit] = true;
    });
  }
};
</script>
