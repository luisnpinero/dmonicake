@extends('layouts.app')

@section('title', 'Finalizando Orden')

@section('content')
<div class="container mt-4">
    <h3 class="my-4">Resumen de orden</h3>
    <div class="mb-4 mt-4">
        <div class="card-body">
            <h4>Tus Productos</h4>
            <div class="row">
                <div class="col-lg-8 col-xs-12 mr-3">
                    <div class="row">
                        @if(!isset($cart) || $cart->products->isEmpty())
                        <div class="alert alert-warning">Tu carrito está vacio.</div>
                        @else
                        <div class="card col-12 my-2">
                            <div class="table-responsive">
                                <div class="col-lg-12 colx-xs-2 py-4">
                                    <table class="table table-borderless table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Acciones</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        @foreach ($cart->products as $product)
                                        <tbody>
                                            <th><img class="card" src="{{ asset($product->images->first()->path) }}" width="50"></th>
                                            <th>{{ $product->name }}</th>
                                            <th>{{ $product->pivot->quantity }}</th>
                                            <th>{{ $currencies->find($costs->find($product->cost_id)->currency_id)->name }} {{ $costs->find($product->cost_id)->cost }}</th>
                                            <th>+ - x</th>
                                            <th>{{ $currencies->find($costs->find($product->cost_id)->currency_id)->name }} {{$product->total}}</th>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endempty
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12">
                    <div class="row">
                        @if(!isset($cart) || $cart->products->isEmpty())
                        @else
                        <div class="card col-12 my-2">
                            <div class="table-responsive">
                                <form action="{{ route('store.orders.store') }}" method="POST">
                                <div class="col-lg-12 colx-xs-2 py-4">
                                    <h3>Total Compra:</h3>
                                    <h2 class="text-right"><strong>{{ $currencies->find($costs->find($product->cost_id)->currency_id)->name }} {{$cart->total}}</strong></h2>
                                </div>
                                <div class="col-lg-12 colx-xs-2 py-4 text-right">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name" class="">Metodo de pago</label>
                                            <select name="payment_method_id" class="custom-select" id="payment_method_id" required autofocus>
                                                <option value="" selected disabled>Escoge una opción</option>
                                                @foreach ($paymentmethods as $paymentmethod)
                                                <option {{ old('payment_method_id') == '$paymentmethod->id' ? 'selected' : ''}} value="{{$paymentmethod->id}}">{{$paymentmethod->name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="number" hidden name="total" value="{{$cart->total}}">
                                        </div>
                                        <button class="btn btn-primary" type="submit">Finalizar</button>
                                    </form>
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