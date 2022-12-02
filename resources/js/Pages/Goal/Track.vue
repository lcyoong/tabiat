<template>
  <Layout title="New User">
    <template #header>
      <div class="flex space-x-1 items-center justify-between">
        <GoalSentenceReadOnly :name="goal.gol_name" :days="goal.gol_days" class="text-2xl"/>
        <div class="ml-3 relative">
          <a href="#;" @click.prevent="showGoalMenu = !showGoalMenu"><DotsVerticalIcon class="h-5 w-5 text-gray-400"/></a>
          <div
              class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none transform"
              :class="{'transition ease-in duration-75 hidden opacity-0 scale-95' : !showGoalMenu,
                'transition ease-out duration-100 opacity-100 scale-100' : showGoalMenu,
              }"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="user-menu-button"
              tabindex="-1"
            >
              <a
                href="#;"
                @click.prevent="clickEditGoal()"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                tabindex="-1"
              >Edit</a>
              <Link
                href="/logout"
                method="post"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem"
                tabindex="-1"
                as="button"
                id="user-menu-item-2"
              >Delete</Link>
            </div>
        </div>
      </div>
    </template>

    <form class="flex items-start space-x-2" @submit.prevent="createHabit">
      <div class="flex-1">
        <input type="text" v-model="form.hab_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Stay in bed" />
        <ValidationError :error="errors.hab_name"/>
      </div>
      <button type="submit" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add</button>
    </form>

    <!--Track-->
    <div class="overflow-hidden bg-white shadow sm:rounded-md mt-4">
      <ul role="list" class="divide-y divide-gray-200">
        <li v-for="habit of goal.habits" :key="habit.hab_id">
            <div class="flex items-center px-4 py-4 sm:px-6">
              <div class="flex min-w-0 flex-1 items-center">
                <div class="flex-shrink-0">
                  <!-- <img class="h-12 w-12 rounded-full" :src="application.applicant.imageUrl" alt="" /> -->
                </div>
                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                  <div>
                    <p class="truncate text-sm font-medium">{{ habit.hab_name }}</p>
                  </div>
                </div>
              </div>
              <div>
                <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
              </div>
            </div>
        </li>
      </ul>
    </div>
    <GoalEditModal :errors="errors" :goal="goal" ref="goalModalRef"></GoalEditModal>
  </Layout>
</template>

<script setup>
import Layout from "@/Shared/Layout";
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import GoalSentenceReadOnly from "@/Shared/GoalSentenceReadOnly";
import GoalEditModal from "@/Modals/GoalEditModal";
import { DotsVerticalIcon, ChevronRightIcon } from '@heroicons/vue/outline'

let prop = defineProps({
  goal: Object,
  errors: Object
})

let showGoalMenu = ref(false)

const goalModalRef = ref()

const form = useForm({
  hab_goal: prop.goal.gol_id,
  hab_name: null,
});

function clickEditGoal() {
  goalModalRef.value.show()
  showGoalMenu.value = false
}

function createHabit() {
  Inertia.post(route("habit.store"), form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {
          form.hab_name = null
        }
      });  
}

</script>
