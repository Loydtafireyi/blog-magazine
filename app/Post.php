<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;
	
    protected $guarded = [];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
