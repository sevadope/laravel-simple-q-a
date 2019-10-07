@extends('admin.base')

@section('content_header', 'Comments')

@section('content')

	@include('admin.components.tables.comments_table')
	{{ $comments->links() }}

@endsection