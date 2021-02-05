@extends('layouts.dashboard')

@section('title','Ver Categoria')

@section('title-page','Categoria')

@section('subtitle-page')

@endsection

@section('content')
<div class=container-fluid>
    <div class="card mb-4">
        <div class="card-header">
            Categoria: <b>{{ $category->name }}</b>
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
                                <td>{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <th class="pl-0 w-25" scope="row"><strong>Estado</strong></th>
                                <td>{{ $category->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row-reverse pb-4">
        <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-primary">Editar <i class="fas fa-edit"></i></a>
    </div>
</div>


@endsection