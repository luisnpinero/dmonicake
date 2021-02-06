<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    protected $cookieName ='cart';

    public function getFromCookie(){
        $cartId = Cookie::get($this->cookieName);
        $cart = Cart::find($cartId);
        return $cart;
    }

    // crear cookie para almacenar datos del carrito, si no existe cookie activa, crea una
    public function getFromCookieOrCreate(){
        $cart = $this->getFromCookie();
        return $cart ?? Cart::create();
    }

    public function makeCookie(Cart $cart){
        Cookie::make($this->cookieName, $cart->id, 1000);
    }

    public function countProducts(){
        $cart = $this->getFromCookie();

        if($cart != null){
            return $cart->products->pluck('pivot.quantity')->sum();
        }

        return 0;

    }
}