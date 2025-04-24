<script setup>
import { ref, watch } from "vue";
import { getStory, updateStory } from "../lib/StoriesManager.js";
import TheStoryForm from "../components/Forms/TheStoryForm.vue";
import TheChapterForm from "../components/Forms/TheChapterForm.vue";
import TheChoiceForm from "../components/Forms/TheChoiceForm.vue";

const storyId = +window.location.hash.slice(1).split("-")[1];

//Prevent an update if no changes made
const initialStory = {
    title: "",
    summary: "",
};

const story = ref({
    title: "",
    summary: "",
});

const chapterForms = ref([]);

const { data, error, loading } = getStory(storyId);

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

function addChapterForm() {
    chapterForms.value.push({
        content: "",
        image: null,
    });
}

watch(data, (newData) => {
    initialStory.title = newData.title;
    initialStory.summary = newData.summary;
    story.value.title = newData.title;
    story.value.summary = newData.summary;
});
</script>
<template>
    <h1>Edit Story</h1>
    <div id="storyInfo">
        <h2>Story Info</h2>
        <TheStoryForm v-model="story" @update="updateStoryInfo" />
    </div>
    <div id="chaptersInfo">
        <h2>Chapters</h2>
        <button id="chapterAdd" @click="addChapterForm">Add Chapter</button>
        <div v-for="form in chapterForms" :key="form.id">
            <TheChapterForm :storyId="storyId" :mode="form.mode" />
        </div>
    </div>

</template>
<style scoped></style>
