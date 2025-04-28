<script setup>
import {ref} from "vue"
import { getStories } from '../js/lib/StoriesManager.js';
import TheHeader from './components/TheHeader.vue';
import StoriesList from './components/StoriesList.vue';

const stories = ref()

getStories().then((data)=>{
    stories.value = data
    console.log(stories.value)
})

</script>
<template>
    <TheHeader></TheHeader>
    <StoriesList :stories="stories"></StoriesList>
</template>
<style scoped>

</style>

