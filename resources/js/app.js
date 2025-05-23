import { createApp } from "vue";
import { createMemoryHistory, createRouter } from "vue-router";
import App from "./App.vue";

// Import the CSS files
import "../css/stylesheet.css";

import Home from "./pages/Home.vue";
import EditStory from "./pages/EditStory.vue";
import EditChapter from "./pages/EditChapter.vue";
import EditChoice from "./pages/EditChoice.vue";
import Game from "./pages/Game.vue";
import Admin from "./pages/Admin.vue";

const routes = [
    { path: "/", component: Home },
    { path: "/edit/:storyId", component: EditStory },
    { path: "/edit/:storyId/:chapterId", component: EditChapter },
    { path: "/edit/:storyId/:chapterId/:choiceId", component: EditChoice },
    { path: "/create", component: EditStory },
    { path: "/game/:storyId", component: Game },
    { path: "/admin", component: Admin },
];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
});

createApp(App).use(router).mount("#app");
