<script setup>
import { ref, watch, inject } from "vue";
import {
    getStory,
    updateStory,
    getStoryChapters,
} from "@/lib/StoriesManager.js";

import TheStoryForm from "@/components/Forms/TheStoryForm.vue";
import ChaptersList from "../components/ChaptersList.vue";

const route = inject("route");
const storyId = route.params.storyId;

//Prevent an update if no changes made
const initialStory = {
    title: "",
    summary: "",
};

const story = ref({
    title: "",
    summary: "",
});

const chapters = ref([]);

const {
    data: storyData,
    error: storyError,
    loading: storyLoading,
} = getStory(storyId);

const {
    data: chaptersData,
    error: chaptersError,
    loading: chaptersLoading,
} = getStoryChapters(storyId);

function updateStoryInfo() {
    //Prevent useless update
    if (
        story.value.title === initialStory.title &&
        story.value.summary === initialStory.summary
    ) {
        return;
    }



    const { data, error, loading } = updateStory(storyId, story.value);

    watch(data, (newData) => {
        if (newData) {
            console.log("updated");
        }
    });
    watch(error, (newError) => {
        console.log(newError);
        if (newError) {
            alert("Error updating story: " + newError.data.message);
        }
    });
    
}

watch(storyData, (newData) => {
    initialStory.title = newData.title;
    initialStory.summary = newData.summary;
    story.value.title = newData.title;
    story.value.summary = newData.summary;
});

watch(chaptersData, (newData) => {
    chapters.value = newData;
});

</script>
<template>
    <h1>Edit Story</h1>
    <div id="storyInfo">
        <h2>Story Info</h2>
        <TheStoryForm v-model="story" @update="updateStoryInfo" />
    </div>
    <ChaptersList :chapters="chapters" />
</template>
<style scoped></style>
