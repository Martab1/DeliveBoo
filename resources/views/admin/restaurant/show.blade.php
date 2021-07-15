@extends('layouts.app')

@section('content')
    <div class="text-center container">
        <h1 class="my-5">{{ $my_restaurant->name }}</h1>

        <div class="d-flex">

            {{-- INFORMATIONS --}}
            <div class="informations w-50 d-flex flex-column justify-content-center">
                <h3>Proprietario: {{ $user_auth->name }} {{ $user_auth->surname }}</h3>
                <h3>P.iva: {{ $user_auth->vat_number }}</h3>
                <hr>
                <h3>Città: {{ $my_restaurant->address }}</h3>
                <h3>Telefono: {{ $my_restaurant->phone_number }}</h3>
                {{-- TIPOLOGIES --}}
                <div class="tipologies my-4">
                    @foreach ($my_restaurant->tipologies as $my_tipology)
                        <span class="badge badge-info text-white p-2 mb-1">{{ $my_tipology->name }}</span>
                    @endforeach
                </div>
            </div>

            {{-- IMAGE --}}
            <div class="w-50"><img class="img-fluid" 
                @if ($my_restaurant->image)
                src="{{ asset('storage/' . $my_restaurant->image) }}"
                @else
                {{-- src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/No_immagine_disponibile.svg/600px-No_immagine_disponibile.svg.png" --}}
                src="{{asset('no_covers/no_cover_restaurant.png')}}"
                @endif
                    alt="{{ $my_restaurant->name }}">
            </div>

            {{-- BUTTONS --}}
        </div>
        <a class="btn btn-success m-4" href="{{ route('admin.product.index', $my_restaurant->id) }}">guarda i prodotti</a>
        <a class="btn btn-warning m-4" href="{{ route('admin.restaurant.edit', $my_restaurant->id) }}">Modifica
            locale</a>
        <form class="delete-post-form" action=" {{ route('admin.restaurant.destroy', $my_restaurant->id) }}" method="POST">
            @csrf
            @method("DELETE")
            <input class="btn btn-danger" type="submit" value="cancella">
        </form>
    @endsection
