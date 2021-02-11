<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cost;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Role;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){        
        return view('panel.products.index')->with([
            'products' => Product::where('is_deleted',false)->get(),
            'categories' => Category::all(),
            'currencies' => Currency::all(),
            'costs' => Cost::all(),
            'roles' => Role::where('is_deleted',false)->get(),
            ]);
    }

    public function create(){
        return view('panel.products.create')->with([
            'roles' => Role::where('is_deleted',false)->get(),
            'categories' => Category::where('status','active')->get()->sortBy('name'),
            'currencies' => Currency::where('status','active')->get()->sortBy('name'),
        ]);
    }

    public function store(Request $request){
        $cost = new Cost();
        $cost->cost = $request->cost;
        $cost->currency_id = $request->currency_id;
        $cost->modified_by = Auth::user()->id;
        $cost->save();

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->cost_id = $cost->id;
        $product->category_id = $request->category_id;
        $product->modified_by = Auth::user()->id;
        $product->save();

        $product->image()->create([
                'path' => $request->image->store('products','images'),
            ]);

        return redirect()
            ->route('dashboard.products.index')
            ->withSuccess("El producto {$product->name} con id {$product->id} fue creado con éxito");
    }

    public function show(Product $product){
        $cost = Cost::find($product->cost_id);
        return view('panel.products.show')->with([
            'product' => $product,
            'roles' => Role::where('is_deleted',false)->get(),
            'category' => Category::find($product->category_id),
            'cost' => $cost,
            'currency' => Currency::find($cost->currency_id),
        ]);
    }

    public function edit(Product $product){
        return view('panel.products.edit')->with([
            'product' => $product,
            'categories' => Category::where('status','active')->get(),
            'currencies' => Currency::where('status','active')->get(),
            'costs' => Cost::find($product->cost_id)->get(),
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }


    public function update(Request $request, Product $product){
        $cost = new Cost();
        $cost->cost = $request->cost;
        $cost->currency_id = $request->currency_id;
        $cost->modified_by = Auth::user()->id;
        $cost->save();
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->cost_id = $cost->id;
        $product->category_id = $request->category_id;
        $product->modified_by = Auth::user()->id;
        $product->save();

        if ($request->hasFile('image')) {
            if ($product->image != null) {
                Storage::disk('images')->delete($product->image->path);
                $product->image->delete();
            }

            $product->images()->create([
                'path' => $request->image->store('products', 'images'),
            ]);
        }

        return redirect()
            ->route('dashboard.products.index')
            ->withSuccess("El producto {$product->name} fue actualizado con éxito");
    }
    
    public function status_update(Request $request, Product $product){
        $product->status = $request->status;
        $product->modified_by = Auth::user()->id;
        $product->save();

        return redirect()
            ->route('dashboard.products.index')
            ->withSuccess("El producto {$product->nombre} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, Product $product){
        $product->is_deleted = $request->is_deleted;
        $product->modified_by = Auth::user()->id;
        $product->status = 'inactive';
        $product->save();

        return redirect()
            ->route('dashboard.products.index')
            ->withSuccess("El producto {$product->name} fue eliminado con éxito");
    }
}
