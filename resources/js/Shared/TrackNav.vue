<template>
  <div class="flex items-center justify-between">
    <div>
      <Link
        class="rounded-full px-4 py-2 bg-blue-600 text-white text-sm hover:bg-blue-500"
        :href="'/track/' + previousDay()"
      >Previous day</Link>
    </div>
    <div class="text-center">
      <h1
        class="text-2xl font-bold leading-7 mt-4 text-gray-900 sm:text-xl sm:truncate"
      >{{ getHumanDate() }}</h1>
      <div class="text-xs">{{ getDateContext() }}</div>
    </div>
    <div>
      <Link
        class="rounded-full px-4 py-2 bg-blue-600 text-white text-sm hover:bg-blue-500"
        :href="'/track/' + nextDay()"
      >Next day</Link>
    </div>
  </div>
</template>

<script>
import moment from "moment";
const date_format = "YYYY-MM-DD";

export default {
  props: {
    date: String
  },
  methods: {
    getHumanDate: function() {
      let date = this.date;
      return moment(date).format("DD MMM, YYYY");
    },

    getDateContext: function() {
      let date = this.date;
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

    previousDay: function() {
      let date = this.date;
      return moment(date)
        .subtract(1, "days")
        .format(date_format);
    },

    nextDay: function() {
      let date = this.date;
      return moment(date)
        .add(1, "days")
        .format(date_format);
    }
  }
};
</script>