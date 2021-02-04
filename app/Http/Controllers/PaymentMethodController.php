<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Role;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $paymentmethods = PaymentMethod::where('is_deleted',false)->get();
        return view('panel.paymentmethods.index')->with([
            'paymentmethods' => $paymentmethods,
            'roles' => Role::all(),
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
        $paymentmethod->save();

        return redirect()
            ->route('dashboard.paymentmethods.index')
            ->withSuccess("El metodo de pago {$paymentmethod->name} con id {$paymentmethod->id} fue creado con éxito");
    }

    public function show($paymentmethod){
        $paymentmethod = PaymentMethod::find($paymentmethod)->first();

        return view('panel.paymentmethods.show')->with([
            'paymentmethods' => PaymentMethod::all(),
            'paymentmethod' => $paymentmethod,
            'roles' => Role::all(),
        ]);
    }

    public function edit($paymentmethod){
        $paymentmethod = PaymentMethod::where('id',$paymentmethod)->first();
        
        return view('panel.paymentmethods.edit')->with([
            'paymentmethod' => $paymentmethod,
            'paymentmethods' => PaymentMethod::all(),
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, $paymentmethod){
        $role_id = intval($paymentmethod);
        $paymentmethod = PaymentMethod::find($role_id);
        $paymentmethod->name = $request->name;
        $paymentmethod->status = $request->status;
        $paymentmethod->save();

        return redirect()
            ->route('dashboard.paymentmethods.index')
            ->withSuccess("El metodo de pago {$paymentmethod->name} con id {$paymentmethod->id} fue actualizado con éxito");
    }

    public function status_update(Request $request, $paymentmethod){              
        $role_id = intval($paymentmethod);
        $paymentmethod = PaymentMethod::find($role_id);
        $paymentmethod->status = $request->status;
        $paymentmethod->save();

        return redirect()
            ->route('dashboard.paymentmethods.index')
            ->withSuccess("El metodo de pago {$paymentmethod->name} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, $paymentmethod){              
        $role_id = intval($paymentmethod);
        $paymentmethod = PaymentMethod::find($role_id);
        $paymentmethod->is_deleted = $request->is_deleted;
        $paymentmethod->save();

        return redirect()
            ->route('dashboard.paymentmethods.index')
            ->withSuccess("El metodo de pago {$paymentmethod->name} fue actualizado con éxito");
    }
}
