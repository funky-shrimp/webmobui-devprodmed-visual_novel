<script setup>
import { ref, watch, inject } from "vue";

import { getChapter, getChapterChoices } from "@/lib/StoriesManager.js";

import TheChapterForm from "@/components/Forms/TheChapterForm.vue";
import ChoicesList from "@/components/ChoicesList.vue";

const route = inject("route");
const chapterId = route.params.chapterId;
const storyId = route.params.storyId;

const chapter = ref({
    content: "",
    image: null,
});

const choices = ref([]);

const {
    data: chapterData,
    error: chapterError,
    loading: chapterLoading,
} = getChapter(chapterId);

const {
    data: choicesData,
    error: choicesError,
    loading: choicesLoading,
} = getChapterChoices(chapterId);

watch(chapterData, (newChapter) => {
    if (newChapter) {
        chapter.value = newChapter;
    }
});

watch(choicesData, (newChoices) => {
    if (newChoices) {
        choices.value = newChoices;
    }
});

</script>
<template>
    <div id="chaptersInfo">
        <h2>Chapters</h2>
        <TheChapterForm :chapter="chapter" />
    </div>
    <ChoicesList :choices="choices" />
</template>
<style scoped></style>
