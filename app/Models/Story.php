<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    /**
     * Les attributs qui sont assignables en masse
     * @var array
     */
    protected $fillable = ['title','summary'];

    //Une histoire a plusieurs chapitres
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }
}
