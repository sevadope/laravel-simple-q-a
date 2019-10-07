@extends('admin.base')

@section('content_header', 'Users')

@section('content')


    @include('admin.components.tables.users_table')
    {{ $users->links() }}
@endsection