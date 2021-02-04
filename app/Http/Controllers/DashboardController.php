<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('panel.index')->with([
            'products' => Product::all(),
            'roles' => Role::all(),
            'users' => User::all(),
        ]);
    }
}
