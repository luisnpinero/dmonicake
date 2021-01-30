@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endsection

@section('title','Productos')

@section('title-page','Productos')

@section('subtitle-page','Módulo de Gestión de Productos')

@section('content')

<div class="card mb-4">

<div class="card-body">

    <div class="d-flex flex-row-reverse pb-4">
        <a href="#" class="btn btn-primary">Nuevo <i class="fas fa-plus"></i></a>
    </div>

    <div class="table-responsive table-hover">
        <table class="table table-bordered table-striped" id="dataTable" width="99%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
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
                    <th>Categoría</th>
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
                        <td>{{ $categories->find($product->category_id)->name }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->id}}</td>
                        <td>{{ $product->status}}</td>
                        <td>{{ $product->updated_at}}</td>
                        <td><div class="d-flex justify-content-around">
                            <a href="#" title="Ver"><i class="fas fa-eye fas-icon-purple"></i></a>  
                            <a href="#" title="Editar"><i class="fas fa-edit fas-icon-purple"></i></a> 

                            @if( $product->status == 'active' ) 
                                <a href="#" title="Deshabilitar"><i class="fas fa-toggle-off text-danger"></i></a>
                            @else
                                <a href="#" title="Habilitar"><i class="fas fa-toggle-on text-success"></i></a>
                            @endif
                            <a href="#" title="Eliminar"><i class="fas fa-trash-alt fas-icon-purple"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach                    
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection

@section('scripts')
  
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>  
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable();
        });
    </script>  
@endsection