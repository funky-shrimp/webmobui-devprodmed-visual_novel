<script setup>
import { ref, watch, inject, onBeforeMount } from "vue";
import { getStartingChapter } from "@/composables/gameManager.js";

import { getStoryChapters, getChapterChoices } from "@/lib/StoriesManager.js";
import { RouterLink } from "vue-router";

const route = inject("route");
const storyId = route.params.storyId;

const chapters = ref([]); // est appelé une fois

const currentChapter = ref(null); // s'adapte au clic du choix
const choices = ref([]); // est appelé à chaque changement de chapitre

const end = ref(false);

const {
    data: chaptersData,
    error: chaptersError,
    loading: chaptersLoading,
} = getStoryChapters(storyId);

/**
 * Function to set the current chapter for the dynamic state
 * @param {string} chapterId - The ID of the chapter to set as current
 */
function setCurrentChapter(chapterId) {
    console.log("Setting current chapter to:", chapterId);
    if (chapterId == null) {
        console.log("Chapter ID is null, ending the game.");
        end.value = true;
        return;
    }
    const nextChapter = chapters.value.find(
        (chapter) => chapter.id === chapterId
    );
    if (nextChapter) {
        currentChapter.value = nextChapter;
    }
}

//Load the first chapter once the chapters are loaded
watch(chaptersData, (newChapters) => {
    chapters.value = newChapters;
    console.log("Chapters loaded:", chapters.value);
    currentChapter.value = getStartingChapter(chapters.value);
});

//Set choices for the current chapter once it's loaded
watch(currentChapter, (newChapter) => {
    console.log("Current chapter changed:", newChapter);
    const {
        data: choicesData,
        error: choicesError,
        loading: choicesLoading,
    } = getChapterChoices(newChapter.id);

    watch(choicesData, (newChoices) => {
        choices.value = newChoices;
        console.log("Choices loaded:", choices.value);
    });
});
</script>
<template>
    <div v-if="chaptersLoading" id="loader">Loading...</div>
    <div v-else-if="currentChapter && !end">
        <h1>{{ currentChapter.title }}</h1>
        <p class="chaptersContent">{{ currentChapter.content }}</p>
        <div class="chaptersImage" v-if="currentChapter.image">
            <img
                :src="`/storage/${currentChapter.image}`"
                alt="Chapter Image"
            />
        </div>
        <div class="choices">
            <ul>
                <li v-for="choice in choices" :key="choice.id">
                    <button @click="setCurrentChapter(choice.next_chapter_id)">
                        {{ choice.text }}
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <div v-if="end" id="end">
        <h1>End</h1>
        <p>Thank you for playing!</p>
        <RouterLink :to="'/'">Go back home now !!!</RouterLink>
    </div>
</template>
<style scoped>
img {
    width: 100px;
}
.chaptersContent {
    font-size: 1.2em;
    margin: auto;
    width: 300px;
    text-align: justify;
}

ul {
    list-style-type: none;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}
li{
    width:300px;
}

li button {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2em;
}

li button:hover {
    background-color: #0056b3;
}

/* align end*/

#end {
    text-align: center;
    margin-top: 20px;
}
#end a {
    text-decoration: none;
    color: #007bff;
    font-size: 1.5em;
}

</style>
