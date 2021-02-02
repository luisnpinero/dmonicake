@extends('layouts.dashboard')

@section('title','Editar Productos')

@section('title-page','Productos')

@section('subtitle-page')
Editar Producto: <b>{{ $product->name }}</b>
@endsection

@section('content')

<div class="container card">
    <div class="card-body">
        
        <form action="{{ route('dashboard.products.update', $product) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre del Producto</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $product->name }}" required autofocus placeholder="Ingresa el Nombre">
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Descripción del Producto</label>
                <div class="col-md-6">
                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="" required autofocus placeholder="Ingresa la Descripción" rows="3">{{ old('description') ?? $product->description }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="stock" class="col-md-4 col-form-label text-md-right">Stock del Producto</label>
                <div class="col-md-6">
                    <input id="stock" type="number" min="0" step="1" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') ?? $product->stock }}" required autofocus placeholder="Ingresa el Stock">
                </div>
            </div>

            <div class="form-group row">
                <label for="currency_id" class="col-md-4 col-form-label text-md-right">Moneda</label>
                <div class="col-md-6">
                    <select name="currency_id" class="custom-select" id="currency_id" required autofocus>
                        <option value="" selected>Escoge una opción</option>
                        @foreach ($currencies as $currency)
                            <option {{ $currency->id == $costs->find($product->cost_id)->currency_id ? 'selected' : ''}} value="{{$currency->id}}">{{$currency->name}}</option>
                        @endforeach
                    </select>  
                </div>
            </div>

            <div class="form-group row">
                <label for="cost" class="col-md-4 col-form-label text-md-right">Precio del Producto</label>
                <div class="col-md-6">
                    <input id="cost" type="number" min="0" step="0.01" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ $costs->find($product->cost_id)->cost }}" required autofocus placeholder="Ingresa el Precio">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="category_id" class="col-md-4 col-form-label text-md-right">Categoría del Producto</label>
                <div class="col-md-6">
                    <select name="category_id" class="custom-select" id="category_id" required autofocus>
                        <option value="" selected>Escoge una opción</option>
                        @foreach ($categories as $category)
                            <option {{ $product->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>  
                </div>              
            </div>
            
            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">Estado del Producto</label>
                <div class="col-md-6">
                    <select name="status" class="custom-select" id="status" required autofocus>
                        <option value="" selected>Escoge una opción</option>
                        <option {{ $product->status == 'active' ? 'selected' : ''}} value="active">Disponible</option>
                        <option {{ $product->status == 'inactive' ? 'selected' : ''}} value="inactive">No disponible</option>
                    </select>  
                </div>              
            </div>    

            <div class="form-group row">
                <label for="button" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-success btn-lg" value="Editar">
                </div>
                <div class="col-md-2">
                    <a href="{{route('dashboard.users.index')}}" class="btn btn-danger btn-lg">Cancelar</a>
                </div>
            </div>           
        </form>
    </div>
</div>
@endsection