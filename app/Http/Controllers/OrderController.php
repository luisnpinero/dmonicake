<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cost;
use App\Models\Currency;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService){
        $this->middleware('auth');
        $this->cartService = $cartService;
    }

    public function index(){
        return view('panel.orders.index')->with([
            'orders' => Order::where('is_deleted',false)->get(),
            'currencies' => Currency::all(),
            'roles' => Role::where('is_deleted',false)->get(),
            'users' => User::all(),
            ]);
    }

    public function show(Order $order){
        return view('panel.orders.show')->with([
            'order' => $order,
            'roles' => Role::all(),
            'products' => Product::all(),
            'categories' => Category::all(),
            'currencies' => Currency::all(),
            'costs' => Cost::all(),
            'user' => User::find($order->user_id),
        ]);
    }

    public function create(){
        $cart = $this->cartService->getFromCookie();

        if (!isset($cart) || $cart->products->isEmpty()) {
            return redirect()
                ->back()
                ->withErrors("Your cart is empty!");
        }

        return view('orders.create')->with([
            'cart' => $cart,
            'currencies' => Currency::all(),
            'paymentmethods' => PaymentMethod::where('status','active')->get(),
            'costs' => Cost::all(),
        ]);
    }

    public function finish(){
        return view('orders.finish');
    }

    public function store(Request $request){
        $user = $request->user();
        $cart = $this->cartService->getFromCookie();
        
        $order = New Order();
        $order->user_id = $user->id;
        $order->status = 'pending';
        $order->payment_method_id = $request->payment_method_id;
        $order->total = $request->total;
        $order->save();
        
        $cartProductsWithQuantity = $cart->products->mapWithKeys(function($product){
            $quantity = $product->pivot->quantity;
            
            if ($product->stock < $quantity) {
                throw ValidationException::withMessages([
                    'product' => "No hay suficiente stock del siguiente producto: {$product->name}",
                    ]);
                }
                
            $product->stock = $product->stock - $quantity;
            $product->save();
            
            $element[$product->id] = ['quantity' => $quantity];

            return $element;
        });

        $order->products()->attach($cartProductsWithQuantity->toArray());


        return redirect()->route('store.orders.finish')
            ->withSuccess("Su orden ha sido creada exitosamente bajo el numero de orden {$order->id}");
    }

    public function status_update(Request $request, Order $order){
        $order->status = $request->status;
        $order->modified_by = Auth::user()->id;
        $order->save();

        return redirect()
            ->route('dashboard.orders.index')
            ->withSuccess("La orden {$order->id} fue actualizada con éxito");
    }

    public function soft_delete(Request $request, Order $order){
        $order->is_deleted = $request->is_deleted;
        $order->modified_by = Auth::user()->id;
        $order->status = 'inactive';
        $order->save();

        return redirect()
            ->route('dashboard.orders.index')
            ->withSuccess("La order {$order->id} fue eliminada con éxito");
    }
}
