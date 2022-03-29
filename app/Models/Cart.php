<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Auth;

class Cart extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        // 'order_id',
        'ip_address',
        'product_id',
        'product_quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function order()
    {
        return $this->belongsTo(Order::class);
    } 

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function totalCarts()
    {
        if (Auth::check()) {
            //if user is present 
            $carts = Cart::where('user_id', Auth::id())
            ->orWhere('ip_address', request()->ip())
            ->where('order_id', NULL)
            ->get();

        }else{
            // user is absent
            $carts = Cart::where('ip_address', request()->ip())
            ->where('order_id', NULL)
            ->get();
        }
        return $carts;
    }

    public static function totalItems()
    {

       $carts = Cart::totalCarts();
       $total_item = 0;

       foreach ($carts as $cart) {
          $total_item += $cart->product_quantity;
      }
      return $total_item;
  }
}
