<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <a :href="'/track/' + previousDay(date)">Previous day</a>
            </div>
            <div class="text-center">
                <h1
                    class="text-2xl font-bold leading-7 mt-4 text-gray-900 sm:text-xl sm:truncate"
                >
                    {{ getHumanDate(date) }}
                </h1>
                <div class="text-xs">{{ getDateContext(date) }}</div>
            </div>
            <div>
                <a :href="'/track/' + nextDay(date)">Next day</a>
            </div>
        </div>
        <div class="my-6">
            <span
                class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800"
                >{{ track_count() }}/ {{ habit_count() }}
            </span>
            daily habits achieved
        </div>
        <ul>
            <li class="my-4 flex items-center" v-for="habit in habits">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
                <button
                    @click="toggle(habit.hab_id, date, $event)"
                    type="button"
                    class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    :class="{
                        'bg-gray-200': !tracks[habit.hab_id],
                        'bg-indigo-600': tracks[habit.hab_id],
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
                            'translate-x-0': !tracks[habit.hab_id],
                            'translate-x-5': tracks[habit.hab_id],
                        }"
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
        >
            New habit
        </button>
    </div>
</template>

<script>
import moment from "moment";
const date_format = "YYYY-MM-DD";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        habits: Array,
        tracking: Array,
        date: String,
        human_difference: String,
    },

    data() {
        return {
            tracks: [],
        };
    },

    methods: {
        getHumanDate: function (date) {
            return moment(date).format("DD MMM, YYYY");
        },
        getDateContext: function (date) {
            const today = moment().format(date_format);
            const tomorrow = moment().add(1, "day").format(date_format);
            const yesterday = moment().subtract(1, "day").format(date_format);

            if (date == today) {
                return "today";
            } else if (date == yesterday) {
                return "yesterday";
            } else if (date == tomorrow) {
                return "tomorrow";
            }

            return moment(date).endOf("day").fromNow();
        },

        previousDay: function (date) {
            return moment(date).subtract(1, "days").format(date_format);
        },

        nextDay: function (date) {
            return moment(date).add(1, "days").format(date_format);
        },

        toggle: function (id, date, event) {
            this.tracks[id] = !this.tracks[id];

            if (this.tracks[id]) {
                axios.post(
                    "/track/",
                    {
                        date: this.date,
                        habit: id,
                    },
                    {
                        onSuccess: (page) => {
                            console.log("hello");
                        },
                    }
                );
            } else {
                axios.post("/track/delete", {
                    date: this.date,
                    habit: id,
                });
            }
        },

        habit_count: function () {
            return this.habits.length;
        },

        track_count: function () {
            for (
                var i = 0, len = 0;
                i < this.tracks.length;
                i++, this.tracks[i] == true && len++
            );

            return len;
        },
    },

    created() {
        this.tracking.forEach((element) => {
            this.tracks[element.tra_habit] = true;
        });
    },
};
</script>
