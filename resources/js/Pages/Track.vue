<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <TrackNav :date="date" />

    <div>
      <span
        class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800"
      >{{ track_count() }}/ {{ habit_count() }}</span>
      daily habits achieved
    </div>
    <!--end track counter-->

    <ul class="space-y-6 my-6" @mouseout="active_habit = 0">
      <li
        class="hover:bg-indigo-100 px-4 py-2"
        v-for="habit in habits"
        @mouseover="hoverOnHabit(habit.hab_id)"
      >
        <div v-if="edit_habit_form == habit">
          <form class="flex flex-column justify-between space-x-2" @submit.prevent="updateHabit">
            <input
              type="text"
              v-model="edit_habit_form.hab_name"
              class="rounded-xl w-full grow border-gray-300 text-sm"
            />
            <button type="submit" class="rounded-full bg-indigo-500 text-white text-sm px-4">Submit</button>
            <button
              @click="edit_habit_form = null"
              class="rounded-full bg-gray-200 text-sm px-4"
            >Cancel</button>
          </form>
        </div>
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

            <a href="#" @click="deleteHabit(habit.hab_id)">
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
            <!--delete habit button-->
          </div>
          <!--end habit controls-->
        </div>
      </li>
    </ul>
    <!--end habit list-->

    <button
      v-if="showAddHabitForm == false"
      @click="showAddHabitForm = true"
      type="button"
      class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >New habit</button>
    <div v-else>
      <form class="flex flex-column justify-between space-x-2" @submit.prevent="addNewHabit">
        <input
          type="text"
          v-model="new_habit_form.hab_name"
          class="rounded-xl w-full grow border-gray-300 text-sm"
        />
        <button class="rounded-full bg-indigo-500 text-white text-sm px-4">Submit</button>
        <button
          @click="showAddHabitForm = false"
          class="rounded-full bg-gray-200 text-sm px-4"
        >Cancel</button>
      </form>
      <!--end new habit-->
    </div>
  </div>
</template>

<script>
import Toggle from "../Shared/Toggle";
import TrackNav from "../Shared/TrackNav";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";

export default {
  props: {
    date: String,
    habits: Array,
    tracking: Array
  },

  components: { Toggle, TrackNav },

  data() {
    return {
      tracks: [],
      active_habit: null,
      showAddHabitForm: false,
      edit_habit_form: {},
      new_habit_form: {}
    };
  },

  methods: {
    toggled: function(id) {
      console.log(id);
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

    deleteHabit: function(id) {
      Inertia.delete("/habit/" + id, {
        preserveState: true,
        preserveScroll: true,
        onBefore: () => confirm("Are you sure you want to delete this user?"),
        onSuccess: page => {
          console.log(page);
        }
      });
    },

    addNewHabit: function() {
      Inertia.post("/habit", this.new_habit_form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
          this.showAddHabitForm = false;
          this.new_habit_form = null;
        }
      });
    },

    updateHabit: function(id) {
      Inertia.post(
        "/habit/" + this.edit_habit_form.hab_id,
        this.edit_habit_form,
        {
          preserveState: true,
          preserveScroll: true,
          onSuccess: page => {
            this.edit_habit_form = null;
          }
        }
      );
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
