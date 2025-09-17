<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function purchasedProducts()
    {
        return $this->hasManyThrough(
            Product::class,
            OrderDetail::class,
            'order_id',
            'id',
            'id',
            'product_id'
        )->join('orders', 'orders.id', '=', 'order_details.order_id')
        ->where('orders.user_id', $this->id)
        // ->where('orders.status', 'delivered')
        ->select('products.*');
    }



    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function favorites() {
        return $this->belongsToMany(Product::class, 'favorites','user_id','product_id');
    }

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'deactive');
    }

}
