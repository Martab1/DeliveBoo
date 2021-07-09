@extends('layouts.app')

@section('content')
<div class="container">

    
    @if ($logged)
        <h1>Your restaurant</h1>

    @else
    <div>Welcome User</div>
    <a class="btn btn-primary" 
    href="{{route("admin.restaurant.create")}}"
    >Register your restaurant</a>
    @endif

</div>
@endsection
