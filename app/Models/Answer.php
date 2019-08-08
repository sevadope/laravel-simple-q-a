<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
    	'question_id',
    	'user_id',
    	'body',
    ];

    /**** Relationships ****/

    public function comments()
    {
    	return $this->morphMany(Comment::class, 'commentable');
    }
}
