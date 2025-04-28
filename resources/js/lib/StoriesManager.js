import {fetcher} from "../composables/fetcher"

export function getStories(){
    return fetcher("/api/stories")
}