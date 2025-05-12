import { useFetchJson } from "@/composables/useFetchJson";

/* ___ STORIES ___ */

/**
 * Retrieves all stories.
 * @returns { data, error, isLoading }
 */
export function getStories() {
    const { data, error, isLoading } = useFetchJson("/api/stories");
    return { data, error, isLoading };
}

/**
 * Retrieves a specific story by its ID.
 * @param number id 
 * @returns 
 */
export function getStory(id) {
    const { data, error, isLoading } = useFetchJson("/api/stories/" + id);
    return { data, error, isLoading };
}

/**
 * Retrieves all chapters of a specific story by its ID.
 * @param number id 
 * @returns 
 */
export function getStoryChapters(id) {
    const { data, error, isLoading } = useFetchJson(
        "/api/stories/" + id + "/chapters"
    );
    return { data, error, isLoading };
}

/**
 * Deletes a specific story by its ID.
 * @param number id 
 * @returns 
 */
export function deleteStory(id) {
    const { data, error, isLoading } = useFetchJson({
        url: "/api/stories/" + id,
        method: "DELETE",
    });
    return { data, error, isLoading };
}

/**
 * Updates a specific story by its ID.
 * @param number id 
 * @param object story 
 * @returns 
 */
export function updateStory(id, story) {
    console.log(story);
    const { data, error, isLoading } = useFetchJson({
        url: "/api/stories/" + id,
        method: "PUT",
        data: { title: story.title, summary: story.summary },
    });
    return { data, error, isLoading };
}

/**
 * Creates a new story.
 * @param object story
 * @returns 
 */
export function createStory(story) {
    const { data, error, isLoading } = useFetchJson({
        url: "/api/stories",
        method: "POST",
        data: { title: story.title, summary: story.summary },
    });
    return { data, error, isLoading };
}

/* ___ CHAPTERS ___ */

/**
 * Retrieves a specific chapter by its ID.
 * @param number id 
 * @returns 
 */
export function getChapter(id) {
    const { data, error, isLoading } = useFetchJson("/api/chapters/" + id);
    return { data, error, isLoading };
}

/**
 * Retrieves choices of a specific chapter by its ID.
 * @param number id 
 * @returns 
 */
export function getChapterChoices(id) {
    const { data, error, isLoading } = useFetchJson(
        "/api/chapters/" + id + "/choices"
    );
    return { data, error, isLoading };
}

/**
 * Creates a new chapter.
 * @param object chapter 
 * @returns 
 */
export function createChapter(chapter) {
    const { data, error, isLoading } = useFetchJson({
        url: "/api/chapters",
        method: "POST",
        data: {
            title: chapter.title,
            content: chapter.content,
            image: chapter.image,
            story_id: chapter.story_id,
            start: chapter.start,
        },
    });
    return { data, error, isLoading };
}

/**
 * Deletes a specific chapter by its ID.
 * @param number id 
 * @returns 
 */
export function deleteChapter(id) {
    const { data, error, isLoading } = useFetchJson({
        url: "/api/chapters/" + id,
        method: "DELETE",
    });
    return { data, error, isLoading };
}

/**
 * Updates a specific chapter by its ID and the new chapter data.
 * @param number id 
 * @param object chapter 
 * @returns 
 */
export async function updateChapter(id, chapter) {
    let base64Image = null;

    if (chapter.image instanceof File) {
        base64Image = await new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = () => resolve(reader.result);
            reader.onerror = (error) => reject(error);
            reader.readAsDataURL(chapter.image); // Convert the image to Base64
        });
    }

    const { data, error, isLoading } = useFetchJson({
        url: `/api/chapters/${id}`,
        method: "PUT",
        data: {
            title: chapter.title,
            content: chapter.content,
            story_id: chapter.story_id,
            start: chapter.start ? 1 : 0,
            image: base64Image, // Include the Base64-encoded image
        },
    });

    return { data, error, isLoading };
}

/* ___ CHOICES ___ */

/**
 * Retrieves a specific choice by its ID.
 * @param number id 
 * @returns 
 */
export function getChoice(id) {
    const { data, error, isLoading } = useFetchJson("/api/choices/" + id);
    return { data, error, isLoading };
}

/**
 * Creates a new choice.
 * @param object choice 
 * @returns 
 */
export function createChoice(choice) {
    const { data, error, isLoading } = useFetchJson({
        url: "/api/choices",
        method: "POST",
        data: {
            text: choice.text,
            chapter_id: choice.chapter_id,
            next_chapter_id: choice.next_chapter_id,
        },
    });
    return { data, error, isLoading };
}

/**
 * Deletes a specific choice by its ID.
 * @param number id 
 * @returns 
 */
export function deleteChoice(id) {
    const { data, error, isLoading } = useFetchJson({
        url: "/api/choices/" + id,
        method: "DELETE",
    });
    return { data, error, isLoading };
}

/**
 * Updates a specific choice by its ID and the new choice data.
 * @param number id 
 * @param object choice 
 * @returns 
 */
export function updateChoice(id, choice) {
    if(choice.next_chapter_id === "") {
        choice.next_chapter_id = null;
    }
    const { data, error, isLoading } = useFetchJson({
        url: "/api/choices/" + id,
        method: "PUT",
        data: {
            text: choice.text,
            next_chapter_id: choice.next_chapter_id,
        },
    });
    return { data, error, isLoading };
}
