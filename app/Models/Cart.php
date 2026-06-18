<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Cart extends BaseModel
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
