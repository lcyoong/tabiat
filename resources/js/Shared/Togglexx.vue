<template>
  <button
    @click="toggle()"
    type="button"
    class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    :class="{
        'bg-gray-200': value != true,
        'bg-indigo-600': value == true,
    }"
    role="switch"
    aria-checked="false"
  >
    <span class="sr-only">Use setting</span>
    <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
    <span
      aria-hidden="true"
      class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"
      :class="{
          'translate-x-0': value != true,
          'translate-x-5': value == true,
      }"
    ></span>
  </button>
</template>

<script>
export default {
  props: {
    keyValue: Number,
    init_value: Boolean
  },

  data() {
    return {
      value: this.init_value
    };
  },

  methods: {
    toggle: function() {
      this.value = !this.value;
      this.$emit("toggled", this.keyValue);
    }
  }
};
</script>