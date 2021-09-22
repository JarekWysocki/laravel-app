@extends('layouts.app')

@section('users')
<div class="users d-flex m-0 p-0 col-md-6 m-auto col-12" name ="{{ Auth::user()->id }}">
      @foreach ($users as $user)
        <div class="user p-1">
          <img id="{{ $user->id }}" src="{{  Request::root() }}/images/{{ $user->image }}">
          <p class="text-center"> {{ $user->name }} </p>
        </div>
      @endforeach
</div>
<div class="chatWindows"></div>
@endsection