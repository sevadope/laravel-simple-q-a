<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
	use SoftDeletes;

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

    public function scopeGetForShow($query, $slug)
    {
    	return $query
    		->where('slug', $slug)
    		->first();
    }

    public function scopeGetForEdit($query, $slug)
    {
    	return $query
    		->where('slug', $slug)
    		->first();
    }
}
