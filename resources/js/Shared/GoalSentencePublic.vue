<template>
    <div>
        <div>{{ user.name }} wants to</div>
        <slot name="name"></slot>
        <div>in</div>
        <slot name="days"></slot>
        <div>days</div>
    </div>
</template>

<script setup>
defineProps({
    user: Object
})
</script>