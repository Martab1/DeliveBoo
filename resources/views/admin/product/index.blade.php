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
            <a class="btn btn-primary mb-4" id="my-btn" href="{{ route('admin.product.create', $restaurant_id) }}">Aggiungi un nuovo prodotto</a>
        </div>
        <a class="btn btn-secondary mb-5" href="{{ route('admin.restaurant.show',  $restaurant_id) }}">Torna indietro</a>
        <div class="d-flex flex-wrap">
            @foreach ($my_products as $product)
                <div class="card" id="my-card">
                    <div style="height: 12rem">
                        <img class="my-img"
                        @if ($product->image)
                        src="{{ asset('storage/' . $product->image) }}"
                        @else
                        src="{{asset('no_covers/no_cover_product.png')}}"
                        @endif
                        alt="{{ $product->name }}">
                    </div>
                    <ul class="list-group-flush list-group">
                        <h5 class=" py-2 my-description list-group-item">{{ $product->name }}</h5>
                        <p class="list-group-item card-text my-description h-90 py-1">{{ $product->description }}</p>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $product->price }} € </li>
                        <li class="list-group-item">Disponibile: {{ $product->visibility ?"si":"no" }}</li>
                        <li class="list-group-item">Categoria: {{ $product->category->name}}</li>
                    </ul>
                    <div class="card-body d-flex d-flex justify-content-between">
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning" id="my-btn">Modifica</a>
                        <form class="delete-post-form card-link"
                            action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" class="btn btn-danger" id="my-btn" value="Elimina">
                        </form>
                    </div>
                </div>
            @endforeach
        </div>


        <div class=" d-flex justify-content-center up">
            <a class="btn btn-outline-dark" href="#"><i class="fas fa-arrow-up"></i></a>
        </div>
            

    </div>
@endsection
