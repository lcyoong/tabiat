<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
      <div>
        <a href="#">Previous day</a>
      </div>
      <div class="text-center">
        <h1
          class="text-2xl font-bold leading-7 mt-4 text-gray-900 sm:text-xl sm:truncate"
        >{{ date }}</h1>
        <div class="text-xs">{{ human_difference }}</div>
      </div>
      <div>
        <a href="#">Next day</a>
      </div>
    </div>
    <div class="my-6">
      <span
        class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800"
      >8/10</span>
      daily habits achieved
    </div>
    <ul>
      <li class="my-4 flex items-center" v-for="habit in habits">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
        <button
          type="button"
          class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          role="switch"
          aria-checked="false"
        >
          <span class="sr-only">Use setting</span>
          <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
          <span
            aria-hidden="true"
            class="translate-x-0 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"
          ></span>
        </button>
        <div class="ml-4">{{ habit.hab_name }}</div>
        <div class="grow text-right">
          <a href>x</a>
        </div>
      </li>
    </ul>
    <button
      type="button"
      class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >New habit</button>
  </div>
</template>

<script>
export default {
  props: {
    habits: Array,
    tracking: Array,
    date: String,
    human_difference: String
  }
};
</script>