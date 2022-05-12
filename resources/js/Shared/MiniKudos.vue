<template>
  <div class="relative">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="h-5 w-5 transition opacity-0 ease-linear duration-300 absolute -top-5 -mb-5 fill-green-600"
      :class="{ 'opacity-100 -translate-y-1 scale-110': show }"
      viewBox="0 0 20 20"
      fill="currentColor"
    >
      <path
        fill-rule="evenodd"
        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
        clip-rule="evenodd"
      />
    </svg>
  </div>
</template>

<script>
export default {
  props: {
    id: Number,
    triggerId: Number
  },

  data() {
    return {
      show: false
    };
  },

  watch: {
    triggerId(value) {
      if (value == this.id) {
        this.show = true;
        setTimeout(() => {
          this.show = false;
        }, 1000);
      }
    }
  }
};
</script>
