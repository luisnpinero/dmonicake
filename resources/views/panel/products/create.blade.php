@extends('layouts.dashboard')

@section('title','Productos')

@section('title-page','Productos')

@section('subtitle-page','Crear nuevo Producto')

@section('content')
<div class="container card">
    <div class="card-body">
        <form action="{{route('dashboard.products.store')}}" method="post">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre del Producto</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus placeholder="Ingresa el Nombre">
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Descripción del Producto</label>
                <div class="col-md-6">
                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autofocus placeholder="Ingresa la Descripción" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="stock" class="col-md-4 col-form-label text-md-right">Stock del Producto</label>
                <div class="col-md-6">
                    <input id="stock" type="number" min="0" step="1" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" required autofocus placeholder="Ingresa el Stock">
                </div>
            </div>

            <div class="form-group row">
                <label for="currency_id" class="col-md-4 col-form-label text-md-right">Moneda</label>
                <div class="col-md-6">
                    <select name="currency_id" class="custom-select" id="currency_id" required autofocus>
                        <option value="" selected disabled>Escoge una opción</option>
                        @foreach ($currencies as $currency)
                        <option {{ old('currency_id') == '$currency->id' ? 'selected' : ''}} value="{{$currency->id}}">{{$currency->name}}</option>
                        @endforeach
                    </select>  
                </div>
            </div>

            <div class="form-group row">
                <label for="cost" class="col-md-4 col-form-label text-md-right">Precio del Producto</label>
                <div class="col-md-6">
                    <input id="cost" type="number" min="0" step="0.01" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ old('cost') }}" required autofocus placeholder="Ingresa el Precio">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="category_id" class="col-md-4 col-form-label text-md-right">Categoría del Producto</label>
                <div class="col-md-6">
                    <select name="category_id" class="custom-select" id="category_id" required autofocus>
                        <option value="" selected disabled>Escoge una opción</option>
                        @foreach ($categories as $category)
                        <option {{ old('category_id') == '$category->id' ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">Estado del Producto</label>
                <div class="col-md-6">
                    <select name="status" class="custom-select" id="status" required autofocus>
                        <option value="" selected disabled>Escoge una opción</option>
                        <option value="active">Disponible</option>
                        <option value="inactive">No disponible</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="button" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-success btn-lg" value="Crear">
                </div>
                <div class="col-md-2">
                    <a href="{{route('dashboard.products.index')}}" class="btn btn-danger btn-lg">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection