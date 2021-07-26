@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-2">Modifica dati Ristorante</h1>
        <form action="{{route('admin.restaurant.update', $restaurant->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
            <div class="form-group">
                <label for="name">Nome*</label>
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name"
                    required
                    maxlength="50" 
                    minlength="2"
                    value="{{ old('name', $restaurant->name) }}"
                >
            </div>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="address">Città*</label>
                <input
                    type="text"
                    class="form-control @error('address') is-invalid @enderror"
                    id="address"
                    name="address"
                    required
                    minlength="2"
                    maxlength='255'
                    value="{{ old('address', $restaurant->address) }}"
                >
                @error('address')
                   <div class="invalid-feedback" role="alert">{{ $message }}</div>
               @enderror
            </div>
   

            <div class="form-group">
                <label for="phone_number">Telefono*</label>
                <input
                    type="tel"
                    class="form-control @error('phone_number') is-invalid @enderror"
                    id="phone_number"
                    name="phone_number"
                    required
                    minlength='7'
                    maxlength='15'
                    value="{{old('phone_number', $restaurant->phone_number)}}"
                >
                @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
  
            <h5 class="mb-3">Tipologia attività*</h5>
            <div class="form-group mx-2 d-flex flex-wrap">
                @foreach ($tipologies as $tipology)
                    <div class="w-33">
                        <input  
                           type="checkbox"
                           role="button" 
                           value="{{$tipology->id}}" 
                           id="{{$tipology->id}}" 
                           name="tipologies[]"

                            @if ($errors->any() && in_array( $tipology->id, old('tipologies', []))) checked
                            @elseif($restaurant->tipologies->contains($tipology->id)) checked 
                            @endif
                        >
                        <label role="button" for="{{$tipology->id}}"> {{$tipology->name}} </label>
                    </div>
                @endforeach
                @error('tipologies')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror  
            </div>
          
            <div class="form-group mx-2">
                <label class="d-block" for="image">Immagine locale</label>
                <input role="button" type="file" id="image" name="image">
                @error('image')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            @if($restaurant->image)
            <div class="w-25 my-5">
                <img class="img-fluid" src="{{ asset('storage/'.$restaurant->image) }}" alt="{{$restaurant->name}}">
            </div>
            @endif
            
            <div class="form-group mx-2">
                <input role="button" type="submit" class="btn btn-primary" id="my-btn" value="aggiorna">
            </div>
            
            
        </form>
        <a class="btn btn-secondary mx-2" href="{{ route('admin.restaurant.show',  $restaurant->id) }}">Torna indietro</a>
    </div>
@endsection