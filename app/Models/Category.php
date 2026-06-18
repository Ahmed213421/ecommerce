<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Category extends BaseModel
{
    use HasFactory,HasTranslations;

    public $translatable = ['name','description'];

    public function getRouteKeyName()
{
    return 'id';
}

    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }
}
