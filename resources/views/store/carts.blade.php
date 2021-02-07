@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
<div class="container mt-4">
    <h3 class="my-4">Tu Carrito</h3>
    <div class="mb-4 mt-4">
        <div class="card-body">
            <h4>Tus Productos</h4>
            <div class="row">
                <div class="col-lg-7 col-xs-12 mr-4">
                    <div class="row">
                        @if(!isset($cart) || $cart->products->isEmpty())
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
                                                <tr>
                                                    <th class="pl-0 w-25" scope="row"><strong>Subtotal</strong></th>
                                                    <td>{{ $product->total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <form method="POST" class="" action="{{ route('products.carts.destroy', ['cart'=> $cart->id, 'product' => $product->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endempty
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="row">
                        @if(!isset($cart) || $cart->products->isEmpty())
                        @else
                        <div class="card col-12 my-2">
                            <div class="table-responsive">
                                <div class="col-lg-12 colx-xs-2 py-4">
                                    <h3>Total Compra:</h3>
                                    <h2 class="text-right"><strong>{{ $currencies->find($costs->find($product->cost_id)->currency_id)->name }} {{$cart->total}}</strong></h2>
                                </div>
                                <div class="col-lg-12 colx-xs-2 py-4 text-right">
                                    <a href="{{ route('store.orders.create') }}" class="btn btn-primary ">Realizar Compra</a>
                                </div>
                            </div>
                        </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection