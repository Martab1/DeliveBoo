@extends('layouts.app')

@section('content')
    <div class="text-center container show">
        <h1 class="my-5 text-uppercase">{{ $my_restaurant->name }}</h1>

        <div class="d-flex container r-column">

              {{-- IMAGE --}}
              <div class="container-img"><img class="content-img" 
                @if ($my_restaurant->image)
                src="{{ asset('storage/' . $my_restaurant->image) }}"
                @else
                src="{{asset('img/default.jpg')}}"
                @endif
                    alt="{{ $my_restaurant->name }}">
             </div>

            {{-- INFORMATIONS --}}
            <div class="informations d-flex flex-column justify-content-center  text-left">
                <h3>Proprietario: {{ $user_auth->name }} {{ $user_auth->surname }}</h3>
                <h3>P.iva: {{ $user_auth->vat_number }}</h3>
                <hr>
                <h3>Città: <span class="text-capitalize">{{ $my_restaurant->address }} </span> </h3>
                <h3>Telefono: {{ $my_restaurant->phone_number }}</h3>
                {{-- TIPOLOGIES --}}
                <div class="tipologies my-4">
                    @foreach ($my_restaurant->tipologies as $my_tipology)
                        <span class=" badge bg-secondary text-white p-2 mb-1">{{ $my_tipology->name }}</span>
                    @endforeach
                </div>
            </div>

          
        </div>
        {{-- BUTTONS --}}
        <div class="m-4 d-flex justify-content-center">
                <a class="btn btn-primary m-3 " id="my-btn" href="{{ route('admin.product.index', $my_restaurant->id) }}">Guarda i prodotti</a>
                <a class="btn btn-warning m-3" id="my-btn" href="{{ route('admin.restaurant.edit', $my_restaurant->id) }}">Modifica
                    locale</a>
                <a class="btn btn-success m-3" id="my-btn" href="{{ route('admin.restaurant.orders', $my_restaurant->id) }}">I tuoi ordini</a>
            <form class="delete-post-form" action=" {{ route('admin.restaurant.destroy', $my_restaurant->id) }}" method="POST">
                @csrf
                @method("DELETE")
                <input class="btn btn-danger m-3" id="my-btn" type="submit" value="Cancella ristorante">
            </form>
        </div>
        <div class="d-flex justify-content-center">
            <a class="btn btn-secondary" href="{{ route('admin.home') }}">Torna indietro</a>
        </div>
    </div>
@endsection
