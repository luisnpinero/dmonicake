<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Role;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $currencies = Currency::where('is_deleted',false)->get();
        return view('panel.currencies.index')->with([
            'currencies' => $currencies,
            'roles' => Role::all(),
            ]);
    }

    public function create(){

        return view('panel.currencies.create')->with([
            'currencies' => Currency::all(),
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request){
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->status = $request->status;
        $currency->save();

        return redirect()
            ->route('dashboard.currencies.index')
            ->withSuccess("La moneda {$currency->name} con id {$currency->id} fue creado con éxito");
    }

    public function show($currency){
        $currency = Currency::find($currency)->first();

        return view('panel.currencies.show')->with([
            'currencies' => Currency::all(),
            'currency' => $currency,
            'roles' => Role::all(),
        ]);
    }

    public function edit($currency){
        $currency = Currency::where('id',$currency)->first();
        
        return view('panel.currencies.edit')->with([
            'currency' => $currency,
            'currencies' => Currency::all(),
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, $currency){
        $role_id = intval($currency);
        $currency = Currency::find($role_id);
        $currency->name = $request->name;
        $currency->status = $request->status;
        $currency->save();

        return redirect()
            ->route('dashboard.currencies.index')
            ->withSuccess("La moneda {$currency->name} con id {$currency->id} fue actualizado con éxito");
    }

    public function status_update(Request $request, $currency){              
        $role_id = intval($currency);
        $currency = Currency::find($role_id);
        $currency->status = $request->status;
        $currency->save();

        return redirect()
            ->route('dashboard.currencies.index')
            ->withSuccess("La moneda {$currency->name} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, $currency){              
        $role_id = intval($currency);
        $currency = Currency::find($role_id);
        $currency->is_deleted = $request->is_deleted;
        $currency->save();

        return redirect()
            ->route('dashboard.currencies.index')
            ->withSuccess("La moneda {$currency->name} fue actualizado con éxito");
    }

}
