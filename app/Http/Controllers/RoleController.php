<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        return view('panel.roles.index')->with([
            'roles' => Role::all(),
            'users' => User::all(),
            ]);
    }

    public function create(){

        return view('panel.roles.create')->with([
            'roles' => Role::all(),
        ]);
    }
}
