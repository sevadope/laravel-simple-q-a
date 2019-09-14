@extends('admin.users.show.base')

@section('questions', 'active')

@section('tab_content')

	@if($questions->isNotEmpty())
		<h3>Questions:</h3>
		@include('admin.components.questions_table')
		{{ $questions->links() }}
	@else
		<h3>There are no questions with this tag</h3>
	@endif	

@endsection