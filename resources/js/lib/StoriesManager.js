import { useFetchJson } from "@/composables/useFetchJson";

/* ___ STORIES ___ */

export function getStories() {
    const { data, error, isLoading } = useFetchJson("/api/stories");
    return { data, error, isLoading };
}

export function getStory(id) {
    const { data, error, isLoading } = useFetchJson("/api/stories/" + id);
    return { data, error, isLoading };
}

export function getStoryChapters(id) {
    const { data, error, isLoading } = useFetchJson(
        "/api/stories/" + id + "/chapters"
    );
    return { data, error, isLoading };
}

export function deleteStory(id) {
    //use the token in the header from meta head
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (!token) {
        throw new Error("CSRF token not found");
    }
    const { data, error, isLoading } = useFetchJson({
        headers: {
            "X-CSRF-TOKEN": token,
        },
        url: "/api/stories/" + id,
        method: "DELETE",
    });
    return { data, error, isLoading };
}

export function updateStory(id, story) {
    //use the token in the header from meta head
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (!token) {
        throw new Error("CSRF token not found");
    }
    const { data, error, isLoading } = useFetchJson({
        headers: {
            "X-CSRF-TOKEN": token,
        },
        url: "/api/stories/" + id,
        method: "PUT",
        data: { title: story.title, summary: story.summary },
    });
    return { data, error, isLoading };
}

export function createStory(story) {
    //use the token in the header from meta head
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (!token) {
        throw new Error("CSRF token not found");
    }
    const { data, error, isLoading } = useFetchJson({
        headers: {
            "X-CSRF-TOKEN": token,
        },
        url: "/api/stories",
        method: "POST",
        data: { title: story.title, summary: story.summary },
    });
    return { data, error, isLoading };
}

/* ___ CHAPTERS ___ */

export function getChapter(id) {
    const { data, error, isLoading } = useFetchJson("/api/chapters/" + id);
    return { data, error, isLoading };
}

export function getChapterChoices(id) {
    const { data, error, isLoading } = useFetchJson(
        "/api/chapters/" + id + "/choices"
    );
    return { data, error, isLoading };
}

export function createChapter(chapter) {
    //use the token in the header from meta head
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (!token) {
        throw new Error("CSRF token not found");
    }
    const { data, error, isLoading } = useFetchJson({
        headers: {
            "X-CSRF-TOKEN": token,
        },
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

export function deleteChapter(id) {
    //use the token in the header from meta head
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (!token) {
        throw new Error("CSRF token not found");
    }
    const { data, error, isLoading } = useFetchJson({
        headers: {
            "X-CSRF-TOKEN": token,
        },
        url: "/api/chapters/" + id,
        method: "DELETE",
    });
    return { data, error, isLoading };
}

/*
export function updateStory(id, story) {
    console.log(story);
    const { data, error, isLoading } = useFetchJson({
        url: "/api/stories/" + id,
        method: "PUT",
        data: { title: story.title, summary: story.summary },
    });
    return { data, error, isLoading };
}
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
    //use the token in the header from meta head
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (!token) {
        throw new Error("CSRF token not found");
    }

    const { data, error, isLoading } = useFetchJson({
        headers: {
            "X-CSRF-TOKEN": token,
        },
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

export function getChoice(id) {
    const { data, error, isLoading } = useFetchJson("/api/choices/" + id);
    return { data, error, isLoading };
}

export function createChoice(choice) {
//use the token in the header from meta head
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (!token) {
        throw new Error("CSRF token not found");
    }

    const { data, error, isLoading } = useFetchJson({
        headers: {
            "X-CSRF-TOKEN": token,
        },
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

export function deleteChoice(id) {
    //use the token in the header from meta head
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (!token) {
        throw new Error("CSRF token not found");
    }

    const { data, error, isLoading } = useFetchJson({
        headers: {
            "X-CSRF-TOKEN": token,
        },
        url: "/api/choices/" + id,
        method: "DELETE",
    });
    return { data, error, isLoading };
}

export function updateChoice(id, choice) {
    if(choice.next_chapter_id === "") {
        choice.next_chapter_id = null;
    }
    //use the token in the header from meta head
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (!token) {
        throw new Error("CSRF token not found");
    }
    const { data, error, isLoading } = useFetchJson({
        headers: {
            "X-CSRF-TOKEN": token,
        },
        url: "/api/choices/" + id,
        method: "PUT",
        data: {
            text: choice.text,
            next_chapter_id: choice.next_chapter_id,
        },
    });
    return { data, error, isLoading };
}
