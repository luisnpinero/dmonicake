@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
<div class="container mt-4">
    <h3 class="my-4">Tu Carrito</h3>
    <div class="mb-4 mt-4">
        <div class="card-body">
            <h4>Tus Productos</h4>
            <div class="row">
                <div class="col-lg-8 col-xs-12">
                    <div class="row">
                        @if (!isset($cart) || $cart->products->isEmpty())
                        <div class="alert alert-warning">Tu carrito está vacio.</div>
                        @else
                        @foreach ($cart->products as $product)
                        <div class="card col-12 my-2">
                            <div class="row">
                                <div class="col-lg-4 colx-xs-2 py-4">
                                    <img class="card-img-top img-responsife" src="{{ asset($product->images->first()->path) }}" alt="" height="200">
                                </div>
                                <div class="col-lg-8 colx-xs-2 py-4">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="pl-0 w-25" scope="row"><strong>Nombre</strong></th>
                                                    <td>{{ $product->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-0 w-25" scope="row"><strong>Costo</strong></th>
                                                    <td>{{ $currencies->find($costs->find($product->cost_id)->currency_id)->name }} {{ $costs->find($product->cost_id)->cost }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="pl-0 w-25" scope="row"><strong>Candidad</strong></th>
                                                    <td>{{ $product->pivot->quantity }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <form action="">
                                        <button class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endempty
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-md-12 col-xs-12">
                    <div class="card-body">
                        Aqui va el total y el iniciar orden
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection