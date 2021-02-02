<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Cost;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('panel.users.index')->with([
            'roles' => Role::all(),
            'users' => User::all(),
            ]);
    }

    public function create(){

        return view('panel.users.create')->with([
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request){
        
        $address = new Address();
        $address->address = $request->address;
        $address->city = $request->city;
        $address->province = $request->province;
        $address->country = $request->country;
        $address->postal_code = $request->postal_code;
        $address->save();

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->address_id = $address->id;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()
            ->route('dashboard.users.index')
            ->withSuccess("El usuario {$user->name} con id {$user->id} fue creado con éxito");
    }

    public function show($user){
        $user = User::where('id',$user)->first();
        //dd($user);
        $address = Address::find($user->address_id);
        
        return view('panel.users.show')->with([
            'user' => $user,
            'roles' => Role::all(),
            'address' => $address,
        ]);
    }

    public function edit($user){

          $user = User::find($user)->first();
        $address = Address::find($user->address_id);

        return view('panel.users.edit')->with([
            'user' => $user,
            'roles' => Role::all(),
            'address' => $address,
        ]);
    }


    // public function update(Request $request, $product){
    //     $product_id = intval($product);
    //     $product = Product::find($product_id);

    //     $cost = new Cost();
    //     $cost->cost = $request->cost;
    //     $cost->currency_id = $request->currency_id;
    //     $cost->save();
        
    //     $product->name = $request->name;
    //     $product->description = $request->description;
    //     $product->stock = $request->stock;
    //     $product->status = $request->status;
    //     $product->cost_id = $cost->id;
    //     $product->category_id = $request->category_id;
    //     $product->save();

    //     return redirect()
    //         ->route('dashboard.products.index')
    //         ->withSuccess("El producto {$product->name} fue actualizado con éxito");
    // }
    
    // public function status_update(Request $request, $product){
              
    //     $product_id = intval($product);
    //     $product = Product::find($product_id);
    //     $product->status = $request->status;
    //     $product->save();

    //     return redirect()
    //          ->route('dashboard.products.index')
    //          ->withSuccess("El producto {$product->nombre} fue actualizado con éxito");
    // }

    // public function soft_delete(Request $request, $product){
    //     $product_id = intval($product);
    //     $product = Product::find($product_id);
    //     $product->is_deleted = $request->is_deleted;
    //     $product->save();

    //     return redirect()
    //          ->route('dashboard.products.index')
    //          ->withSuccess("El producto {$product->name} fue eliminado con éxito");
    // }
}
