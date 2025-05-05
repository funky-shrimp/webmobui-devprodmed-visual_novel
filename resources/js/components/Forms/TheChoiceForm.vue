<script setup>
import { defineProps } from "vue";

// Define the props and assign them to a local variable.
const { choice, availableChapters } = defineProps({
    choice: {
        type: Object,
        required: true,
    },
    availableChapters: {
        type: Array,
        required: true,
    },
});
</script>
<template>
    <form class="choiceForm" href="" @submit.prevent="$emit('update')">
        <div>
            <label for="text">Text</label>
            <input
                type="text"
                id="text"
                name="text"
                v-model="choice.text"
                required
            />
        </div>
        <div>
            <label for="nextChapter">Next Chapter</label>
            <select
                id="nextChapter"
                name="nextChapter"
                v-model="choice.nextChapter"
            >
            <option value="">None (end of story)</option>
                <option
                    v-for="chapter in availableChapters"
                    :key="chapter.id"
                    :value="chapter.id"
                >
                    {{ chapter.content }}
                </option>
            </select>
        </div>
        <div>
            <input type="submit" value="Save" />
        </div>
    </form>
</template>
<style scoped></style>
