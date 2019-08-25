<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'slug', 'description'];

    /**
     * Redifinition of default route key
     *
     * @param void
     * @return string
     */
    public function getRouteKeyName()
    {
    	return 'slug';
    }

    /**** Relationships ****/

    public function questions()
    {
    	return $this->belongsToMany(Question::class);
    }

    /**** Scopes ****/

    public function scopeGetPaginatedIndex($query, $per_page)
    {
    	$columns = ['id', 'title', 'slug', 'created_at', 'updated_at'];

    	return $query
    		->paginate($per_page, $columns);
    }

    public function scopeGetForShowQuestions($query, $slug)
    {
    	return $query
    		->where('slug', $slug)
            ->withCount('questions')
            ->with(['questions:id,title,created_at',
                    'questions.tags:id,title', 
                    'questions' => function ($query) {
                        $query->withCount('tags', 'answers');
                    }])
    		->first();
    }

    public function scopeGetForDestroy($query, $slug)
    {
        return $query
            ->with(['questions' => function ($query) {
                $query->withCount('tags');
            }])
            ->where('slug', $slug)
            ->first();
    }

    public function scopeGetTrashed($query, $slug)
    {
        return $query
            ->withTrashed()
            ->where('slug', $slug)
            ->first();
    }
}
