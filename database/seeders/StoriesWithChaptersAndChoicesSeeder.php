<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;

class StoriesWithChaptersAndChoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            // Create a story
            $story = Story::create([
                'title' => 'Story ' . $i,
                'summary' => 'This is the summary for Story ' . $i,
            ]);

            for ($j = 1; $j <= 3; $j++) {
                // Create a chapter for the story
                $chapter = Chapter::create([
                    'content' => 'Content for Chapter ' . $j . ' of Story ' . $i,
                    'story_id' => $story->id,
                ]);

                for ($k = 1; $k <= 3; $k++) {
                    // Create a choice for the chapter
                    Choice::create([
                        'text' => 'Choice ' . $k . ' for Chapter ' . $j . ' of Story ' . $i,
                        'chapter_id' => $chapter->id,
                        'next_chapter_id' => null, // You can set this to link to another chapter if needed
                    ]);
                }
            }
        }
    }
}
