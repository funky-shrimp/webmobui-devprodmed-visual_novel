<script setup>
import { ref, defineProps, defineEmits, inject } from "vue";

//Retrieve the storyId and chapterId from the route
//This is used to create the link to edit the chapter
//and to delete the chapter
const route = inject("route");
const storyId = route.params.storyId;
const chapterId = route.params.chapterId;
const choiceId = route.params.choiceId;

const { chapters} = defineProps({
    chapters: {
        type: Array,
        default: () => [],
    },
});

defineEmits(['deleteChapter','createChapter'])

</script>
<template>
    <h2>Chapters List</h2>
    <button id="createChapter" @click.prevent="$emit('createChapter')">Create a Chapter</button>
    <table>
        <tr v-for="chapter in chapters">
            <td>{{ chapter.id }}</td>
            <td>{{ chapter.title }}</td>
            <td class="controls">
                <RouterLink class="edit" :to="'/edit/' + storyId + '/'+chapter.id">Edit</RouterLink>
                <a class="delete" href="" @click.prevent="$emit('deleteChapter',chapter.id)">Delete</a>
            </td>
        </tr>
    </table>
</template>
<style scoped>

</style>
