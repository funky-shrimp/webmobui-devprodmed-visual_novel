<script setup>
import { ref, computed} from "vue"
import TheHeader from "./components/TheHeader.vue";
import Home from "./pages/Home.vue";
import EditStory from "./pages/EditStory.vue";
import Game from "./pages/Game.vue";

const routes = {
    "/": Home,
    "edit": EditStory,
    "game": Game,
}

const currentPath = ref(window.location.pathname)

window.addEventListener("hashchange", () => {
    currentPath.value = window.location.hash
})

const currentView = computed(() => {
    return routes[currentPath.value.slice(1).split("-")[0]] || Home
})

</script>
<template>
    <TheHeader></TheHeader>
    <component :is="currentView"></component>
</template>
<style scoped></style>
