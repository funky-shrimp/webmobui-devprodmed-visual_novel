<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    /**
     * Les attributs qui sont assignables en masse
     * @var array
     */
    protected $fillable = ['content','image','story_id'];


    //Un chapitre n'appartient qu'à une histoire
    public function story(){
        return $this->belongsTo(Story::class);
    }

    //Un chapitre à plusieurs choix
    public function choices(){
        return $this->hasMany(Choice::class);
    }
}
