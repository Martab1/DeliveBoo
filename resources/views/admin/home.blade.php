@extends('layouts.app')

@section('content')
<div class="container">

    {{-- IF USER HAS A RESTAURANT --}}
    @if ($my_restaurant)
        <div class="text-center">
            <h1 class="my-5">{{$my_restaurant->name}}</h1>

            <div class="d-flex">

                {{-- INFORMATIONS --}}
                <div class="informations w-50 d-flex flex-column justify-content-center">
                    <h3>proprietario: {{$user_auth->name}} {{$user_auth->surname}}</h3>
                    <h3>p.iva: {{$user_auth->vat_number}}</h3>
                    <hr>
                    <h3>città: {{$my_restaurant->address}}</h3>
                    <h3>numero di telefono: {{$my_restaurant->phone_number}}</h3>
                        {{-- TIPOLOGIES --}}
                    <div class="tipologies my-4">
                        @foreach ($my_tipologies as $my_tipology)
                        <span class="badge badge-info text-white p-2 mb-1">{{$my_tipology->name}}</span>
                        @endforeach
                    </div>
                </div>

                {{-- IMAGE --}}
                <div class="w-50"><img class="img-fluid" src="{{asset('storage/' . $my_restaurant->image)}}" alt="{{$my_restaurant->name}}"></div>
            </div>

            {{-- BUTTONS --}}
            <a class="btn btn-success m-4"href="{{route("admin.product.index")}}">guarda i prodotti</a>
            <a class="btn btn-warning m-4"href="{{route("admin.restaurant.edit", $my_restaurant->id)}}">Modifica locale</a>
            <form action=" {{ route('admin.restaurant.destroy', $my_restaurant->id)}}" method="POST">
                @csrf
                @method("DELETE")
                <input  class="btn btn-danger" type="submit" value="cancella">


            </form>
        </div>

    {{-- IF USER DOESN'T HAVE A RESTAURANT --}}
    @else
    <h1 class="text-center my-4">Benvenuto</h1>
        <div class="text-center">
            <h2 class="my-4">Registra subito la tua attività</h2>
            <a class="btn btn-primary"
            href="{{route("admin.restaurant.create")}}"
            >Registra</a>
        </div>
    @endif

</div>
@endsection
