<template>
  <MainNav />
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-8">
    <!-- <Link :href="route('goal.create')"><normal-button type="button">New Goal</normal-button></Link> -->
    <a href="#;" @click.prevent="goalModalRef.show()"><normal-button type="button">New Goal</normal-button></a>    

    <ul v-if="goals.data.length > 0" role="list">
      <li v-for="goal of goals.data" :key="goal.gol_id" class="overflow-hidden bg-white shadow sm:rounded-md my-4">
        <Link :href="route('goal.track', goal.gol_id)" class="block hover:bg-gray-50">
          <div class="flex items-center px-4 py-4 sm:px-6">
            <div class="flex min-w-0 flex-1 items-center">
              <div class="flex-shrink-0">
                <!-- <img class="h-12 w-12 rounded-full" :src="application.applicant.imageUrl" alt="" /> -->
              </div>
              <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                <div>
                  <GoalSentenceReadOnly :name="goal.gol_name" :days="goal.gol_days"/>
                </div>
                <div class="hidden md:block">
                  <div>
                    <p class="text-sm text-gray-900">
                      <CountDown :fromDate="goal.created_at" :days="goal.gol_days"/>
                      <!-- Since {{ goal.created_at }} -->
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </div>
          </div>
        </Link>
      </li>
    </ul>

  </div>
  <GoalCreateModal :errors="errors" ref="goalModalRef"></GoalCreateModal>
</template>

<script setup>
import MainNav from "@/Shared/MainNav";
import NormalButton from "@/Shared/Button";
import moment from "moment";
import { CheckCircleIcon, ChevronRightIcon } from '@heroicons/vue/outline'
import CountDown from "@/Shared/CountDown";
import GoalSentenceReadOnly from "@/Shared/GoalSentenceReadOnly";
import GoalCreateModal from "@/Modals/GoalCreateModal";
import { ref } from "vue";

let props = defineProps({
  goals: Object,
  errors: Object
})

const goalModalRef = ref()

const dateFormat = (value) => {
  return moment(value).format("DD MMM, YYYY");
}

</script>
