<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $translatable = ['name'];

    public function posts(){
        return $this->belongsToMany(Post::class,'post_tags');
    }
}
