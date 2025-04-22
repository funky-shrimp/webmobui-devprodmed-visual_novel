<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Chapter;
use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i <= 10; $i++){
            Chapter::create([
                'content' => 'Content '.$i,
                'story_id' => rand(1,10)
            ]);
        }
    }
}
