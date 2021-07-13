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
        <a class="btn btn-primary" href="{{ route('admin.product.create') }}">Aggiungi un nuovo prodotto</a>

        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Prezzo</th>
                    <th>Descrizione</th>
                    <th>Disponibile</th>
                    <th>Immagine</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($my_products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>

                        <td>{{ $product->price }}</td>

                        <td>{{ $product->description }}</td>

                        <td>{{ $product->visibility }}</td>

                        <td>{{ $product->image }}</td>

                        <td>
                            <div>{{ $product->created_at->format('d/m/y') }}</div>
                        </td>

                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.product.edit', $product->id) }}">
                                Modifica
                            </a>
                        </td>
                        <td>
                            <form class="delete-post-form" action="{{ route('admin.product.destroy', $product->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <input type="submit" class="btn btn-danger" value="Elimina">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
