<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    /**
     * Les attributs qui sont assignables en masse
     * @var array
     */
    protected $fillable = ['title','content','image','story_id','start'];


    //A chapter belongs to a story (1.1)
    public function story(){
        return $this->belongsTo(Story::class);
    }

    //A chapter has many choices (0.N)
    public function choices(){
        return $this->hasMany(Choice::class);
    }
}
