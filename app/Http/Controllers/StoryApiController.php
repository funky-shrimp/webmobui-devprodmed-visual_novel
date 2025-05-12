<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryStoreRequest;
use App\Http\Requests\StoryUpdateRequest;
use App\Models\Story;
use App\Models\Chapter;
use Illuminate\Http\Request;

class StoryApiController extends Controller
{
    //

    /**
     * Return all stories.
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getStories(){
        return response()->json(Story::all());
    }
    /**
     * Return a story by his ID.
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getStory($id){
        return response()->json(Story::findOrFail($id));
    }

    /**
     * Return all story's chapters by story ID.
     * @param mixed $story_id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getChaptersByStory($story_id){
        return response()->json(Chapter::where('story_id', $story_id)->get());
    }

    /**
     * Create a new story.
     * @param \App\Http\Requests\StoryStoreRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function createStory(StoryStoreRequest $request){
        $story = Story::create($request->validated());
        return response()->json($story,201);
    }

    /**
     * Update a story by his ID.
     * @param \App\Http\Requests\StoryUpdateRequest $request
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateStory(StoryUpdateRequest $request, $id){
        $story = Story::findOrFail($id);
        $story->update($request->validated());
        return response()->json($story);
    }

    /**
     * Delete a story by his ID.
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function deleteStory($id){
        Story::findOrFail($id)->delete();
        return response()->json(null,204);
    }
}
