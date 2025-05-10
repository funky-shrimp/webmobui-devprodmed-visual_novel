<script setup>
import {defineProps, defineEmits} from "vue"
import { RouterLink } from "vue-router"

defineProps({
    stories: {
    type: Array,
    default: () => [],
  },
})

defineEmits(['delete','createStory'])

</script>
<template>

<h1>Stories List</h1>
<button id="createStory" @click.prevent="$emit('createStory')">Create a story</button>
<table>
    <tr v-for="story in stories">
        <td>{{story.title}}</td>
        <td>
            <RouterLink :to="'/game/' + story.id">Play</RouterLink>
            <RouterLink :to="'/edit/' + story.id">Edit</RouterLink>
            <!--<a :href="'#edit-' + story.id">Edit</a>-->
            <a href="" @click.prevent="$emit('delete',story.id)">Delete</a>
        </td>
    </tr>
</table>

</template>
<style scoped>
table{
    margin: auto;
    width:70%;
}

td{
    margin:0;
    padding: 8px;
}

tr:nth-child(even){
    background-color: rgb(226, 226, 226);
}

</style>