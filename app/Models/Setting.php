<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Setting extends BaseModel
{
    use HasFactory,HasTranslations;

    public $translatable = ['whoweare','description','address','hours_working'];

    public function link()
    {
        return $this->morphOne(Link::class,'linkable');


    }

    public static function getTaxRate()
    {
        return self::first()->tax_rate ?? "0.20";
    }

    public static function updateTaxRate($newRate)
    {
        self::query()->update(['tax_rate' => $newRate]);
    }
}
