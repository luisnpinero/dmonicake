<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('panel.index')->with([
            'products' => Product::all(),
        ]);
    }
}
