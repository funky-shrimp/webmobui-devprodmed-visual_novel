<script setup>
import { defineProps, ref, watch } from "vue";


// Define the props and assign them to a local variable.
const { chapter} = defineProps({
    chapter: {
        type: Object,
        required: true,
    },
});

console.log(chapter)

</script>
<template>
    <form class="chapterForm" href="" @submit.prevent="$emit('update')">
        <div>
            <label for="content">Content</label>
            <textarea
                id="content"
                name="content"
                required
            >{{ chapter.content }}</textarea>
        </div>
        <div>
            <label for="image">Image</label>
            <input
                type="file"
                id="image"
                name="image"
                @change="chapter.image = $event.target.files[0]"
                accept="image/*"
            />
        </div>
        <div>
            <input type="submit" value="Save" />
        </div>
    </form>
</template>
<style scoped></style>
