<script setup>
import StoriesList from "@/components/StoriesList.vue";
import { ref, watch } from "vue";
import { getStories, deleteStory } from "@/lib/StoriesManager.js";

const stories = ref();

const { data, error, loading } = getStories();

watch(data, (newData) => {
    stories.value = newData;
    console.log(stories.value);
});


function clickDelete(id) {
    if (confirm("Are you sure you want to delete this story?")) {
        console.log("delete", id);
        const { data, error } = deleteStory(id);
        if (error.value) {
            console.error("Error deleting story:", error.value);
        } else {
            console.log("Story deleted successfully:", data.value);
            stories.value = stories.value.filter((story) => story.id !== id);
        }
    }
}
</script>
<template>
    <StoriesList
        :stories="stories"
        @delete="clickDelete"
    ></StoriesList>
</template>
<style scoped>


</style>
