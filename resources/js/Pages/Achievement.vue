<template>
  <MainNav />
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flow-root">
      <ul role="list">
        <li v-for="achievement of achievements.data">
          <div class="relative pb-8">
            <!-- <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span> -->
            <div class="relative flex space-x-3">
              <div>
                <span
                  class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white"
                >
                  <!-- Heroicon name: solid/check -->
                  <svg
                    class="h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </span>
              </div>
              <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                <div>
                  <p class="text-sm text-gray-500">{{ achievement.ach_code }}</p>
                </div>
                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                  <time datetime="2020-09-28">{{ dateFormat(achievement.created_at) }}</time>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>

      <pagination class="mt-5" :links="achievements.links" />
    </div>
  </div>
</template>

<script>
import MainNav from "../Shared/MainNav";
import moment from "moment";
import Pagination from "../Shared/Pagination";

export default {
  props: {
    achievements: Array
  },

  components: {
    MainNav,
    Pagination
  },

  methods: {
    dateFormat(value) {
      return moment(value).format("DD MMM, YYYY");
    }
  }
};
</script>
