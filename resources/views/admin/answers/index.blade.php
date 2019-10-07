@extends('admin.base')

@section('content_header', 'Answers')

@section('content')

	@include('admin.components.tables.answers_table')
	{{ $answers->links() }}
	
@endsection