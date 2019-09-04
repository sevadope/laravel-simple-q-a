@extends('public.base')

@section('content_header', 'All questions')

@section('content')

	@component('public.includes.sorting_tabs')
		@slot('tabs', $sorting_tabs)
		@slot('param', $sorting_param)
	@endcomponent

	<ul class="list-group list-group-flush">
		@foreach($questions as $question)
			@include('public.includes.question')
		@endforeach		
	</ul>

	{{ $questions->links() }}

@endsection