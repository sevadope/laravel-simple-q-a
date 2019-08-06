<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title', 'slug', 'description'];



    /** Relationships **/

    public function questions()
    {
    	return $this->belongsToMany(Question::class);
    }
}
