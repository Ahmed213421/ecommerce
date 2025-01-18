<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory,HasTranslations;
    public $translatable = ['name','description'];

    protected $guarded = [];

    public function getRouteKeyName()
{
    return 'slug';
}

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

    public function orders(){
        return $this->hasMany(OrderDetail::class);
    }

    public function favoritedBy() {
        return $this->belongsToMany(User::class, 'favorites','product_id','user_id');
    }
}
