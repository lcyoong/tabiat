<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <div
    v-show="show()"
    class="relative z-10"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
    @click="$store.commit('hideTrackPhoto')"
  >
    <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
    -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-80 transition-opacity"></div>

    <div class="fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
        <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
        <div
          class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full"
          @click.stop
        >
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"></div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6">
            <h1 v-if="$store.getters.trackPhoto">
              Upload a photo for the
              <i>{{ $store.getters.trackPhoto.hab_name }}</i> habit
            </h1>
            <form class="flex flex-column justify-between space-x-2" @submit.prevent="attachPhoto">
              <input
                type="file"
                @input="form.photo = $event.target.files[0]"
                class="w-full grow border-gray-300 text-sm"
              />
              <button
                type="submit"
                class="rounded-full bg-indigo-500 text-white text-sm px-4"
              >Submit</button>
              <button
                type="button"
                @click="cancelForm"
                class="rounded-full bg-gray-200 text-sm px-4"
              >Cancel</button>
            </form>
          </div>
          <!-- <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
              type="button"
              class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
            >Deactivate</button>
            <button
              type="button"
              class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
            >Cancel</button>
          </div>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  data() {
    return {
      form: this.$inertia.form({
        photo: null,
        track: null
      })
    };
  },

  methods: {
    show: function() {
      if (this.$store.getters.trackPhoto) return true;
      return false;
    },

    attachPhoto: function(id) {
      this.form.track = this.$store.getters.trackPhoto.tra_id;
      this.form.post("/track/photos");
    }
  },
  watch: {
    track(newValue, oldValue) {
      console.log(newValue);
    }
  }
};
</script>