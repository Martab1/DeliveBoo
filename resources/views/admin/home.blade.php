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
                    <h3>address: {{$my_restaurant->address}}</h3>
                    <h4>phone number: {{$my_restaurant->phone_number}}</h4>
                </div>
                {{-- IMAGE --}}
                <div class="w-50"><img class="img-fluid" src="{{$my_restaurant->image}}" alt="{{$my_restaurant->name}}"></div>
            </div>

            {{-- TIPOLOGIES --}}

            {{-- EDIT --}}
            <a class="btn btn-success m-4"href="">i tuoi prodotti</a>
            <a class="btn btn-warning m-4"href="">Modifica dati</a>
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
