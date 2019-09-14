<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Answer;
use App\Models\Like;
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

    public function answers_comments()
    {
        return $this->hasManyThrough(
            Comment::class,
            Answer::class,
            'question_id',
            'commentable_id'
        )->where('commentable_type', Answer::class);
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
            ->orderBy('created_at', 'desc')
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
            ->withCount('comments', 'subscribers')
            ->with([
                'answers' => function ($query) {
                    $query->withCount('comments', 'likes');
                    $query->with(['comments' => function ($query){
                            $query->withCount('likes');
                            $query->with('likes', 'user');
                    }]);
                    $query->with('likes');
                },
                'comments' => function ($query) {
                    $query->with('likes');
                    $query->withCount('likes');
                },
                'tags:id,slug,title',
                'subscribers'
            ])
            ->find($id);
    }

    public function scopeForTags($query, $tags_ids)
    {
        $tags_ids = is_array($tags_ids) ? $tags_ids : array($tags_ids);
 
        return $query
            ->whereHas('tags', function ($query) use ($tags_ids) {
                $query->whereIn('id', $tags_ids);
            });
    }

    public function scopeForUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

}

