<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('panel.paymentmethods.index')->with([
            'paymentmethods' => PaymentMethod::where('is_deleted',false)->get(),
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function create(){
        return view('panel.paymentmethods.create')->with([
            'paymentmethods' => PaymentMethod::all(),
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request){
        $paymentmethod = new PaymentMethod();
        $paymentmethod->name = $request->name;
        $paymentmethod->status = $request->status;
        $paymentmethod->modified_by = Auth::user()->id;
        $paymentmethod->save();

        return redirect()
            ->route('dashboard.paymentmethods.index')
            ->withSuccess("El metodo de pago {$paymentmethod->name} con id {$paymentmethod->id} fue creado con éxito");
    }

    public function show(PaymentMethod $paymentmethod){
        return view('panel.paymentmethods.show')->with([
            'paymentmethods' => PaymentMethod::all(),
            'paymentmethod' => $paymentmethod,
            'roles' => Role::all(),
        ]);
    }

    public function edit(PaymentMethod $paymentmethod){
        return view('panel.paymentmethods.edit')->with([
            'paymentmethod' => $paymentmethod,
            'paymentmethods' => PaymentMethod::all(),
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, PaymentMethod $paymentmethod){
        $paymentmethod->name = $request->name;
        $paymentmethod->status = $request->status;
        $paymentmethod->save();

        return redirect()
            ->route('dashboard.paymentmethods.index')
            ->withSuccess("El metodo de pago {$paymentmethod->name} con id {$paymentmethod->id} fue actualizado con éxito");
    }

    public function status_update(Request $request, PaymentMethod $paymentmethod){              
        $paymentmethod->status = $request->status;
        $paymentmethod->modified_by = Auth::user()->id;
        $paymentmethod->save();

        return redirect()
            ->route('dashboard.paymentmethods.index')
            ->withSuccess("El metodo de pago {$paymentmethod->name} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, PaymentMethod $paymentmethod){
        $paymentmethod->is_deleted = $request->is_deleted;
        $paymentmethod->status = 'inactive';
        $paymentmethod->modified_by = Auth::user()->id;
        $paymentmethod->save();

        return redirect()
            ->route('dashboard.paymentmethods.index')
            ->withSuccess("El metodo de pago {$paymentmethod->name} fue actualizado con éxito");
    }
}
