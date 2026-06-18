<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order extends BaseModel
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
