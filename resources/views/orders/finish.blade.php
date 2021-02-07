@extends('layouts.app')

@section('title', 'Finalizando Orden')

@section('content')
<div class="container mt-4">
    <h3 class="my-4">Finalizar Orden</h3>
    <div class="mb-4 mt-4">
        <div class="card-body">
            <div class="row">
                <div class="card col-12 my-2">
                    @if (session()->has('success'))
                    <div class="row justify-content-center">
                        <div class="mx-4 my-4">
                            <i class="far fa-8x fa-check-circle text-success"></i>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="mx-4 my-4 text-center">
                            <h3>{{ session()->get('success') }}</h3>
                            <p>Pronto uno de nuestros administradores validará la informacion de pago</p>
                            <div class="mx-4 my-4 text-center">
                                <a href="{{ route('store.index')}}" class="btn btn-primary">Volver a Tienda</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection