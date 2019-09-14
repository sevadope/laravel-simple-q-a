@extends('admin.base')

@section('content_header', 'Users')

@section('content')


    @include('admin.components.users_table')
    {{ $users->links() }}
@endsection