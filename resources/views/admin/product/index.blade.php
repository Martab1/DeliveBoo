@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('deleted') }}</strong>
                L'eliminazione ha avuto successo.
            </div>
        @endif
        <h1>Prodotti</h1>
        <div>
            <a class="btn  mb-4" id="my-btn" href="{{ route('admin.product.create', $restaurant_id) }}">Aggiungi un nuovo prodotto</a>
        </div>
        <a class="btn btn-secondary mb-5" href="{{ route('admin.restaurant.show',  $restaurant_id) }}">Torna indietro</a>
        <div class="d-flex justify-content-start flex-wrap">
            @foreach ($my_products as $product)
                <div class="card mb-3 product-card">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                            <h5 class="card-title text-uppercase">{{ $product->name }}</h5>
                            <p class="card-text my-description mb-0">{{ $product->description }}</p>
                            <p class="card-text  my-0 price"> {{ $product->price }} € </p>
                            <p class="card-text my-0"><small > {{ $product->visibility ?"Disponibile":"Non Disponibile" }} </small></p>
                            <p class="card-text my-0 "><small >Categoria: {{ $product->category->name}} </small></p>
                            </div>
                            <div class=" pt-0 pb-2 card-body d-flex my-0">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning mr-2" id="my-btn">Modifica</a>
                                <form class="delete-post-form card-link"
                                    action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
        
                                    <input type="submit" class="btn btn-danger" id="my-btn" value="Elimina">
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img  class="img-fluid rounded-start"
                            @if ($product->image)
                            src="{{ asset('storage/' . $product->image) }}"
                            @else
                            src="{{asset('img/default.jpg')}}"
                            @endif
                            alt="{{ $product->name }}">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="links">
            {{$my_products->links()}}
        </div>

        <div class=" d-flex justify-content-center up">
            <a class="btn btn-outline-dark" href="#"><i class="fas fa-arrow-up"></i></a>
        </div>
            

    </div>
@endsection
