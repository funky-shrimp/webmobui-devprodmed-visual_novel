<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Choice;
use Illuminate\Database\Seeder;

class ChoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i <= 10; $i++){
            $nextChap = rand(0,10);
            Choice::create([
                'text' => 'Choice '.$i,
                'chapter_id' => rand(1,10),
                'next_chapter_id' => $nextChap == 0 ? null : $nextChap 
            ]);
        }
    }
}
