<script setup>
import { ref, watch, inject } from "vue";
import {
    getStory,
    updateStory,
    getStoryChapters,
    createChapter,
    deleteChapter,
} from "@/lib/StoriesManager.js";

import TheStoryForm from "@/components/Forms/TheStoryForm.vue";
import ChaptersList from "../components/ChaptersList.vue";
import { RouterLink } from "vue-router";

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

function createDummyChapter() {

    let tempId = + storyId;
    const dummyChapter = {
        title: "Dummy Chapter",
        content: "this is a dummy chapter",
        image: null,
        story_id: tempId,
        start: false,
    };

    const {
        data: dummyChapterData,
        error: dummyChapterError,
        loading: dummyChapterLoading,
    } = createChapter(dummyChapter);

    watch(dummyChapterData, (newDummyChapterData) => {
        if (newDummyChapterData) {
            chapters.value.push(newDummyChapterData);
        }
    });
}

function deleteChapterClick(chapterId) {
    if (confirm("Are you sure you want to delete this Chapter ?")) {
        const { data, error, loading } = deleteChapter(chapterId);

        watch(error, (newError) => {
            if (newError) {
                if (newError.status === 204) {
                    chapters.value = chapters.value.filter(
                        (chapter) => chapter.id !== chapterId
                    );
                }
            }
        });
    }
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
    <div class="titlenav">
        <RouterLink to="/" class="previous">&lt;</RouterLink>
        <h1>Edit Story</h1>
    </div>
    
    <div id="storyInfo">
        <h2>Story Info</h2>
        <TheStoryForm v-model="story" @update="updateStoryInfo" />
    </div>
    <ChaptersList
        :chapters="chapters"
        @createChapter="createDummyChapter"
        @deleteChapter="deleteChapterClick"
    />
</template>

<style scoped>
.previous {
    text-decoration: none;
    font-size: 24px;
    margin-right: 10px;
    color: #007bff;
    transition: color 0.3s;
}

.previous:hover {
    color: #0056b3;
}
</style>
