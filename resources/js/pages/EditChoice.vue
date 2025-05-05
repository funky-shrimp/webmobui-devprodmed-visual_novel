<script setup>
import { ref, watch, inject, computed } from "vue";
import TheChoiceForm from "@/components/Forms/TheChoiceForm.vue";
import { getChoice, getStoryChapters } from "@/lib/StoriesManager.js";

const route = inject("route");
const storyId = route.params.storyId;
const chapterId = route.params.chapterId;
const choiceId = route.params.choiceId;

const choice = ref([]);

const {
    data: choiceData,
    error: choiceError,
    loading: choiceLoading,
} = getChoice(chapterId);

const availableChapters = ref([]);

const {
    data: availableChaptersData,
    error: availableChaptersError,
    loading: availableChaptersLoading,
} = getStoryChapters(storyId);

watch(choiceData, (newChoice) => {
    if (newChoice) {
        choice.value = newChoice;
    }
    console.log("choice", choice.value);
});

watch(availableChaptersData, (newAvailableChapters) => {
    if (newAvailableChapters) {
        availableChapters.value = newAvailableChapters
    }
});


</script>
<template>
    <h1>Edit Choice</h1>
    <TheChoiceForm :choice="choice" :availableChapters="availableChapters" />
</template>
<style scoped></style>
