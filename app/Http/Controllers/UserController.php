<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Cost;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $users = User::where('is_deleted',false)->get();
        return view('panel.users.index')->with([
            'roles' => Role::all(),
            'users' => User::where('is_deleted',false)->get(),
            ]);
    }

    public function create(){
        return view('panel.users.create')->with([
            'roles' => Role::where('status','active')->get(),
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
        $user->modified_by = Auth::user()->id;
        $user->save();

        return redirect()
            ->route('dashboard.users.index')
            ->withSuccess("El usuario {$user->name} con id {$user->id} fue creado con éxito");
    }

    public function show(User $user){
        return view('panel.users.show')->with([
            'address' => Address::find($user->address_id),
            'roles' => Role::all(),
            'user' => $user,
        ]);
    }

    public function edit(User $user){
        return view('panel.users.edit')->with([
            'user' => $user,
            'roles' => Role::where('is_deleted',false)->get(),
            'address' => Address::find($user->address_id),
        ]);
    }

    public function update(Request $request, User $user){
        // debo corregir el que se crea una direccion nueva cada vez que edito a un usuario.
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
        $user->modified_by = Auth::user()->id;
        if($request->email == $user->email){
        }else{
            $user->email = $request->email;
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }
        if($request->password ==! null){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if($request->hasFile('image')){
            if ($user->image != null) {
                Storage::disk('images')->delete($user->image->path);
                $user->image->delete();
            }

            $user->image()->create([
                'path' => $request->image->store('users','images'),
            ]);
        }

        return redirect()
            ->route('dashboard.users.index')
            ->withSuccess("El usuario {$user->name} con id {$user->id} fue creado con éxito");
    }

    public function status_update(Request $request, User $user){
        $user->status = $request->status;
        $user->modified_by = Auth::user()->id;
        $user->save();

        return redirect()
            ->route('dashboard.users.index')
            ->withSuccess("El usuario {$user->first_name} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, User $user){
        $user->is_deleted = $request->is_deleted;
        $user->modified_by = Auth::user()->id;
        $user->save();

        return redirect()
            ->route('dashboard.users.index')
            ->withSuccess("El usuario {$user->first_name} fue eliminado con éxito");
    }
}
