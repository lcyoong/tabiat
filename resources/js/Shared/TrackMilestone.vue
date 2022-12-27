<template>
    <ul v-if="(milestones.length > 0)" role="list">
    <li v-for="milestone of milestones" :key="milestone.hab_id" class="bg-white shadow sm:rounded-md my-4">
        <div class="flex items-center px-4 py-4 sm:px-6">
        <!--Milestone display-->
        <div class="flex min-w-0 flex-1 items-center">
            <p class="truncate text-sm font-medium">{{ milestone.mil_date }}</p>
            <div class="min-w-0 flex-1 px-4">
            <p class="truncate text-sm font-medium">{{ milestone.mil_content }}</p>
            </div>
        </div>

        <!--Milestone options-->
        <div>
            <DropDownOptions :id="('milestone'+milestone.hab_id)" :options="[
                { label: 'Edit', action: 'editMilesoneClicked'},
                { label: 'Remove', action: 'removeMilestoneClicked'},
            ]"
            @editMilesoneClicked="editMilestone(milestone)"
            @removeMilestoneClicked="removeMilestone(milestone)"
            />
        </div>
        </div>
    </li>
    </ul>
    <div v-else class="text-lg text-bold text-gray-300 my-5">
    Enter milestones of your achievements. Nothing is too small.
    </div>      
    <MilestoneCreate :gol_id="gol_id" :errors="errors"/>

    <MilestoneRemoveModal :key="1" :errors="errors" :milestone="removeMilestoneForm" ref="removeMilestoneModalRef"/>
</template>

<script setup>
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import MilestoneCreate from "@/Shared/MilestoneCreate";
import DropDownOptions from "@/Shared/DropDownOptions";
import MilestoneRemoveModal from "@/Modals/MilestoneRemoveModal";

let prop = defineProps({
  milestones: Array,
  gol_id: String,
  errors: Object
})

let editMilestoneForm = ref()

let removeMilestoneForm = ref()

const removeMilestoneModalRef = ref()

function editMilestone(milestone) {
  editMilestoneForm.value = milestone
}

function removeMilestone(milestone) {
  editMilestoneForm.value = null
  removeMilestoneForm.value = milestone
  removeMilestoneModalRef.value.key = 2
  removeMilestoneModalRef.value.show()
}
</script>