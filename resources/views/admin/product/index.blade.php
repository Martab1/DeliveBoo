@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('deleted') }}</strong>
                L'eliminazione ha avuto successo.
            </div>
        @endif
    </div>
    <div class="container">
        <h1>Prodotti</h1>
        <a class="btn btn-primary mb-4" href="{{ route('admin.product.create', $restaurant_id) }}">Aggiungi un nuovo prodotto</a>

        <div class="d-flex flex-wrap">
            @foreach ($my_products as $product)
                <div class="card m-3" style="width: 15rem;">
                    <div style="height: 12rem">
                        <img class="my-img"
                        @if ($product->image)
                        src="{{ asset('storage/' . $product->image) }}"
                        @else
                        src="{{asset('no_covers/no_cover_product.png')}}"
                        @endif
                        alt="{{ $product->name }}">
                    </div>
                    <div class="card-body">
                        <h5 class="">{{ $product->name }}</h5>
                        <p class="card-text my-description">{{ $product->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $product->price }}</li>
                        <li class="list-group-item">Disponibile: {{ $product->visibility ?"si":"no" }}</li>
                    </ul>
                    <div class="card-body d-flex d-flex justify-content-between">
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning">Modifica</a>
                        <form class="delete-post-form card-link"
                            action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" class="btn btn-danger" value="Elimina">
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
