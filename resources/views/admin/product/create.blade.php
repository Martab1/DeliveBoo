@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Aggiungi un nuovo prodotto al tuo ristorante</h1>

        <div class="row">
            <div class="col-md-8 offset-md-2">


                <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="form-group">

                        <div class="form-group">
                            <label for="name">Nome*</label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Inserisci il nome"
                                value="{{ old('name') }}"
                                required
                                min="3"
                                max="50"
                            >
                            @error('name')
                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                            @enderror

                            <label class="mt-3" for="price">Prezzo</label>
                            <input 
                                type="number"
                                step="0.01"
                                name="price"
                                id="price"
                                class="form-control @error('price') is-invalid @enderror" 
                                placeholder="Inserisci il prezzo"
                                value="{{ old('price') }}"
                                required
                                min="0.00"
                                max="999.99"
    
                            > 
                            @error('price')
                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <label class="mt-3" for="visibility">Disponibile</label>
                        <select
                            required
                            name="visibility"
                            id="visibility">
                            <option
                                selected
                                value="1">
                                si
                            </option>
                            <option
                                value="0">
                                no
                            </option>
                        </select>
                        @error('visibility')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
    
                        <h class="my-3 d-block">Categoria</h>
                        <div class="form-group mx-2 d-flex flex-wrap">
                        @foreach ($categories as $category)
                            <div class="w-33">
                                <input role="button" type="radio" value="{{$category->id}}" id="{{$category->id}}" name="category_id"
                                @if ( $category->id == old('categories')))
                                    checked
                                @endif>
                                <label role="button" for="{{$category->id}}">{{$category->name}}</label>
                            </div>
                        @endforeach
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                        {{-- RESTAURANT ID HIDDEN --}}
                        <input name="restaurant_id" type="hidden" value="{{$restaurant_id}}">
                    </div>


                    <label for="description" class="control-label">Descrizione del prodotto</label>
                    <textarea maxlength="255" class="form-control @error('description') is-invalid @enderror"placeholder="Inserisci una descrizione" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="feedback">{{ $message }}</div>
                    @enderror

                    <div class="mt-3">
                        <div>
                            <label for="image" class="form-label"> Immagine prodotto </label>
                        </div>
                        <input 
                           type="file" 
                           name="image" 
                           id="image"
                        >
                        @error('image')
                           <div class=" @error('image') is-invalid @enderror">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <input role="button" type="submit" class="btn btn-primary" id="my-btn">
                        <a class="btn btn-secondary" id="my-btn" href="{{ route('admin.restaurant.show',  $restaurant_id) }}">Torna indietro</a>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
