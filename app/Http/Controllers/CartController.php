<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Currency;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(){
        return view('store.carts')->with([
            'cart' => $this->cartService->getFromCookieOrCreate(),
            'currencies' => Currency::all(),
            'costs' => Cost::all(),
        ]);
    }
}
