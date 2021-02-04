<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('panel.currencies.index')->with([
            'currencies' => Currency::where('is_deleted',false)->get(),
            'roles' => Role::where('is_deleted',false)->get(),
            ]);
    }

    public function create(){
        return view('panel.currencies.create')->with([
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function store(Request $request){
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->status = $request->status;
        $currency->modified_by = Auth::user()->id;
        $currency->save();

        return redirect()
            ->route('dashboard.currencies.index')
            ->withSuccess("La moneda {$currency->name} con id {$currency->id} fue creado con éxito");
    }

    public function show(Currency $currency){
        return view('panel.currencies.show')->with([
            'currency' => $currency,
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function edit(Currency $currency){
        return view('panel.currencies.edit')->with([
            'currency' => $currency,
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function update(Request $request, Currency $currency){
        $currency->name = $request->name;
        $currency->status = $request->status;
        $currency->modified_by = Auth::user()->id;
        $currency->save();

        return redirect()
            ->route('dashboard.currencies.index')
            ->withSuccess("La moneda {$currency->name} con id {$currency->id} fue actualizado con éxito");
    }

    public function status_update(Request $request, Currency $currency){              
        $currency->status = $request->status;
        $currency->modified_by = Auth::user()->id;
        $currency->save();

        return redirect()
            ->route('dashboard.currencies.index')
            ->withSuccess("La moneda {$currency->name} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, Currency $currency){              
        $currency->is_deleted = $request->is_deleted;
        $currency->status = 'inactive';
        $currency->modified_by = Auth::user()->id;
        $currency->save();

        return redirect()
            ->route('dashboard.currencies.index')
            ->withSuccess("La moneda {$currency->name} fue actualizado con éxito");
    }

}
