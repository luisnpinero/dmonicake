@extends('layouts.dashboard')

@section('title','Ver Productos')

@section('title-page','Productos')

@section('subtitle-page')

@endsection

@section('content')
<div class=container-fluid>
    <div class="card mb-4">
        <div class="card-header">
            Producto: <b>{{ $product->name }}</b>
        </div>
        
        <div class="card-body">
            @csrf
            {{-- fotos del producto --}}
            <div class="row">
                <div id="carousel-show" class="carousel slide carousel-slide col-md-4">
                    <div class="carousel-inner">
                        @foreach ($product->images as $image)
                        <div class="carousel-item {{ $loop->first ? 'active': ''}}">
                            <img class="d-block w-100 card-img-top" src="{{asset($image->path)}}" alt="">
                        </div>
                        @endforeach
                        <a class="carousel-control-prev" href="#carousel-show" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-show" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Nombre</strong></th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Descripción</strong></th>
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Stock</strong></th>
                                    <td>{{ $product->stock }}</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Costo</strong></th>
                                    <td>{{ $currency->name }} {{ $cost->cost }}</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25"><strong>Categoría</strong></th>
                                    <td>{{ $category->name }} </td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25"><strong>Estado</strong></th>
                                    <td>{{ $product->status }} </td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25"><strong>Creado</strong></th>
                                    <td>{{ $product->created_at }} </td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25"><strong>Actualizado</strong></th>
                                    <td>{{ $product->updated_at }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row-reverse pb-4">
        <a href="{{route('dashboard.products.edit',$product)}}" class="btn btn-primary">Editar <i class="fas fa-edit"></i></a>
    </div>
</div>
@endsection