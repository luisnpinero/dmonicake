@extends('layouts.dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endsection

@section('title','Monedas')

@section('title-page','Monedas')

@section('subtitle-page','Módulo de Gestión de Monedas')

@section('content')

<div class="card mb-4">

<div class="card-body">

    <div class="d-flex flex-row-reverse pb-4">
        <a href="{{route('dashboard.currencies.create')}}" class="btn btn-primary">Nuevo <i class="fas fa-plus"></i></a>
    </div>

    <div class="table-responsive table-hover">
        <table class="table table-bordered table-striped" id="dataTable" width="99%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($currencies as $currency)
                    <tr>
                        <td>{{ $currency->id }}</td>
                        <td>{{ $currency->name }}</td>
                        <td>{{ $currency->status}}</td>
                        <td>{{ $currency->created_at}}</td>
                        <td>{{ $currency->updated_at}}</td>
                        <td><div class="d-flex justify-content-around">
                            <button class="btn btn-sm px-0 mx-0">
                                <a href="{{ route('dashboard.currencies.show', $currency->id) }}" title="Ver"><i class="fas fa-eye fas-icon-purple"></i></a> 
                            </button>
                            
                            <button class="btn btn-sm px-0 mx-0">
                                <a href="{{route('dashboard.currencies.edit',$currency->id)}}" title="Editar"><i class="fas fa-edit fas-icon-purple"></i></a> 
                            </button>

                            <form action="{{ route('dashboard.currencies.update.status', $currency) }}" method="post">
                                @csrf
                                @method('put')
                                
                                @if( $currency->status == 'active' )
                                <button class="btn btn-sm px-0 mx-0" name="status" title="Deshabilitar" value="inactive">
                                    <i class="fas fa-toggle-on text-success"></i>
                                </button>
                                @else
                                <button class="btn btn-sm px-0 mx-0" name="status" value="active" title="Habilitar">
                                    <i class="fas fa-toggle-off text-danger"></i>
                                </button> 
                                @endif
                            </form>

                            <form action="{{ route('dashboard.currencies.delete',$currency)}}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-sm px-0 mx-0" name="is_deleted" title="Borrar" value=1>
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </button>                             
                            </form>

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