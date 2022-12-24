<template>
    <LayoutPublic :title="goal.gol_name">
        <template #header>
            <div class="flex space-x-1 items-center justify-left">
                <img class="h-8 w-8 rounded-full" :src="user.avatar" alt />
                <GoalSentenceReadOnlyPublic
                :name="goal.gol_name" 
                :days="goal.gol_days"
                :user="user"
                class="text-2xl"
                />
                <CountDown 
                :fromDate="goal.created_at"
                :days="goal.gol_days"
                class="ml-4"
                />
            </div>
        </template>
        <div class="flex gap-2">
            <Calendar :goal="goal" class="w-4/5"/>
            <div class="w-1/5 flex flex-col gap-2">
                <div v-for="habit in goal.habits" class="flex gap-2 justify-left items-center">
                    <div class="flex h-5 w-5 items-center justify-center rounded-full bg-indigo-600x font-semibold text-white" :style="{'background-color': habit.hab_color}"></div> 
                    <div class="text-xs">{{ habit.hab_name }}</div>
                </div>
            </div>
        </div>
    </LayoutPublic>
</template>

<script setup>
import LayoutPublic from "@/Shared/LayoutPublic";
import GoalSentenceReadOnlyPublic from "@/Shared/GoalSentenceReadOnlyPublic";
import CountDown from "@/Shared/CountDown";
import Calendar from "@/Shared/Calendar";

defineProps({
    goal: Object,
    user: Object
})

</script>