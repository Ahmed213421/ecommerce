<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $translatable = ['title','description'];

    public function getRouteKeyName()
{
    return 'id';
}

    public function tags(){
        return $this->belongsToMany(Tag::class,'post_tags');
    }

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
