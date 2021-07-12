@extends('layouts.app')

@section('content')
<div class="container">
    <div>Welcome Users</div>
    <a class="btn btn-primary " 
    href="{{route("admin.restaurant.create")}}"
    >Register your restaurant</a>
</div>
@endsection
