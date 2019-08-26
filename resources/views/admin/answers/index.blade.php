@extends('admin.base')

@section('content_header', 'Answers')

@section('content')

	@include('admin.includes.answers_table')
	{{ $answers->links() }}
	
@endsection