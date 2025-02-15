<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subcategory extends Model
{
    use HasFactory,HasTranslations;


    public $translatable = ['name'];
    protected $guarded = [];

    public function getRouteKeyName()
{
    return 'slug';
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
