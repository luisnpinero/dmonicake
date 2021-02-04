@extends('layouts.dashboard')

@section('title','Ver Roles')

@section('title-page','Roles')

@section('subtitle-page')

@endsection

@section('content')
<div class=container-fluid>
    <div class="card mb-4">
        <div class="card-header">
            Rol: <b>{{ $role->name }}</b>
        </div>
        <div class="card-body">
            @csrf
            <!--Section: Block Content-->
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th class="pl-0 w-25" scope="row"><strong>Nombre</strong></th>
                                <td>{{ $role->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row-reverse pb-4">
        <a href="{{route('dashboard.roles.edit',$role->id)}}" class="btn btn-primary">Editar <i class="fas fa-edit"></i></a>
    </div>
</div>
@endsection