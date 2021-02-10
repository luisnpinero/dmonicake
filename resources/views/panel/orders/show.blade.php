@extends('layouts.dashboard')

@section('title','Ver Ordenes')

@section('title-page','Ordenes')

@section('subtitle-page')
Vista de orden
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
@endsection

@section('content')
<div class=container-fluid>
    <div class="card mb-4">
        <div class="card-header">
            Orden: <b>{{ $order->id }}</b>
        </div>

        <div class="card-body">
            @csrf
            <!--Section: Block Content-->

            {{-- fotos del producto --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>ID</strong></th>
                                    <td>{{ $order->id }}</td>
                                </tr>
                                
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Descripción</strong></th>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                </tr>
                                
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Total</strong></th>
                                    <td>{{ $order->total }}</td>
                                </tr>

                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Creada</strong></th>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                                
                                <tr>
                                    <th class="pl-0 w-25"><strong>Estado</strong></th>
                                    <td>{{ $order->status }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            Productos
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="dataTable" width="99%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($order->products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $categories->find($product->category_id)->name }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>{{ $currencies->find($costs->find($product->cost_id)->currency_id)->name}} {{ $costs->find($product->cost_id)->cost}}</td>
                            <td>{{ $currencies->find($costs->find($product->cost_id)->currency_id)->name }} {{$product->total}}</td>
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