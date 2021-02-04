<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('panel.categories.index')->with([
            'categories' => Category::where('is_deleted',false)->get(),
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function create(){
        return view('panel.categories.create')->with([
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function store(Request $request){        
        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->modified_by = Auth::user()->id;
        $category->save();

        return redirect()
            ->route('dashboard.categories.index')
            ->withSuccess("La categoria {$category->name} con id {$category->id} fue creado con éxito");
    }

    public function show(Category $category){
        return view('panel.categories.show')->with([
            'category' => $category,
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function edit(Category $category){
        return view('panel.categories.edit')->with([
            'category' => $category,
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function update(Request $request, Category $category){
        $category->name = $request->name;
        $category->status = $request->status;
        $category->modified_by = Auth::user()->id;
        $category->save();

        return redirect()
            ->route('dashboard.categories.index')
            ->withSuccess("La categoria {$category->name} con id {$category->id} fue actualizada con éxito");
    }

    public function status_update(Request $request, Category $category){              
        $category->status = $request->status;
        $category->modified_by = Auth::user()->id;
        $category->save();

        return redirect()
            ->route('dashboard.categories.index')
            ->withSuccess("La categoria {$category->name} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, Category $category){              
        $category->is_deleted = $request->is_deleted;
        $category->modified_by = Auth::user()->id;
        $category->status = 'inactive';
        $category->save();

        return redirect()
            ->route('dashboard.categories.index')
            ->withSuccess("La categoria {$category->name} fue actualizado con éxito");
    }
}