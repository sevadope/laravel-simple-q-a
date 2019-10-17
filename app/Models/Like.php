<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Like extends Model
{
	public $timestamps = false;

	protected $fillable = ['user_id', 'likeable_type', 'likeable_id'];


	/******** Relationships ********/

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
