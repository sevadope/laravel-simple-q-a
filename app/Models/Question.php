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
    
    protected $fillable = [
    	'user_id',
    	'title',
    	'description',
    	'is_published',
    	'is_completed',
    ];



    /**** Relationships ****/

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

    /**** Accessors ****/

    public function getTagsTitleAttribute()
    {
        return ($this->tags->count() > 1) ?
            $this->tags->first()->title . ' + ' . ($this->tags->count() - 1)
            :
            $this->tags->first()->title;
    }
}

