<?php

namespace App\Models;

use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    
    /******** Accessors ********/

    public function getQuestionAttribute()
    {
        return $this->commentable_type == Answer::class ?
            $this->commentable->question
            :
            $this->commentable;
    }

    /******** Scopes ********/

    public function scopeList($query)
    {       
        return $query
            ->orderBy('created_at', 'desc')
            ->with('user:id,name,first_name,last_name,profile_image');
    }

    public function scopeForUser($query, $user_id)
    {
        return $query
            ->where('user_id', $user_id);
    }
}
