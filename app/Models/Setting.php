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

    public static function getTaxRate()
    {
        return self::first()->tax_rate ?? "0.20";
    }

    public static function updateTaxRate($newRate)
    {
        self::query()->update(['tax_rate' => $newRate]);
    }
}
