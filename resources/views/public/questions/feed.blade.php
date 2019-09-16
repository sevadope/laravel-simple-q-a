@extends('public.base')

@section('content_header', 'My feed')

@section('content')

	@component('public.components.sorting_tabs')
		@slot('tabs', $sorting_tabs)
		@slot('param', $sorting_param)
	@endcomponent

	<ul class="list-group list-group-flush">
		@foreach($questions as $question)
			@include('public.components.question')
		@endforeach		
	</ul>

	{{ $questions->links() }}

@endsection