@extends('layouts.app')

@section('content')
    <!-- Header -->
  <header class="bg-primary py-2 mb-5">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12">
          <h1 class="display-4 text-dark mt-5 mb-2">DMonicake Cocina Fit & Fat</h1>
          <p class="lead mb-5 text-dark-50">¡No dejes para mañana lo que puedes cocinar hoy!</p>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-5">

        <div class="container-fluid">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        
        <form action="{{route('contact.store')}}" method="post">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nombres</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autofocus placeholder="Ingresa tu nombre de contacto">
                </div>
            </div>

            <div class="form-group row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">Número de Teléfono</label>
                <div class="col-md-6">
                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="" required autofocus placeholder="Ingresa el Número Telefónico de contacto">
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
                <label for="message" class="col-md-4 col-form-label text-md-right">Descripción del Producto</label>
                <div class="col-md-6">
                    <textarea id="message" type="text" class="form-control @error('description') is-invalid @enderror" name="message" value="" required autofocus placeholder="¿En qué podemos ayudarte?" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="button" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-4">
                    <input type="submit" class="btn btn-success btn-lg" value="Crear">
                </div>
            </div>           
        </form>
      </div>
    </div>

@endsection