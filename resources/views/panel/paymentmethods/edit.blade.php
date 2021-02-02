@extends('layouts.dashboard')

@section('title','Metodos de Pago')

@section('title-page','Metodos de Pago')

@section('subtitle-page','Editar un Metodo de Pago')

@section('content')

<div class="container card">
    <div class="card-body">
        <form action="{{route('dashboard.paymentmethods.update', $paymentmethod) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $paymentmethod->name }}" required autofocus placeholder="Ingresa el Nombres de la Moneda">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">Estado de la Moneda</label>
                <div class="col-md-6">
                    <select name="status" class="custom-select" id="status" required autofocus>
                        <option value="" selected>Escoge una opción</option>
                        <option {{ $paymentmethod->status == 'active' ? 'selected' : ''}} value="active">Activo</option>
                        <option {{ $paymentmethod->status == 'inactive' ? 'selected' : ''}} value="inactive">No Activo</option>
                    </select>  
                </div>              
            </div>    

            <div class="form-group row">
                <label for="button" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-success btn-lg" value="Editar">
                </div>
                <div class="col-md-2">
                    <a href="{{route('dashboard.paymentmethods.index')}}" class="btn btn-danger btn-lg">Cancelar</a>
                </div>
            </div>           
        </form>
    </div>
</div>
@endsection