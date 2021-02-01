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

    public function store(Request $request){

        $cost = new Cost();
        $cost->cost = $request->cost;
        $cost->currency_id = $request->currency_id;
        $cost->save();

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->cost_id = $cost->id;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect()
            ->route('dashboard.products.index')
            ->withSuccess("El nuevo producto con id {$product->id} fue creado con éxito");
    }

    public function show_product(){
        return "ok";
    }

    public function categories(){
        return "ok";
    }

    public function edit($product){

        $product = Product::where('name',$product)->first();

        return view('panel.products.edit')->with([
            'product' => $product,
            'categories' => Category::all(),
            'currencies' => Currency::all(),
            'costs' => Cost::all(),
            'roles' => Role::all(),
        ]);
    }


    public function update(Request $request, $product){
        $product_id = intval($product);

        

        $product = Product::find($product_id);
        
        
        // $cost = Cost::find($products->cost_id)->first();
        // dd($request);
        $cost = new Cost();
        $cost->cost = $request->cost;
        $cost->currency_id = $request->currency_id;
        $cost->save();
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->cost_id = $cost->id;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect()
            ->route('dashboard.products.index')
            ->withSuccess("El nuevo producto con id {$product->id} fue actualizado con éxito");
    }

    public function destroy($user){
        //
    }
}
