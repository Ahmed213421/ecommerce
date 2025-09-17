<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory,HasTranslations;

    public $translatable = ['name','description'];

    public function getRouteKeyName()
{
    return 'id';
}

    protected $guarded = [];

    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }
}
