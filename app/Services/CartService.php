<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    // crear cookie para almacenar datos del carrito, si no existe cookie activa, crea una
    public function getFromCookieOrCreate(){
        $cartId = Cookie::get('cart');
        $cart = Cart::find($cartId);
        return $cart ?? Cart::create();
    }
}