@extends('layouts.dashboard')

@section('css')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
@endsection

@section('title','Productos')

@section('title-page','Productos')

@section('subtitle-page','Módulo de Gestión de Productos')

@section('content')

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        DataTable Example
    </div>

<div class="card-body">

    <div class="d-flex flex-row-reverse pb-4">
        <a href="#" class="btn btn-primary">Nuevo <i class="fas fa-plus"></i></a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Modificado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Modificado</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->id}}</td>
                        <td>{{ $product->status}}</td>
                        <td>{{ $product->updated_at}}</td>
                        <td>Si no no sabe</td>
                    </tr>
                @endforeach                    
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/datatables-demo.js')}}"></script>
@endsection