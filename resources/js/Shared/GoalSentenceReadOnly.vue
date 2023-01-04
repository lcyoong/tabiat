<template>
    <GoalSentence class="truncate flex space-x-1">
        <template #name>
        <div class="text-indigo-600">{{name}}</div>
        </template>
        <template #days>
        <div class="text-indigo-600">{{days}}</div>
        </template>
    </GoalSentence>
</template>

<script setup>
import GoalSentence from "@/Shared/GoalSentence";

defineProps({
    name: String,
    days: Number
})

</script>