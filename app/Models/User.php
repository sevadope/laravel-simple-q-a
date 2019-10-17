<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{   
    use Notifiable;
    
    /*| Profile image constants |*/
    public const DEFAULT_PROFILE_IMAGE_PATH = 'default_profile_image.jpg';
    public const PROFILE_IMAGES_PATH = 'profile_images';
    public const PROFILE_IMAGE_WIDTH = 100;
    public const PROFILE_IMAGE_HEIGHT = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'first_name',
        'last_name',
        'briefly_about_myself',
        'about_myself',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Redifinition default route key
     *
     * @param void
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /*|== Relationships ==|*/

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function subscribed_questions()
    {
        return $this->belongsToMany(Question::class, 'question_subscriber');
    }

    public function subscribed_tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_subscriber');
    }
    
    /*|== Scopes ==|*/

    public function scopelist($query)
    {
        return $query
            ->withCount(['questions', 'answers']);
    }

    public function scopeGetForShow($query, string $name)    
    {
        return $query
            ->withCount('questions', 'answers', 'comments')
            ->where('name', $name)
            ->first();
    }

    /*|== Accessors ==|*/

    public function getProfileNameAttribute()
    {
        return $this->first_name . $this->last_name ? 
            $this->first_name . " " . $this->last_name : $this->name;
    }

    /*|========| Custom functions |=======|*/

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function setAdminRole()
    {
        $this->role = 'admin';
    }

    public function isModerator()
    {
        return $this->role == 'moderator';
    }

    public function setModeratorRole()
    {
        $this->role = 'moderator';
    }

    public function getRoles()
    {
        return ['admin', 'moderator', 'user'];
    }
}
