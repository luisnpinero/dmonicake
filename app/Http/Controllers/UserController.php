<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cost;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('panel.users.index')->with([
            'roles' => Role::all(),
            'users' => User::all(),
            ]);
    }
}
