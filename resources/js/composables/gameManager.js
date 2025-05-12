
/**
 * Find the starting chapter in the chapters array
 * @param {*} chapters 
 * @returns startingChapter
 */
export function getStartingChapter(chapters) {
    const startingChapter = chapters.find((chapter) => chapter.start == true);
    return startingChapter
}
