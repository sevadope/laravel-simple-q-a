@extends('public.tags.show.base')

@section('questions', 'active')

@section('tab_content')

	<h3>Questions:</h3>

	<ul class="list-group list-group-flush">
		@foreach($questions as $question)
			@include('public.components.question')
		@endforeach
	</ul>

	{{ $questions->links() }}

@endsection