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
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autofocus placeholder="Ingresa el Nombre">
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Descripción del Producto</label>
                <div class="col-md-6">
                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="" required autofocus placeholder="Ingresa la Descripción" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="stock" class="col-md-4 col-form-label text-md-right">Stock del Producto</label>
                <div class="col-md-6">
                    <input id="stock" type="number" min="0" step="1" class="form-control @error('stock') is-invalid @enderror" name="stock" value="" required autofocus placeholder="Ingresa el Stock">
                </div>
            </div>

            <div class="form-group row">
                <label for="currency_id" class="col-md-4 col-form-label text-md-right">Moneda</label>
                <div class="col-md-6">
                    <select name="currency_id" class="custom-select" id="currency_id" required autofocus>
                        @foreach ($currencies as $currency)
                            <option value="{{$currency->name}}">{{$currency->name}}</option>
                        @endforeach
                    </select>  
                </div>
            </div>
            
            <div class="form-group row">
                <label for="cost" class="col-md-4 col-form-label text-md-right">Precio del Producto</label>
                <div class="col-md-6">
                    <input id="cost_id" type="number" min="0" step="0.01" class="form-control @error('cost_id') is-invalid @enderror" name="cost_id" value="" required autofocus placeholder="Ingresa el Precio">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="category_id" class="col-md-4 col-form-label text-md-right">Categoría del Producto</label>
                <div class="col-md-6">
                    <select name="category_id" class="custom-select" id="category_id" required autofocus>
                        @foreach ($categories as $category)
                            <option value="{{$category->name}}">{{$category->name}}</option>
                        @endforeach
                    </select>  
                </div>              
            </div>
            
            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">Estado del Producto</label>
                <div class="col-md-6">
                    <select name="status" class="custom-select" id="status" required autofocus>
                        <option value="available" selected>Disponible</option>
                        <option value="unavailable">No disponible</option>
                    </select>  
                </div>              
            </div>    

            <div class="form-group row">
                <label for="button" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-2">
                    <a href="{{route('dashboard.products.create')}}" class="btn btn-success btn-lg">Crear</a>
                </div>
                <div class="col-md-2">
                    <a href="{{route('dashboard.products.create')}}" class="btn btn-danger btn-lg">Cancelar</a>
                </div>
            </div>           
        </form>
    </div>
</div>
@endsection