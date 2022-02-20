<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold leading-7 my-4 text-gray-900 sm:text-xl sm:truncate">My Habits</h1>
    <ul>
      <li v-for="habit in habits">{{ habit.hab_name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    habits: Array
  }
};
</script>