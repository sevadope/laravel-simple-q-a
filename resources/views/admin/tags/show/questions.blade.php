@extends('admin.tags.show.base')

@section('questions', 'active')

@section('tab_content')

	@if($questions->isNotEmpty())
		<h3>Questions:</h3>
		@include('admin.components.tables.questions_table')
		{{ $questions->links() }}
	@else
		<h5>There are no questions with this tag</h5>
	@endif	

@endsection