<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
	use SoftDeletes;

    protected $fillable = ['title', 'slug', 'description'];



    /**** Relationships ****/

    public function questions()
    {
    	return $this->belongsToMany(Question::class);
    }
}
