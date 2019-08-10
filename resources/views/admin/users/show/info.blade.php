@extends('admin.users.show.base')

@section('info', 'active')

@section('tab_content')

<h4>{{ $user->about_myself }}</h4>

@endsection