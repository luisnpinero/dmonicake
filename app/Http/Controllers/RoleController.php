<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('panel.roles.index')->with([
            'roles' => Role::where('is_deleted',false)->get(),
            ]);
    }

    public function create(){
        return view('panel.roles.create')->with([
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function store(Request $request){
        $role = new Role();
        $role->name = $request->name;
        $role->status = $request->status;
        $role->modified_by = Auth::user()->id;
        $role->save();

        return redirect()
            ->route('dashboard.roles.index')
            ->withSuccess("El rol {$role->name} con id {$role->id} fue creado con éxito");
    }

    public function show(Role $role){
        return view('panel.roles.show')->with([
            'role' => $role,
            'roles' => $role,
        ]);
    }

    public function edit(Role $role){
        return view('panel.roles.edit')->with([
            'role' => $role,
            'roles' => $role,
        ]);
    }

    public function update(Request $request, Role $role){
        $role->name = $request->name;
        $role->status = $request->status;
        $role->modified_by = Auth::user()->id;
        $role->save();

        return redirect()
            ->route('dashboard.roles.index')
            ->withSuccess("El rol {$role->name} con id {$role->id} fue actualizado con éxito");
    }

    public function status_update(Request $request, Role $role){
        $role->status = $request->status;
        $role->modified_by = Auth::user()->id;
        $role->save();

        return redirect()
            ->route('dashboard.roles.index')
            ->withSuccess("El rol {$role->name} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, Role $role){
        $role->is_deleted = $request->is_deleted;
        $role->status = 'inactive';
        $role->modified_by = Auth::user()->id;
        $role->save();

        return redirect()
            ->route('dashboard.roles.index')
            ->withSuccess("El rol {$role->name} fue actualizado con éxito");
    }

}
