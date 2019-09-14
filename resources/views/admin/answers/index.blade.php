@extends('admin.base')

@section('content_header', 'Answers')

@section('content')

	@include('admin.components.answers_table')
	{{ $answers->links() }}
	
@endsection