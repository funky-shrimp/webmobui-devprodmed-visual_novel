<script setup>
import StoriesList from "@/components/StoriesList.vue";
import { ref, watch } from "vue";
import { getStories, deleteStory, createStory } from "@/lib/StoriesManager.js";

const stories = ref();

const {
    data: storiesData,
    error: storiesError,
    loading: storiesLoading,
} = getStories();

watch(storiesData, (newStoriesData) => {
    stories.value = newStoriesData;
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

function createDummyStory() {
    const dummyStory = {
        title: "Dummy Story",
        summary: "This is a dummy story.",
    };
    
    const {
        data: dummyStoryData,
        error: dummyStoryError,
        loading: dummyStoryLoading,
    } = createStory(dummyStory);

    watch(dummyStoryData, (newDummyStoryData) => {
        if (newDummyStoryData) {
            console.log("Dummy story created successfully:", newDummyStoryData);
            stories.value.push(newDummyStoryData);
        }
    });
}
</script>
<template>
    <StoriesList
        :stories="stories"
        @delete="clickDelete"
        @createStory="createDummyStory"
    ></StoriesList>
</template>
<style scoped></style>
