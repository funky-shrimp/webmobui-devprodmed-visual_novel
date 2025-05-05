<script setup>

import { ref, defineProps, defineEmits, inject  } from "vue";

const route = inject("route");

const storyId = route.params.storyId;
const chapterId = route.params.chapterId;
const choiceId = route.params.choiceId;

const {choices} = defineProps({
    choices:{
        type: Array,
        default: () => [],
    },
});

</script>
<template>
<h1>Choices List</h1>
    <button id="createChoice">Create a Choice</button>
    <table>
        <tr v-for="choice in choices">
            <td>{{ choice.text }}</td>
            <td>{{ choice.next_chapter_id }}</td>
            <td>
                <RouterLink :to="'/edit/' + storyId + '/'+chapterId + '/'+choiceId">Edit</RouterLink>
                <a href="">Delete</a>
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