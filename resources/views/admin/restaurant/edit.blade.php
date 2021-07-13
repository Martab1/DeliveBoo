@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-2">Modifica dati Ristorante</h1>
        <form action="{{route('admin.restaurant.update', $restaurant->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
            <div class="form-group">
                <label for="name">nome</label>
                <input
                    type="text"
                    class="form-control"
                    id="name" name="name"
                    required
                    maxlength="50" 
                    minlength="2"
                    value="{{ old('name', $restaurant->name) }}">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="address">indirizzo</label>
                <input
                    type="text"
                    class="form-control"
                    id="address"
                    name="address"
                    required
                    minlength="8"
                    maxlength='255'
                    value="{{ old('address', $restaurant->address) }}">
            </div>
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="phone_number">numero di telefono</label>
                <input
                    type="tel"
                    class="form-control"
                    id="phone_number"
                    name="phone_number"
                    required
                    minlength='7' 
                    maxlength='15'
                    value="{{old('phone_number', $restaurant->phone_number)}}">
            </div>
            @error('phone_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group mx-2 d-flex flex-wrap">
                @foreach ($tipologies as $tipology)
                    <div class="w-33">
                        <input role="button" type="checkbox" value="{{$tipology->id}}" id="{{$tipology->id}}" name="tipologies[]"
                        @if ($errors->any() && in_array( $tipology->id, old('tipologies'))) checked
                        @elseif($restaurant->tipologies->contains($tipology->id)) checked
                        @endif>
                        <label role="button" for="{{$tipology->id}}">{{$tipology->name}}</label>
                    </div>
                @endforeach
            </div>
            @error('tipologies')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group mx-2">
                <label for="image"></label>
                <input role="button" type="file" id="image" name="image">
            </div>
            
            @if($restaurant->image)
            <div class="w-25 my-5">
                <img class="img-fluid" src="{{ asset('storage/'.$restaurant->image) }}" alt="{{$restaurant->name}}">
            </div>
            @endif
            
            <div class="form-group mx-2">
                <input role="button" type="submit" class="btn btn-primary" value="aggiorna">
            </div>

        </form>
    </div>
@endsection