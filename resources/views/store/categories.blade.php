@extends('layouts.app')
@section('title')
{{ $category->name}}
@endsection

@section('css.store')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css" integrity="sha512-+WF6UMXHki/uCy0vATJzyA9EmAcohIQuwpNz0qEO+5UeE5ibPejMRdFuARSrl1trs3skqie0rY/gNiolfaef5w==" crossorigin="anonymous" />
@endsection

@section('content')
<!-- Page Content -->
<div class="container mt-5">
  <div class="row">
    <div class="col-lg-3">
      <h1 class="my-4">{{ $category->name }}</h1>
      @empty($category)
      <div class="alert alert-warning">
        La lista de categorías esta vacia
      </div>
      @else
      <div class="list-group">
        <a href="{{ route('store.index')}}" class="list-group-item">Mostrar Todos los productos</a>
        <a href="{{ route('store.categories.show', $category->name)}}" class="list-group-item">{{ $category->name }}</a>
        @endempty
      </div>
    </div>
    <!-- /.col-lg-3 -->
    
    <div class="col-lg-9">
      <div class="row">
        @if(@empty($products))
        <div class="alert alert-warning">
          La lista de productos esta vacia
        </div>
        @else
        @foreach($products as $product)
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
              @if ($product->images->first()!=null)
              <a href="{{ route('store.product.show', $product->name)}}"><img class="card-img-top img-responsive" src="{{ asset($product->images->first()->path) }}" alt="" height="300"></a>
              @else
              <a href="{{ route('store.product.show', $product->name)}}"><img class="card-img-top img-responsive" src="" alt="" height="300"></a>
              @endif
            <div class="card-body mb-6">
              <h4 class="card-title">
                <a href="{{ route('store.product.show', $product->name)}}">{{ $product->name}}</a>
              </h4>
              <h5>{{$currencies->find(1)->name}} {{$costs->find($product->cost_id)->cost}}</h5>
              {{-- corregir aqui --}}
              <p class="card-text text-wrap text-truncate">{{$product->description}}</p>
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
        @endforeach
        @endif
      </div>
      {{ $products->links() }}
      <!-- /.row -->
    </div>
  </div>
</div>
@endsection