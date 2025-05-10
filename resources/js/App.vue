<script setup>
import { RouterView, useRoute } from "vue-router";
import { ref, computed, provide } from "vue";
import TheHeader from "./components/TheHeader.vue";


provide('route',useRoute())

</script>
<template>
    <TheHeader></TheHeader>
    <RouterView />
</template>
<style scoped></style>
