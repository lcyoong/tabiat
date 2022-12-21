<template>
    <GoalSentencePublic :user="user" class="truncate flex space-x-1">
        <template #name>
        <div class="text-indigo-600">{{name}}</div>
        </template>
        <template #days>
        <div class="text-indigo-600">{{days}}</div>
        </template>
    </GoalSentencePublic>
</template>

<script setup>
import GoalSentencePublic from "@/Shared/GoalSentencePublic";

defineProps({
    user: Object,
    name: String,
    days: Number
})

</script>