@extends('form')
@section('users')
<h2>Users:</h2>
@foreach ($users as $user)
    <p>Imię: {{ $user->name }} Email: {{ $user->email }} Hasło: {{ $user->password }}</p>
@endforeach
@endsection