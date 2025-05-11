<script setup>
import { defineProps, defineEmits } from "vue";
import { RouterLink } from "vue-router";

defineProps({
    stories: {
        type: Array,
        default: () => [],
    },
});

defineEmits(["delete", "createStory"]);
</script>
<template>
    <h1>Stories List</h1>
    <button id="createStory" @click.prevent="$emit('createStory')">
        Create a story
    </button>
    <table>
        <tr v-for="story in stories">
            <td>{{ story.title }}</td>
            <td>
                <RouterLink class="play":to="'/game/' + story.id">play</RouterLink>


                <RouterLink class="edit" :to="'/edit/' + story.id">edit</RouterLink>
                <!--<a :href="'#edit-' + story.id">Edit</a>-->
                <a
                    href=""
                    class="delete"
                    @click.prevent="$emit('delete', story.id)"
                    >Delete</a
                >
            </td>
        </tr>
    </table>
</template>
<style scoped></style>
