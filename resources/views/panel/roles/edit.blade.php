@extends('layouts.dashboard')

@section('title','Roles')

@section('title-page','Roles')

@section('subtitle-page','Editar un Rol')

@section('content')

<div class="container card">
    <div class="card-body">
        <form action="{{route('dashboard.roles.update', $role) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $role->name }}" required autofocus placeholder="Ingresa el Nombres del Rol">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">Estado del Rol</label>
                <div class="col-md-6">
                    <select name="status" class="custom-select" id="status" required autofocus>
                        <option value="" selected>Escoge una opción</option>
                        <option {{ $role->status == 'active' ? 'selected' : ''}} value="active">Activo</option>
                        <option {{ $role->status == 'inactive' ? 'selected' : ''}} value="inactive">No Activo</option>
                    </select>  
                </div>              
            </div>    

            <div class="form-group row">
                <label for="button" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-success btn-lg" value="Editar">
                </div>
                <div class="col-md-2">
                    <a href="{{route('dashboard.roles.index')}}" class="btn btn-danger btn-lg">Cancelar</a>
                </div>
            </div>           
        </form>
    </div>
</div>
@endsection