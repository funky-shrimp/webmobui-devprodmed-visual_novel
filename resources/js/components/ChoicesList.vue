<script setup>
import { ref, defineProps, defineEmits, inject } from "vue";

const route = inject("route");

const storyId = route.params.storyId;
const chapterId = route.params.chapterId;
const choiceId = route.params.choiceId;

const { choices } = defineProps({
    choices: {
        type: Array,
        default: () => [],
    },
});

defineEmits(["deleteChoice", "createChoice"]);
</script>
<template>
    <h2>Choices List</h2>
    <button id="createChoice" @click.prevent="$emit('createChoice')">
        Create a Choice
    </button>
    <table>
        <tr v-for="choice in choices">
            <td>{{ choice.text }}</td>
            <td>{{ choice.next_chapter_id }}</td>
            <td class="controls">
                <RouterLink class="edit"
                    :to="'/edit/' + storyId + '/' + chapterId + '/' + choice.id"
                    >Edit</RouterLink
                >
                <a class="delete" href="" @click.prevent="$emit('deleteChoice',choice.id)">Delete</a>
            </td>
        </tr>
    </table>
</template>
<style scoped>

</style>
