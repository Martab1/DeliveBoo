@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-2">Crea il tuo ristorante</h1>
        <form action="{{route('admin.restaurant.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("POST")

            <div class="form-group">
                <label for="name">Nome*</label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    required
                    maxlength="50" 
                    minlength="2"
                    value="{{ old('name') }}"
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

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
                    value="{{ old('address') }}"
                >
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number">Numero di telefono*</label>
                <input
                    type="tel"
                    class="form-control @error('phone_number') is-invalid @enderror"
                    id="phone_number"
                    name="phone_number"
                    minlength='7' 
                    maxlength='15'
                    required
                    value="{{ old('phone_number') }}"
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
                           role="button" 
                           type="checkbox" 
                           value="{{$tipology->id}}" 
                           id="{{$tipology->id}}" 
                           name="tipologies[]"
                            @if ( in_array( $tipology->id, old('tipologies', [])))
                                checked
                            @endif
                        >
                        <label role="button" for="{{$tipology->id}}">{{$tipology->name}}</label>
                    </div>
                @endforeach 
                @error('tipologies')
                   <div class="alert alert-danger">{{ $message }}</div>
                @enderror  
            </div>
             
            <div class="form-group mx-2">
                    <label class="d-block" for="image">Immagine locale</label>
                <input 
                    role="button" 
                    type="file" 
                    id="image" 
                    name="image"
                >
                @error('image')
                    <div class=" @error('image') is-invalid @enderror">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group mx-2">
                <input role="button" type="submit" id="my-btn" class="btn btn-primary" value="salva">
            </div>
        </form>
        
    </div>
@endsection