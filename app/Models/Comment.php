<?php

namespace App\Models;

use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    	'user_id',
    	'commentable_id',
    	'commentable_type',
    	'body',
    ];

    /**** Relationships ****/

    public function commentable()
    {
    	return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**** Accessorss ****/

    public function getQuestionAttribute()
    {
        return $this->commentable_type == Answer::class ?
            $this->commentable->question
            :
            $this->commentable;
    }
}
