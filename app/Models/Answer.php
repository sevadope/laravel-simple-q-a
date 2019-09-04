<?php

namespace App\Models;

use App\Models\User;
use App\Models\Question;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'question_id',
    	'user_id',
    	'body',
    ];

    /******** Relationships ********/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function comments()
    {
    	return $this->morphMany(Comment::class, 'commentable');
    }

    /******** Scopes ********/

    public function scopeList($query)
    {       
        return $query
            ->orderBy('created_at')
            ->with('user:id,name,first_name,last_name');
    }

    public function scopeForUser($query, int $user_id)   
    {
        return $query
            ->where('user_id', $user_id)
            ->with('question:id,title');
    }
}
