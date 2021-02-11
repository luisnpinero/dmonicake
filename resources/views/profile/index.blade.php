@extends('layouts.app')

@section('title','Perfil')

@section('content')
<div class="container mt-5">
    <div class="container-fluid">
        @if (session()->has('success'))
        <div class="alert alert-success mt-4">
            {{ session()->get('success') }}
        </div>
        @endif
        @if (isset($errors) && $errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="card mb-4 mt-5">
        <div class="card-body">
            @csrf
            <!--Section: Block Content-->
            {{-- fotos del usuario --}}
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card mb-4">
                        <div class="card body">
                            <img class="card-img-top img-fluid" src="{{ asset(Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}">
                            @dump(Auth::user()->profile_image)
                        </div>
                        <div class="card-footer">
                            <strong>Foto de Perfil</strong>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Nombres</strong></th>
                                    <td>{{ $user->first_name }}</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Apellidos</strong></th>
                                    <td>{{ $user->last_name }}</td>
                                </tr>
                                
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Número de Teléfono</strong></th>
                                    <td>{{ $user->phone_number }}</td>
                                </tr>

                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Emai</strong></th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Dirección</strong></th>
                                    <td>{{ $address->address }}, {{ $address->postal_code }}, {{ $address->city }}, {{ $address->province }}, {{ $address->country }}.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="d-flex flex-row-reverse pb-4">
        <a href="{{route('profile.edit',$user->id)}}" class="btn btn-primary">Editar <i class="fas fa-edit"></i></a>
    </div>
</div>
@endsection