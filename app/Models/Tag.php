<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Tag extends BaseModel
{
    use HasFactory,HasTranslations;

    public $translatable = ['name'];

    public function posts(){
        return $this->belongsToMany(Post::class,'post_tags');
    }
}
