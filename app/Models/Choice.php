<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    /**
     * Les attributs qui sont assignables en masse
     * @var array
     */
    protected $fillable = ['text','chapter_id','next_chapter_id'];

    //A choice belongs to a chapter (1.1)
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    //A choice belongs to a next chapter (1.1)
    public function nextChapter()
    {
        return $this->belongsTo(Chapter::class, 'next_chapter_id');
    }
}
