@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica un prodotto al tuo ristorante</h1>

        <div class="row">
            <div class="col-md-8 offset-md-2">


                <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <div class="form-group">

                        <div class="form-group">
                            <label for="name">Nome*</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Inserisci il nome"
                                value="{{ old('name', $product->name) }}"
                                required
                                min="3"
                                max="50">
                            @error('name')
                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                            @enderror

                            <label class="mt-3" for="price">Prezzo*</label>
                            <input type="number"
                                step="0.01"
                                name="price"
                                id="price"
                                class="form-control @error('price') is-invalid @enderror" placeholder="Inserisci il prezzo"
                                value="{{ old('price', $product->price) }}"
                                required
                                min="0.00"
                                max="999.99">
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
                            @if ($product->visibility == old('visibility', $product->visibility))
                            selected
                            @endif
                                value="1">
                                si
                            </option>

                            <option  @if ($product->visibility == old('visibility', $product->visibility))
                                selected
                            @endif
                                value="0">
                                no
                            </option>
                        </select>
                        @error('visibility')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="description" class="control-label">Descrizione del prodotto</label>
                    <textarea maxlength="255" class="form-control @error('description') is-invalid @enderror"
                        placeholder="Inserisci una descrizione" id="description" name="description"
                        rows="3">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="feedback">{{ $message }}</div>
                    @enderror

                    <div class="mt-3">
                        <div>
                            <label for="image" class="form-label">
                                Post Image
                            </label>
                        </div>
                        <input type="file" name="image" id="image">
                        @error('image')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>

                    @if($product->image)
                    <div class="w-25 my-5">
                        <img class="img-fluid" src="{{ asset('storage/'.$product->image) }}" alt="{{$product->name}}">
                    </div>
                    @endif

                    <div class="form-group mt-4">
                        <input role="button" type="submit" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

