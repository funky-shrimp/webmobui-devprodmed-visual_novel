export function getStartingChapter(chapters) {
    const startingChapter = chapters.find((chapter) => chapter.start == true);
    return startingChapter
}
