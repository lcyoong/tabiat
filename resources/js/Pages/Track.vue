<template>
  <MainNav />
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <TrackNav :date="date" />

    <div class="my-4">
      <span
        class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800"
      >{{ trackCount() }}/ {{ habitCount() }}</span>
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
          v-if="edit_habit_form.hab_id == habit.hab_id"
          :form="habit"
          :errors="localErrors.update_habit"
          @cancel-form="cancelEditForm"
          @updated-successful="edit_habit_form = {}"
        />
        <!--end: Edit habit form-->
        <TrackItem
          v-else
          :habit="habit"
          :is_active="active_habit == habit.hab_id"
          :date="date"
          @clickEdit="edit_habit_form = habit"
        />
      </li>
    </ul>
    <!--end habit list-->

    <NewHabitForm :errors="localErrors.store_habit" />
    <AttachPhoto></AttachPhoto>

    <!--end new habit-->
  </div>
</template>

<script>
import TrackNav from "../Shared/TrackNav";
import TrackItem from "../Shared/TrackItem";
import EditHabitForm from "../Shared/EditHabitForm";
import NewHabitForm from "../Shared/NewHabitForm";
import MainNav from "../Shared/MainNav";
import AttachPhoto from "../Shared/AttachPhoto";
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

export default {
  props: {
    date: String,
    habits: Array,
    tracking: Array,
    errors: Object
  },

  components: {
    TrackNav,
    TrackItem,
    EditHabitForm,
    NewHabitForm,
    MainNav,
    AttachPhoto
  },

  data() {
    return {
      // tracks: [],
      active_habit: null,
      edit_habit_form: {},
      localErrors: this.errors
    };
  },

  watch: {
    errors(newValue) {
      this.localErrors = newValue;
    }
  },

  methods: {
    habitCount: function() {
      return this.habits.length;
    },

    trackCount: function() {
      // return this.tracks.filter((track) => track == true).length;
      return this.$store.getters.trackCount;
    },

    hoverOnHabit: function(id) {
      this.active_habit = id;
    },

    cancelEditForm: function() {
      this.edit_habit_form = {};
      this.localErrors = {};
    }
  },

  created() {
    //   Load the tracks
    this.$store.commit("clearTracks");

    this.tracking.forEach(element => {
      this.$store.commit("addTrack", element);
      // this.tracks[element.tra_habit] = true;
    });

    // console.log(this.$store.state.track.tracks);
  },

  setup() {
    const user = computed(() => usePage().props.value.user);
    return { user };
  }
};
</script>
