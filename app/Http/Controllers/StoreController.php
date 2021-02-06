<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Cost;
use App\Models\Currency;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $categories = Category::where('status','active')->get();
        $products = Product::where('status','active')->with('Images')->paginate(9);
        $costs = Cost::all();
        $currencies = Currency::all();

        return view('store.index')->with([
            'categories' => $categories,
            'products' => $products,
            'costs' => $costs,
            'currencies' => $currencies,
            ]);
    }

    public function create(){
        return "vista dashboard user create";
        // return view('index');
    }

    public function show(Product $product){
        $cost = Cost::find($product->cost_id)->first();
        $currency = Currency::find($cost->currency_id)->first();
        return view('store.show')->with([
            'product' => $product,
            'cost' => $cost,
            'currency' => $currency,
        ]);
    }

    public function categories(Category $category){
        $products = Product::where('category_id',$category->id)->paginate(9);
        $costs = Cost::all();
        $currencies = Currency::all();

        return view('store.categories')->with([
            'category' => $category,
            'products' => $products,
            'costs' => $costs,
            'currencies' => $currencies,
        ]);
    }

    public function edit(User $user){
        return "vista dashboard user edit {$user}";
        // return view('index');
    }

    public function store(){
        // return view('index');
    }

    public function update($user){
        // return view('index')
    }

    public function destroy($user){
        //
    }
}
