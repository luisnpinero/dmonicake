<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('profile.index')->with([
            'user' => Auth::user(),
            'address' => Address::find(Auth::user()->address_id),
        ]);
    }

    public function edit(Request $request){
        return view('profile.edit')->with([
            'user' => $request->user(),
            'address' => Address::find(Auth::user()->address_id),
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

        $user = Auth::user();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->address_id = $address->id;
        $user->role_id = $user->role_id;
        $user->modified_by = Auth::user()->id;
        if($request->email == $user->email){
        }else{
            $user->email = $request->email;
            $user->email_verified_at = null;
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
                ->route('profile.index')
                ->withSuccess('Perfil actualizado con exito');
    }
}
