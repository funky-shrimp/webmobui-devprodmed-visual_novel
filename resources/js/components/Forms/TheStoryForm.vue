<script setup>

const story = defineModel();

defineEmits(["update"]);
</script>
<template>
<form id="storyForm" href="" @submit.prevent="$emit('update')">
        <div>
            <label for="title">Title</label>
            <input
                type="text"
                id="title"
                name="title"
                v-model="story.title"
                required
            />
        </div>
        <div>
            <label for="summary">Summary</label>
            <textarea
                id="summary"
                name="summary"
                v-model="story.summary"
                required
            ></textarea>
        </div>
        <div>
            <input type="submit" value="Save" />
        </div>
    </form>
</template>
<style scoped>

</style>