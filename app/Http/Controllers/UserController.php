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
        $users = User::where('is_deleted',false)->get();
        return view('panel.users.index')->with([
            'roles' => Role::all(),
            'users' => $users,
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
        $address = Address::find($user->address_id);
        
        return view('panel.users.show')->with([
            'user' => $user,
            'roles' => Role::all(),
            'address' => $address,
        ]);
    }

    public function edit($user){
        $user = User::where('id',$user)->first();
        $address = Address::find($user->address_id);

        return view('panel.users.edit')->with([
            'user' => $user,
            'roles' => Role::all(),
            'address' => $address,
        ]);
    }

    public function update(Request $request, $user){
        $user_id = intval($user);
        $user = User::find($user_id);

        $address = new Address();
        $address->address = $request->address;
        $address->city = $request->city;
        $address->province = $request->province;
        $address->country = $request->country;
        $address->postal_code = $request->postal_code;
        $address->save();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->address_id = $address->id;
        $user->role_id = $request->role_id;
        if($request->email == $user->email){
        }else{
            $user->email = $request->email;
        }
        if($request->password ==! null){
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()
            ->route('dashboard.users.index')
            ->withSuccess("El usuario {$user->name} con id {$user->id} fue creado con éxito");
    }
    
    public function status_update(Request $request, $user){              
        $user_id = intval($user);
        $user = User::find($user_id);
        $user->status = $request->status;
        $user->save();

        return redirect()
             ->route('dashboard.users.index')
             ->withSuccess("El usuario {$user->first_name} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, $user){
        $user_id = intval($user);
        $user = User::find($user_id);
        $user->is_deleted = $request->is_deleted;
        $user->save();

        return redirect()
             ->route('dashboard.users.index')
             ->withSuccess("El usuario {$user->first_name} fue eliminado con éxito");
    }
}
