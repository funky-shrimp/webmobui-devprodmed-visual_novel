<script setup>
import { ref, defineProps, defineEmits, inject } from "vue";

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
    <h1>Chapters List</h1>
    <button id="createChapter" @click.prevent="$emit('createChapter')">Create a Chapter</button>
    <table>
        <tr v-for="chapter in chapters">
            <td>{{ chapter.id }}</td>
            <td>{{ chapter.title }}</td>
            <td>
                <RouterLink :to="'/edit/' + storyId + '/'+chapter.id">Edit</RouterLink>
                <a href="" @click.prevent="$emit('deleteChapter',chapter.id)">Delete</a>
            </td>
        </tr>
    </table>
</template>
<style scoped>
table {
    margin: auto;
    width: 70%;
}

td {
    margin: 0;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: rgb(226, 226, 226);
}
</style>
