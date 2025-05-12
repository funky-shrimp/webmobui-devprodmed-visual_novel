<script setup>
import { ref, watch, inject } from "vue";

import {
    getChapter,
    getChapterChoices,
    updateChapter,
    createChoice,
    deleteChoice,
} from "@/lib/StoriesManager.js";

import TheChapterForm from "@/components/Forms/TheChapterForm.vue";
import ChoicesList from "@/components/ChoicesList.vue";

const route = inject("route");
const chapterId = route.params.chapterId;
const storyId = route.params.storyId;

const chapter = ref({
    title: "",
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

function createDummyChoice() {
    const dummyChoice = {
        text: "Dummy Choice",
        chapter_id: chapterId,
        next_chapter_id: null,
    };

    const {
        data: dummyChoiceData,
        error: dummyChoiceError,
        loading: dummyChoiceLoading,
    } = createChoice(dummyChoice);

    watch(dummyChoiceData, (newDummyChoiceData) => {
        if (newDummyChoiceData) {
            choices.value.push(newDummyChoiceData);
        }
    });
}

function updateChapterInfo() {
    const { data, error, loading } = updateChapter(chapterId, chapter.value);

    watch(data, (newData) => {
        chapter.value = newData;
    });
    watch(error, (newError) => {
        if (newError) {
            alert("Error updating story: " + newError.data.message);
        }
    });
}

function deleteChoiceClick(choiceId) {
    if (confirm("Are you sure you want to delete this Choice ?")) {
        const { data, error, loading } = deleteChoice(choiceId);

        watch(error, (newError) => {
            if (newError) {
                if (newError.status === 204) {
                    console.log("Chapter deleted successfully");
                    choices.value = choices.value.filter(
                        (choice) => choice.id !== choiceId
                    );
                }
            }
        });
    }
}

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
        <div class="titlenav">
            <!--go back to edit/storyId-->
            <RouterLink :to="`/edit/${storyId}`" class="previous">&lt;</RouterLink>
            <h1>Chapter Info</h1>
        </div>
        <TheChapterForm v-model="chapter" @update="updateChapterInfo" />
    </div>
    <ChoicesList
        :choices="choices"
        @createChoice="createDummyChoice"
        @deleteChoice="deleteChoiceClick"
    />
</template>
<style scoped></style>
