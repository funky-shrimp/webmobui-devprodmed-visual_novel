<script setup>
import { defineProps, ref, watch } from "vue";

/* Explication de passage par props au lieu de v-model pour une boucle v-for

The error occurs because v-model cannot directly modify form in the v-for loop. This is because form is a scope variable created by v-for, and Vue does not allow v-model to modify such variables directly.

To fix this, you need to pass the form object as a prop to TheChapterForm and bind the inputs inside TheChapterForm to the properties of the passed object.

Fix:
Pass the form Object as a Prop: Instead of using v-model on TheChapterForm, pass the form object as a prop.

Bind Inputs Inside TheChapterForm: Use v-model to bind the inputs in TheChapterForm to the properties of the form object.


Pass the form Object as a Prop:

In EditStory.vue, pass each form object from chapterForms to TheChapterForm using the :chapter prop.
Bind Inputs to the chapter Object:

In TheChapterForm.vue, use v-model to bind the content and image inputs to the properties of the chapter object.
Handle File Input:

Since v-model does not work directly with file inputs, use the @change event to update the image property in the chapter object.
Reactive Updates:

Any changes made in the form will automatically update the corresponding object in the chapterForms array because the chapter object is passed by reference.

*/


// Define the props and assign them to a local variable.
const { chapter } = defineProps({
    chapter: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <form class="chapterForm" href="" @submit.prevent="$emit('update')">
        <div>
            <label for="content">Content</label>
            <textarea
                id="content"
                name="content"
                v-model="chapter.content"
                required
            ></textarea>
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
            <input v-if="chapter.mode == 'update'" type="submit" value="Save" />
            <input
                v-if="chapter.mode == 'create'"
                type="submit"
                value="Create"
            />
        </div>
    </form>
</template>
<style scoped></style>
