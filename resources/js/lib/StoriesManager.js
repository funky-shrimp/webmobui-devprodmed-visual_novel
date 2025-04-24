import { useFetchJson } from "../composables/useFetchJson";

export function getStories() {
    const { data, error, isLoading } = useFetchJson("/api/stories");
    return { data, error, isLoading };
}

export function getStory(id) {
    const { data, error, isLoading } = useFetchJson("/api/stories/" + id);
    return { data, error, isLoading };
}

export function deleteStory(id) {
    const { data, error, isLoading } = useFetchJson({
        url: "/api/stories/" + id,
        method: "DELETE",
    });
    return { data, error, isLoading };
}

export function updateStory(id, story) {
    console.log(story)
    const { data, error, isLoading } = useFetchJson({
        url: "/api/stories/" + id,
        method: "PUT",
        data: { title: story.title, summary: story.summary },
    });
    return { data, error, isLoading };
}
