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

     public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }

    /**
    *checks if post has tag
    *@return bool
    *
    */

    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

}
