@extends('layouts.dashboard')

@section('title','Categoria')

@section('title-page','Categoria')

@section('subtitle-page','Crear nueva Categoria')

@section('content')

<div class="container card">
    <div class="card-body">
        <form action="{{route('dashboard.categories.store')}}" method="post">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autofocus placeholder="Ingresa el Nombre de la Categoria">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">Estado de la Categoria</label>
                <div class="col-md-6">
                    <select name="status" class="custom-select" id="status" required autofocus>
                        <option value="" selected>Escoge una opción</option>
                        <option value="active">Activo</option>
                        <option value="inactive">No Activo</option>
                    </select>  
                </div>              
            </div>    

            <div class="form-group row">
                <label for="button" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-success btn-lg" value="Crear">
                </div>
                <div class="col-md-2">
                    <a href="{{route('dashboard.categories.index')}}" class="btn btn-danger btn-lg">Cancelar</a>
                </div>
            </div>           
        </form>
    </div>
</div>
@endsection