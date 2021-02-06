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
                        <td>
                            <div class="d-flex justify-content-around">
                                <button class="btn btn-sm px-0 mx-0">
                                    <a href="{{ route('dashboard.orders.show', $order->id) }}" title="Ver"><i class="fas fa-eye fas-icon-purple"></i></a>
                                </button>
                                
                                <form action="{{ route('dashboard.orders.update.status', $order) }}" method="post">
                                    @csrf
                                    @method('put')
                                    
                                    @if( $order->status == 'payed' )
                                    <button class="btn btn-sm px-0 mx-0" name="status" value="pending">
                                        <i class="fas fa-toggle-on text-success"></i>
                                    </button>
                                    @else
                                    <button class="btn btn-sm px-0 mx-0" name="status" value="payed">
                                        <i class="fas fa-toggle-off text-danger"></i>
                                    </button>
                                    @endif
                                </form>
                                
                                <form action="{{ route('dashboard.orders.delete',$order)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-sm px-0 mx-0" name="is_deleted" value=1>
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