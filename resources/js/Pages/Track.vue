<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
      <div>
        <a :href="'/track/' + previousDay(date)">Previous day</a>
      </div>
      <div class="text-center">
        <h1
          class="text-2xl font-bold leading-7 mt-4 text-gray-900 sm:text-xl sm:truncate"
        >{{ getHumanDate(date) }}</h1>
        <div class="text-xs">{{ getDateContext(date) }}</div>
      </div>
      <div>
        <a :href="'/track/' + nextDay(date)">Next day</a>
      </div>
    </div>
    <div>
      <span
        class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800"
      >{{ track_count() }}/ {{ habit_count() }}</span>
      daily habits achieved
    </div>
    <ul class="space-y-6 my-6" @mouseout="active_habit = 0">
      <li
        class="flex items-center justify-between hover:bg-indigo-100 px-4 py-2"
        v-for="habit in habits"
        @mouseover="hoverOnHabit(habit.hab_id)"
      >
        <Toggle
          :init_value="tracks[habit.hab_id]"
          :key-value="habit.hab_id"
          :check="true"
          @toggled="toggled"
        />
        <div class="ml-4 grow">{{ habit.hab_name }}</div>
        <div
          class="text-right"
          :class="{
                        'inline-bloc': active_habit == habit.hab_id,
                        hidden: active_habit != habit.hab_id,
                    }"
        >
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
        </div>
      </li>
    </ul>
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
          v-model="habit_title"
          class="rounded-xl w-full grow border-gray-300 text-sm"
        />
        <button class="rounded-full bg-indigo-500 text-white text-sm px-4">Submit</button>
        <button
          @click="showAddHabitForm = false"
          class="rounded-full bg-gray-200 text-sm px-4"
        >Cancel</button>
      </form>
    </div>
    <!-- <Toggle init_value="1" check="0" /> -->
  </div>
</template>

<script>
import moment from "moment";
import Toggle from "../Shared/Toggle";
const date_format = "YYYY-MM-DD";
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    habits: Array,
    tracking: Array,
    date: String,
    human_difference: String
  },
  components: { Toggle },

  data() {
    return {
      tracks: [],
      active_habit: null,
      showAddHabitForm: false,
      habit_title: null
    };
  },

  methods: {
    getHumanDate: function(date) {
      return moment(date).format("DD MMM, YYYY");
    },

    getDateContext: function(date) {
      const today = moment().format(date_format);
      const tomorrow = moment()
        .add(1, "day")
        .format(date_format);
      const yesterday = moment()
        .subtract(1, "day")
        .format(date_format);

      if (date == today) {
        return "today";
      } else if (date == yesterday) {
        return "yesterday";
      } else if (date == tomorrow) {
        return "tomorrow";
      }

      return moment(date)
        .endOf("day")
        .fromNow();
    },

    previousDay: function(date) {
      return moment(date)
        .subtract(1, "days")
        .format(date_format);
    },

    nextDay: function(date) {
      return moment(date)
        .add(1, "days")
        .format(date_format);
    },

    // toggle: function(id, date, event) {
    //   this.tracks[id] = !this.tracks[id];

    //   if (this.tracks[id]) {
    //     axios.post("/track/", {
    //       date: this.date,
    //       habit: id
    //     });
    //   } else {
    //     axios.post("/track/delete", {
    //       date: this.date,
    //       habit: id
    //     });
    //   }
    // },
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
      axios
        .post("/habit/delete/" + id)
        // .then(Inertia.reload({ only: ["habits"] }));
        .then(function(response) {
          Inertia.reload({ only: ["habits"] });
        });

      // .then(this.removeLocalHabit.bind(this, id));
    },

    addNewHabit: function() {
      var self = this;
      axios
        .post("/habit", {
          hab_name: this.habit_title
        })
        .then(function(response) {
          self.showAddHabitForm = false;
          self.habit_title = null;
          // Refresh the list
          Inertia.reload({ only: ["habits"] });
        });
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
