<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
    	'user_id',
    	'title',
    	'description',
    	'is_published',
    	'is_completed',
    ];



    /******** Relationships ********/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }

    public function answers()
    {
    	return $this->hasMany(Answer::class);
    }

    public function comments()
    {
    	return $this->morphMany(Comment::class, 'commentable');
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'question_subscriber');
    }

    /******** Accessors ********/

    public function getTagsTitleAttribute()
    {
        return ($this->tags_count > 1) ?
            $this->tags->first()->title . ' + ' . ($this->tags_count - 1)
            :
            $this->tags->first()->title;
    }

    public function getSolutionsAttribute()
    {
        return $this->answers
            ->where('is_solution', 1)
            ->all();
    }
    
    public function getNotSolutionsAttribute()
    {
        return $this->answers
            ->where('is_solution', 0)
            ->all();
    }
    
    /******** Scopes ********/

    public function scopeList($query)
    {
        return $query
            ->orderBy('created_at')
            ->withCount('answers', 'tags', 'subscribers')
            ->with(['tags:id,title']);
    }

    public function scopeWithoutAnswer($query)
    {
        return $query->withCount('answers')->has('answers', 0);
    }

    public function scopeGetForShow($query, int $id)
    {
        return $query
            ->withCount('comments')
            ->with([
                'answers' => function ($query) {
                    $query->withCount('comments');
                },
                'tags:id,slug,title',
                'comments.user:id,name,first_name,last_name',
                'answers.user:id,name,first_name,last_name',
                'answers.comments.user:id,name,first_name,last_name'
            ])
            ->find($id);
    }

    public function scopeForTag($query, $tag_id)
    {
        return $query
            ->whereHas('tags', function ($query) use ($tag_id) {
                $query->where('id', $tag_id);
            });
    }

    public function scopeForUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

}

