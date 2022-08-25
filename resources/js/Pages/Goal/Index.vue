<template>
  <MainNav />
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
    <Link :href="route('goal.create')"><normal-button type="button">New Goal</normal-button></Link>

    <div class="flow-root">
      <ul role="list">
        <li v-for="goal of goals.data">
          <div class="relative pb-8">
            <!-- <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span> -->
            <div class="relative flex space-x-3">
              <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                <div>
                  <p class="text-sm text-gray-500">{{ goal.gol_name }}</p>
                </div>
                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                  <time datetime="2020-09-28">{{ dateFormat(goal.created_at) }}</time>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>

      <pagination class="mt-5" :links="goals.links" />
    </div>
  </div>
</template>

<script setup>
import MainNav from "@/Shared/MainNav";
import NormalButton from "@/Shared/Button";
import moment from "moment";
import Pagination from "@/Shared/Pagination";

let props = defineProps({
  goals: Array
})

const dateFormat = (value) => {
  return moment(value).format("DD MMM, YYYY");
}

</script>
