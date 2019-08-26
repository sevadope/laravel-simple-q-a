@extends('admin.base')

@section('content_header', 'Comments')

@section('content')

	@include('admin.includes.comments_table')
	{{ $comments->links() }}

@endsection