<?php

use App\Http\Controllers\ChapterApiController;
use App\Http\Controllers\ChoiceApiController;
use App\Http\Controllers\StoryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/* Routes for Stories */
Route::get('stories',[StoryApiController::class,'getStories']);
Route::get('stories/{id}',[StoryApiController::class,'getStory']);
Route::post('stories',[StoryApiController::class,'createStory']);
Route::put('stories/{id}',[StoryApiController::class,'updateStory']);
Route::delete('stories/{id}',[StoryApiController::class,'deleteStory']);
Route::get('stories/{story_id}/chapters',[StoryApiController::class,'getChaptersByStory']);


/* Routes for Chapters */
Route::get('chapters',[ChapterApiController::class,'getChapters']);
Route::get('chapters/{id}',[ChapterApiController::class,'getChapter']);
Route::post('chapters',[ChapterApiController::class,'createChapter']);
Route::put('chapters/{id}',[ChapterApiController::class,'updateChapter']);
Route::delete('chapters/{id}',[ChapterApiController::class,'deleteChapter']);
Route::get('chapters/{chapter_id}/choices',[ChapterApiController::class,'getChoicesByChapter']);

/* Routes for Choices */
Route::get('choices',[ChoiceApiController::class,'getchoices']);
Route::get('choices/{id}',[ChoiceApiController::class,'getChoice']);
Route::post('choices',[ChoiceApiController::class,'createChoice']);
Route::put('choices/{id}',[ChoiceApiController::class,'updateChoice']);
Route::delete('choices/{id}',[ChoiceApiController::class,'deleteChoice']);