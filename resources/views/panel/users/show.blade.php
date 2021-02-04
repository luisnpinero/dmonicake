@extends('layouts.dashboard')

@section('title','Ver Usuarios')

@section('title-page','Usuarios')

@section('subtitle-page')

@endsection

@section('content')
<div class=container-fluid>
    <div class="card mb-4">
        <div class="card-header">
            Usuario: <b>{{ $user->first_name }}</b>
        </div>
        
        <div class="card-body">
            @csrf
            <!--Section: Block Content-->
            {{-- fotos del usuario --}}
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card mb-4">
                        <div class="card body">
                            <img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">
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
                                
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Rol</strong></th>
                                    <td>{{ $roles->find($user->role_id)->name }}</td>
                                </tr>
                                
                                <tr>
                                    <th class="pl-0 w-25"><strong>Creado</strong></th>
                                    <td>{{ $user->created_at }} </td>
                                </tr>
                                
                                <tr>
                                    <th class="pl-0 w-25"><strong>Actualizado</strong></th>
                                    <td>{{ $user->updated_at }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="d-flex flex-row-reverse pb-4">
        <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-primary">Editar <i class="fas fa-edit"></i></a>
    </div>
</div>
@endsection