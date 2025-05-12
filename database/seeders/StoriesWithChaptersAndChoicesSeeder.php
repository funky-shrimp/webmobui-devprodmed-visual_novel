<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;

class StoriesWithChaptersAndChoicesSeeder extends Seeder
{
    public function run(): void
    {
        // Create a story
        $story = Story::create([
            'title' => 'Adventure Story',
            'summary' => 'An exciting story with 3 chapters and multiple choices.',
        ]);

        // Create 3 chapters
        $chapters = [];
        for ($i = 1; $i <= 3; $i++) {
            $chapters[$i] = Chapter::create([
                'title' => 'Chapter ' . $i,
                'content' => 'Content for Chapter ' . $i,
                'story_id' => $story->id,
                'start' => $i === 1, // Set the first chapter as the starting chapter
            ]);
        }

        // Create 3 choices for each chapter
        foreach ($chapters as $index => $chapter) {
            for ($j = 1; $j <= 3; $j++) {
                Choice::create([
                    'text' => 'Choice ' . $j . ' for Chapter ' . $index,
                    'chapter_id' => $chapter->id,
                    'next_chapter_id' => $this->getNextChapterId($index, $j, $chapters), // Determine the next chapter
                ]);
            }
        }
    }

    /**
     * Determine the next chapter ID for a choice.
     */
    private function getNextChapterId(int $currentChapterIndex, int $choiceIndex, array $chapters): ?int
    {
        // Example logic:
        // - First choice leads to the next chapter (if it exists)
        // - Second choice leads to the next chapter (if it exists)
        // - Third choice leads to null (end of story)
        if ($choiceIndex === 3) {
            return null; // End of story
        }

        $nextChapterIndex = $currentChapterIndex + 1;
        return $chapters[$nextChapterIndex]->id ?? null;
    }
}
