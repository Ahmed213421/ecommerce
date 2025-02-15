<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $translatable = ['whoweare','description','address','hours_working'];

    public function link()
    {
        return $this->morphOne(Link::class,'linkable');


    }
}
