@extends('layouts.app')

@section('content')
<div class="container">
<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Display Name</td>
                <td>Username</td>
                <td>Password</td>
                <td>Expiration</td>
            </tr>
        </thead>
        <tbody>
        @foreach($guests as $guest)
            <tr>
                <td>{{ $guest->cn }}</td>
                <td>{{ $guest->username }}</td>
                <td>{{ $guest->password }}</td>
                <td>{{ date("F j, Y", ($guest->expiration)) }}</td>
            </tr>
        @endforeach
</div>
@endsection
