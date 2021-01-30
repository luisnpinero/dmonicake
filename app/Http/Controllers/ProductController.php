<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('panel.products.index')->with([
            'products' => Product::all(),
            'categories' => Category::all(),
        ]);
    }

    public function create(){
        return view('panel.products.create');
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
