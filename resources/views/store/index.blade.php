@extends('layouts.app')

@section('title', 'Tienda')

@section('css.store')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css" integrity="sha512-+WF6UMXHki/uCy0vATJzyA9EmAcohIQuwpNz0qEO+5UeE5ibPejMRdFuARSrl1trs3skqie0rY/gNiolfaef5w==" crossorigin="anonymous" />
@endsection

@section('css')
@endsection

@section('content')
<!-- Page Content -->
<div class="container mt-2">
  <div class="row">
    <div class="col-lg-3">
      <h1 class="my-4">Categorías</h1>
      @if(@empty($categories))
      <div class="alert alert-warning">
        La lista de categorías esta vacia
      </div>
      @else
      <div class="list-group">
        <a href="{{ route('store.categories.show', 'all')}}" class="list-group-item">Todos los productos</a>
        @foreach ($categories as $category)
        <a href="{{ route('store.categories.show', $category->name )}}" class="list-group-item">{{ $category->name }}</a>
        @endforeach
      </div>
      @endif
    </div>
    <!-- /.col-lg-3 -->

    
    
    <div class="col-lg-9 mt-5">
      <div class="container-fluid">
        @if (session()->has('success'))
        <div class="alert alert-success mt-4">
          {{ session()->get('success') }}
        </div>
        @endif
        @if (isset($errors) && $errors->any())
        <div class="alert alert-danger mt-4">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>

      {{-- <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div> --}}
      
      <div class="row">
        @if(@empty($products))
        <div class="alert alert-warning">
          La lista de productos esta vacia
        </div>
        @else
        @foreach($products as $product)
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-img-top">
              <a href="{{ route('store.product.show', $product->name)}}"><img class="card-img-top img-responsive" src="{{ asset($product->images->first()->path) }}" alt="" height="300"></a>
            </div>
            <div class="card-body mb-6">
              <h4 class="card-title"><a href="{{ route('store.product.show', $product->name)}}">{{ $product->name}}</a></h4>
              <h5>{{$currencies->find(1)->name}} {{$costs->find($product->cost_id)->cost}}</h5>
              <p class="card-text text-wrap text-truncate">{{$product->description}}</p>
            </div>
            <div class="card-footer d-inline">
              @if ($product->stock < 1)
              Agotado
                  <form action="{{ route('products.carts.store', ['product' => $product->id]) }}" class="d-flex flex-column-reverse" method="POST">
                    @csrf
                    <button type="button" class="btn btn-secondary" disabled>Agotado</button>
                  </form>
              @else
              Stock: {{$product->stock}}              
              <form action="{{ route('products.carts.store', ['product' => $product->id]) }}" class="d-flex flex-column-reverse" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Agregar a Carrito</button>
              </form>
              @endif

            </div>
          </div>
        </div>
        @endforeach
        @endif
      </div>
      <!-- /.row -->
      {{ $products->links() }}
    </div>
    <!-- /.col-lg-9 -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container -->
@endsection