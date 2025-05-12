<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    /**
     * Mass assignable attributes
     * @var array
     */
    protected $fillable = ['title','summary'];

    //A story has many chapters (1.N)
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }
}
