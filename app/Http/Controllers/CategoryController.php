<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::where('is_deleted',false)->get();
        return view('panel.categories.index')->with([
            'categories' => $categories,
            'roles' => Role::all(),
            ]);
    }

    public function create(){

        return view('panel.categories.create')->with([
            'categories' => Category::all(),
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request){        
        
        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()
            ->route('dashboard.categories.index')
            ->withSuccess("La categoria {$category->name} con id {$category->id} fue creado con éxito");
    }

    public function show($category){
        $category = Category::find($category)->first();

        return view('panel.categories.show')->with([
            'categories' => Category::all(),
            'category' => $category,
            'roles' => Role::all(),
        ]);
    }

    public function edit($category){
        $category = Category::where('id',$category)->first();
        
        return view('panel.categories.edit')->with([
            'category' => $category,
            'categories' => Category::all(),
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, $category){
        $role_id = intval($category);
        $category = Category::find($role_id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()
            ->route('dashboard.categories.index')
            ->withSuccess("La categoria {$category->name} con id {$category->id} fue actualizado con éxito");
    }

    public function status_update(Request $request, $category){              
        $role_id = intval($category);
        $category = Category::find($role_id);
        $category->status = $request->status;
        $category->save();

        return redirect()
             ->route('dashboard.categories.index')
             ->withSuccess("La categoria {$category->name} fue actualizado con éxito");
    }

    public function soft_delete(Request $request, $category){              
        $role_id = intval($category);
        $category = Category::find($role_id);
        $category->is_deleted = $request->is_deleted;
        $category->save();

        return redirect()
             ->route('dashboard.categories.index')
             ->withSuccess("La categoria {$category->name} fue actualizado con éxito");
    }
}
