@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Modifica un prodotto:
            <a href="{{ route('admin.product.index', $product->id) }}">{{ $product->name }}</a>
        </h1>

        <div class="row">
            <div class="col-md-8 offset-md-2">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.product.update', $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")

                    <div class="form-group">

                        <div class="form-group">
                            <label for="name">Nome*</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Inserisci il nome" value="{{ old('name') }}" required max="50">
                            @error('name')
                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                            @enderror

                            <label class="mt-3" for="price">Prezzo*</label>
                            <input type="number" step="0.01" name="price"
                                class="form-control @error('price') is-invalid @enderror" placeholder="Inserisci il prezzo"
                                value="{{ old('price') }}" required min="0.00" max="999.99">
                            @error('price')
                                <div class="invalid-feedback" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <label class="mt-3" for="visibility">Disponibile*</label>
                        <select name="visibility" id="visibility" required>
                            <option selected value="1">si</option>
                            <option value="0">no</option>
                        </select>
                    </div>

                    <label for="description" class="control-label">Descrizione del prodotto</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                        placeholder="Inserisci una descrizione" id="description" name="description" rows="3" min="10"
                        max="255">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="feedback">{{ $message }}</div>
                    @enderror

                    <div class="mt-3">
                        <div>
                            <label for="image" class="form-label">
                                Post Image
                            </label>
                        </div>
                        @if ($product->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    srcset="">
                            </div>
                        @endif
                        <input type="file" name="image" id="image">
                        @error('image')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <input role="button" type="submit" class="btn btn-primary">
                    </div>

                </form>
            </div>
        @endsection
