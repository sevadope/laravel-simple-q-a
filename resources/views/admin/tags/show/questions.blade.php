@extends('admin.tags.show.base')

@section('questions', 'active')

@section('tab_content')

	<h3>Questions:</h3>

	@include('admin.includes.questions_table')

	{{ $questions->links() }}

@endsection