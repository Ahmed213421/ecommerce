<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Subcategory extends BaseModel
{
    use HasFactory,HasTranslations;


    public $translatable = ['name', 'description'];

    public function getRouteKeyName()
{
    return 'id';
}

    protected $table = 'subcategories';

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
