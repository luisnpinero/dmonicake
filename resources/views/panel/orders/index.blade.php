@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endsection

@section('title','Órdenes')

@section('title-page','Órdenes')

@section('subtitle-page','Módulo de Gestión de Órdenes')

@section('content')

<div class="card mb-4">

<div class="card-body">

    <div class="table-responsive table-hover">
        <table class="table table-bordered table-striped" id="dataTable" width="99%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $users->find($order->user_id)->first_name }} {{ $users->find($order->user_id)->last_name }}</td>
                        <td>{{ $currencies->find(1)->name }} {{$order->total}}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->status}}</td>
                        <td><div class="d-flex justify-content-around">
                            <a href="#" title="Ver"><i class="fas fa-eye fas-icon-purple"></i></a>  
                            @if( $order->status == 'active' ) 
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