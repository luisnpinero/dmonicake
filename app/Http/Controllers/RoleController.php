<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $roles = Role::where('is_deleted',false)->get();
        return view('panel.roles.index')->with([
            'roles' => $roles,
            ]);
    }

    public function create(){

        return view('panel.roles.create')->with([
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request){        
        
        $role = new Role();
        $role->name = $request->name;
        $role->status = $request->status;
        $role->save();

        return redirect()
            ->route('dashboard.roles.index')
            ->withSuccess("El rol {$role->name} con id {$role->id} fue creado con éxito");
    }

    public function show($role){
        $role = Role::find($role)->first();

        return view('panel.roles.show')->with([
            'roles' => Role::all(),
            'role' => $role,
        ]);
    }

    public function edit($role){
        $role = Role::where('id',$role)->first();
        
        return view('panel.roles.edit')->with([
            'role' => $role,
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, $role){
        $role_id = intval($role);
        $role = Role::find($role_id);
        $role->name = $request->name;
        $role->status = $request->status;
        $role->save();

        return redirect()
            ->route('dashboard.roles.index')
            ->withSuccess("El rol {$role->name} con id {$role->id} fue actualizado con éxito");
    }

    public function status_update(Request $request, $role){              
        $role_id = intval($role);
        $role = Role::find($role_id);
        $role->status = $request->status;
        $role->save();

        return redirect()
            ->route('dashboard.roles.index')
            ->withSuccess("El rol {$role->name} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, $role){              
        $role_id = intval($role);
        $role = Role::find($role_id);
        $role->is_deleted = $request->is_deleted;
        $role->save();

        return redirect()
            ->route('dashboard.roles.index')
            ->withSuccess("El rol {$role->name} fue actualizado con éxito");
    }

}
