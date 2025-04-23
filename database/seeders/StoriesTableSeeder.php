<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Story;
use Illuminate\Database\Seeder;

class StoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i <= 10; $i++){
            Story::create([
                'title' => 'Title '.$i,
                'summary' => 'summary '.$i
            ]);
        }
    }
}
