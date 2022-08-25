<template>
  <Layout title="New User">
    <template #header>
      <h1>New Goal</h1>
    </template>
  </Layout>
</template>

<script setup>
import Layout from "@/Shared/Layout";
import NormalButton from "@/Shared/Button";
import moment from "moment";

let props = defineProps({
})

const dateFormat = (value) => {
  return moment(value).format("DD MMM, YYYY");
}

</script>
