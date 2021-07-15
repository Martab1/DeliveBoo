@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('deleted') }}</strong>
                L'eliminazione ha avuto successo.
            </div>
        @endif
        @if ($my_restaurants)
            <h1>Le tue attività</h1>
            <a class="mb-3 btn btn-primary" href="{{ route('admin.restaurant.create') }}">Registra una nuova attività</a>

            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Città</th>
                        <th>Numero di telefono</th>
                        <th>Tipologia</th>
                        <th colspan="3">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($my_restaurants as $restaurant)
                        <tr>
                            <th scope="row">{{ $restaurant->name }}</th>
                            <td>{{ $restaurant->address }}</td>
                            <td>{{ $restaurant->phone_number }}</td>
                            <td>
                                @foreach ($restaurant->tipologies as $tipology)
                                    {{ $tipology->name }} @if(!$loop->last) - @endif
                                @endforeach
                            </td>
                            <td><a class="btn btn-primary" href="{{route('admin.restaurant.show', $restaurant->id)}}">Mostra</a></td>
                            <td><a class="btn btn-warning" href="{{route('admin.restaurant.edit', $restaurant->id)}}">Modifica</a></td>
                            <td>
                                <form class="delete-post-form" method="POST" action="{{route('admin.restaurant.destroy', $restaurant->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" value="Cancella" type="submit">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- IF USER DOESN'T HAVE A RESTAURANT --}}
        @else
            <h1 class="text-center my-4">Benvenuto</h1>
            <div class="text-center">
                <h2 class="my-4">Registra subito la tua attività</h2>
                <a class="btn btn-primary" href="{{ route('admin.restaurant.create') }}">Registra</a>
            </div>
        @endif

    </div>
@endsection
