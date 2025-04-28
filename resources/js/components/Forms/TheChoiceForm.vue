<script setup>
import { defineProps } from "vue";


// Define the props and assign them to a local variable.
const { choice } = defineProps({
    choice: {
        type: Object,
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
                required>
        </div>
        <div>
            <input type="select" id="nextChapterId" name="nextChapterId" v-model="choice.nextChapterId">
                <option v-for="chapter in choice.chapters" :key="chapter.id" :value="chapter.id">
                    {{ chapter.title }}
                </option>
        </div>
        <div>
            <input v-if="choice.mode == 'update'" type="submit" value="Save" />
            <input
                v-if="choice.mode == 'create'"
                type="submit"
                value="Create"
            />
        </div>
    </form>
</template>
<style scoped>

</style>