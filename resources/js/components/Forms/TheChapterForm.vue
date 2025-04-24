<script setup>
import { defineProps, ref, watch } from "vue";

// Define the props and assign them to a local variable.
const { storyId, mode } = defineProps({
    storyId: {
        type: Number,
        required: true,
    },
    mode: {
        type: String,
        default: "create",
    },
});

</script>
<template>
    <form>
        <div>
            <label for="content">Content</label>
            <input type="text" id="content" name="content" required />
        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*" />
        </div>
        <div>
            <input v-if="mode=='update'" type="submit" value="Save" />
            <input v-if="mode=='create'" type="submit" value="Create" />
        </div>
    </form>
</template>
<style scoped></style>
