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

function setCurrentChapter(chapterId) {
    console.log("Setting current chapter to:", chapterId);
    if(chapterId == null) {
        console.log("Chapter ID is null, ending the game.");
        end.value = true;
        return;
    }
    const nextChapter = chapters.value.find((chapter) => chapter.id === chapterId);
    if (nextChapter) {
        currentChapter.value = nextChapter;
    }
}

//Charge le premier chapitre dès qu'on reçoit tous les chapitres
watch(chaptersData, (newChapters) => {
    chapters.value = newChapters;
    console.log("Chapters loaded:", chapters.value);
    currentChapter.value = getStartingChapter(chapters.value);
});

//Change les choix en fonction du chapitre
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

    <div v-if="end">
        <h1>End</h1>
        <p>Thank you for playing!</p>
        <RouterLink :to="'/'">Go back home now !!!</RouterLink>
    </div>
</template>
<style scoped></style>
