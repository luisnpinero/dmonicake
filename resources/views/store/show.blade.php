@extends('layouts.app')

@section('title')
{{$product->name}}
@endsection

@section('content')
<!-- Page Content -->
<div class="container mt-5">
  <div class="row">
    <div class="col-lg-3">
      <h1 class="my-4">{{$product->name}}</h1>
      <div class="list-group">
              <form action="{{ route('products.carts.store', ['product' => $product->id]) }}" class="d-flex flex-column-reverse" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Agregar a Carrito</button>
              </form>
      </div>
    </div>
    <!-- /.col-lg-3 -->
    <div class="col-lg-9">
      @if (session()->has('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
      @endif

      <div class="card mt-4">
        <div id="carousel-show" class="carousel slide carousel-slide">
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
        <div class="card-body">
          <h3 class="card-title">{{$product->name}}</h3>
          <h4>{{$currency->find(1)->name}} {{$cost->find($product->cost_id)->cost}}</h4>
          <p class="card-text">{{ $product->description}}</p>
        </div>
        <div class="card-footer">
          @if ($product->stock < 1)
          AGOTADO
          @else
          Stock: {{$product->stock}}
          @endif
        </div>
      </div>
    </div>
    <!-- /.col-lg-9 -->
  </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection
