@extends('public.tags.show.base')

@section('questions', 'active')

@section('tab_content')

	@if($questions->isNotEmpty())
		<h3>Questions:</h3>
		<ul class="list-group list-group-flush">
			@foreach($questions as $question)
				@include('public.components.question')
			@endforeach
		</ul>
		{{ $questions->links() }}
	@else
		<h5>There are no questions with this tag</h5>
	@endauth
	
@endsection