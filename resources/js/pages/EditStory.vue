<script setup>
import { ref, watch } from "vue";
import {
    getStory,
    updateStory,
    getStoryChapters,
} from "../lib/StoriesManager.js";
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
const choiceForms = ref([]);

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

function addChapterForm() {
    chapterForms.value.push({
        content: "",
        image: null,
    });
}

function addChoiceForm() {
    choiceForms.value.push({
        text: "",
        nextChapterId: null,
        chapters : [],
    });
}

watch(storyData, (newData) => {
    initialStory.title = newData.title;
    initialStory.summary = newData.summary;
    story.value.title = newData.title;
    story.value.summary = newData.summary;
});

watch(chaptersData, (newData) => {
    console.log(newData);

    newData.forEach((chapter) => {
        chapterForms.value.push({
            id: chapter.id,
            content: chapter.content,
            image: chapter.image,
            mode: "update",
        });
    });
});


function checkChaptersData(form){
    console.log(form);
}

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
            <TheChapterForm :chapter="form" @update="checkChaptersData(form)"/>
        </div>
    </div>
    <div id="choicesInfo">
        <h2>Choices</h2>
        <button id="choiceAdd" @click="addChoiceForm">Add Choice</button>
        <div v-for="form in choiceForms" :key="form.id">
            <TheChoiceForm :choice="form" />
        </div>
    </div>
</template>
<style scoped></style>
