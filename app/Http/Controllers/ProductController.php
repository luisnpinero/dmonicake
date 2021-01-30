<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cost;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('panel.products.index')->with([
            'products' => Product::all(),
            'categories' => Category::all(),
            'currencies' => Currency::all(),
            'costs' => Cost::all(),
            'roles' => Role::all(),
            ]);
    }

    public function create(){

        return view('panel.products.create')->with([
            'roles' => Role::all(),
            'categories' => Category::all()->sortBy('name'),
            'currencies' => Currency::all()->sortBy('name'),
        ]);
    }

    public function store(){
        // ????
        $cost = Cost::create([
            'cost' => request()->cost_id,
            'currency_id' => request()->currency_id,
        ]);
        // $product = Product::create([
        //     'name' =>,
        //     'description' =>,
        //     'stock' =>,
        //     'cost_id' =>,
        //     'category_id' =>,
        //     'status' =>,
        // ]);
        $product = Product::create(request()->all());
        return redirect()
            ->route('panel.products.index')
            ->withSuccess("El nuevo producto con id {$product->id} fue creado con éxito");
    }

    public function show_product(){
        return "ok";
    }

    public function categories(){
        return "ok";
    }

    public function edit($user){
        return "vista dashboard user edit {$user}";
        // return view('index');
    }


    public function update($user){
        // return view('index')
    }

    public function destroy($user){
        //
    }
}
