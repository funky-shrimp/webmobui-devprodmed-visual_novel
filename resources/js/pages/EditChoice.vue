<script setup>
import { ref, watch, inject, computed } from "vue";
import TheChoiceForm from "@/components/Forms/TheChoiceForm.vue";
import {
    getChoice,
    getStoryChapters,
    updateChoice,
} from "@/lib/StoriesManager.js";

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

function updateChoiceInfo() {
    const { data, error, loading } = updateChoice(choiceId, choice.value);

    watch(data, (newData) => {
        if (newData) {
            console.log("updated");
        }
    });
    watch(error, (newError) => {
        console.log(newError);
        if (newError) {
            console.error("Error updating choice:", newError);
        }
    });
}

watch(choiceData, (newChoice) => {
    if (newChoice) {
        choice.value = newChoice;
    }
    console.log("choice", choice.value);
});

watch(availableChaptersData, (newAvailableChapters) => {
    if (newAvailableChapters) {
        availableChapters.value = newAvailableChapters;
    }
});
</script>
<template>
    <div class="titlenav">
        <RouterLink :to="`/edit/${storyId}/${chapterId}`" class="previous">&lt;</RouterLink>
        <h1>Edit Choice</h1>
    </div>
    <TheChoiceForm
        :choice="choice"
        :availableChapters="availableChapters"
        @update="updateChoiceInfo"
    />
</template>
<style scoped></style>
