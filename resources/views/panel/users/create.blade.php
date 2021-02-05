@extends('layouts.dashboard')

@section('title','Usuarios')

@section('title-page','Usuarios')

@section('subtitle-page','Crear nuevo usuario')

@section('content')
<div class="container card">
    <div class="card-body">
        <form action="{{route('dashboard.users.store')}}" method="post">
            @csrf

            <div class="form-group row">
                <label for="first_name" class="col-md-4 col-form-label text-md-right">Nombres</label>
                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="" required autofocus placeholder="Ingresa los Nombres del usuario">
                </div>
            </div>

            <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">Apellidos</label>
                <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="" required autofocus placeholder="Ingresa los Apellidos del usuario">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">Número de Teléfono</label>
                <div class="col-md-6">
                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="" required autofocus placeholder="Ingresa el Número Telefónico del usuario">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required placeholder="Ingresa el Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Dirección</label>
                <div class="col-md-6">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="" required autofocus placeholder="Ingresa la dirección del usuario">
                </div>
            </div>

            <div class="form-group row">
                <label for="city" class="col-md-4 col-form-label text-md-right">Ciudad</label>
                <div class="col-md-6">
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="" required autofocus placeholder="Ingresa la ciudad">
                </div>
            </div>

            <div class="form-group row">
                <label for="province" class="col-md-4 col-form-label text-md-right">Estado o Provincia</label>
                <div class="col-md-6">
                    <input id="province" type="text" class="form-control @error('province') is-invalid @enderror" name="province" value="" required autofocus placeholder="Ingresa el Estado o Provincia">
                </div>
            </div>

            <div class="form-group row">
                <label for="country" class="col-md-4 col-form-label text-md-right">País</label>
                <div class="col-md-6">
                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="" required autofocus placeholder="Ingresa el País">
                </div>
            </div>

            <div class="form-group row">
                <label for="postal_code" class="col-md-4 col-form-label text-md-right">Código Postal</label>
                <div class="col-md-6">
                    <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="" required autofocus placeholder="Ingresa el Código Postal">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Ingresa la contraseña">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="role_id" class="col-md-4 col-form-label text-md-right">Rol</label>
                <div class="col-md-6">
                    <select name="role_id" class="custom-select" id="role_id" required autofocus>
                        <option value="" selected disabled>Escoge una opción</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">Estado del Usuario</label>
                <div class="col-md-6">
                    <select name="status" class="custom-select" id="status" required autofocus>
                        <option value="" selected disabled>Escoge una opción</option>
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
                    <a href="{{route('dashboard.users.index')}}" class="btn btn-danger btn-lg">Cancelar</a>
                </div>
            </div>           
        </form>
    </div>
</div>
@endsection