<script setup>
import {defineProps} from "vue"

defineProps({
    stories: {
    type: Array,
    default: () => [],
  },
})

</script>
<template>

<h1>Stories List</h1>

<table>
    <tr v-for="story in stories">
        <td>{{story.title}}</td>
        <td>
            <button>Play</button>
            <button>Edit</button>
            <button>Delete</button>
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

button{
    margin: 0 10px 0 10px;
    background-color: rgb(160, 160, 254);
    border-style: none;
    border-radius: 10px;
    padding:10px;
    color:rgb(0, 0, 0);
}

button:hover{
    background-color: rgb(97, 97, 255);
}

tr:nth-child(even){
    background-color: rgb(226, 226, 226);
}

</style>