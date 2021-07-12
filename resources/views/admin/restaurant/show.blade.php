{{-- @extends('layouts.app')
@section('content')

   <div class="container">
      <h1 class="text-center mb-5">Attività di {{$restaurant->user->name }} {{ $restaurant->user->surname }}</h1>

      <h2> Nome locale: {{$restaurant->name}}</h2>
    
       @dump($restaurant->user) 
       @dump($restaurant->tipologies) 
      <h4 class=" d-inline"> Tipologia:</h4>
      @foreach ($restaurant->tipologies as $tipology)
            <span> {{ $tipology->name}} </span>
      @endforeach

      <h4> Indirizzo: {{$restaurant->address}}</h4>
      <h4> Telefono: {{$restaurant->phone_number}}</h4>
      @if ($restaurant->image)
        <h4> Image: {{ $restaurant->image}}</h4>
      @endif
     
      <a  class=" btn btn-warning mb-5" href="{{route('admin.restaurant.edit', $restaurant->id)}}">Modifica</a>
    
   </div>

@endsection --}}