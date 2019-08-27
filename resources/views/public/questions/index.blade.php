@extends('public.base')

@section('content_header', 'All questions')

@section('content')
	
	<ul class="list-group list-group-flush">
		@foreach($questions as $question)
			@include('public.includes.question')
		@endforeach		
	</ul>

	{{ $questions->links() }}

@endsection