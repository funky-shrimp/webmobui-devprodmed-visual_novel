<script setup>
import {defineProps, defineEmits} from "vue"

defineProps({
    stories: {
    type: Array,
    default: () => [],
  },
})

defineEmits(['delete'])

</script>
<template>

<h1>Stories List</h1>

<table>
    <tr v-for="story in stories">
        <td>{{story.title}}</td>
        <td>
            <a :href="'#game-' + story.id">Play</a>
            <a :href="'#edit-' + story.id">Edit</a>
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