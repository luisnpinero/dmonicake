<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cost;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('panel.orders.index')->with([
            'orders' => Order::all(),
            'currencies' => Currency::all(),
            'roles' => Role::all(),
            'users' => User::all(),
            ]);
    }

    public function create(){
        //
    }

    public function store(){
        //
    }

    public function show($order){

        $order = Order::find($order);
        
        return view('panel.orders.show')->with([
            'order' => $order,
            'roles' => Role::all(),
            'products' => Product::all(),
            'categories' => Category::all(),
            'currencies' => Currency::all(),
            'costs' => Cost::all(),

            'user' => $user = User::find($order->user_id),
        ]);
    }

    public function categories(){
        //
    }

    public function edit($order){
        return "vista dashboard user edit {$user}";
        // return view('index');
    }


    public function update($user){
        // return view('index')
    }

        
    public function status_update(Request $request, $order){

        $order = Order::find($order);
        $order->status = $request->status;
        $order->save();

        return redirect()
             ->route('dashboard.orders.index')
             ->withSuccess("La orden {$order->id} fue actualizada con éxito");
    }

    public function soft_delete(Request $request, $order){
        $order = Order::find($order);
        $order->is_deleted = $request->is_deleted;
        $order->save();

        return redirect()
             ->route('dashboard.orders.index')
             ->withSuccess("La order {$order->id} fue eliminada con éxito");
    }
}
