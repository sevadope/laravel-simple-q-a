@extends('public.base')

@section('content_header', 'All questions')

@section('content')

	@component('public.components.sorting_tabs')
		@slot('tabs', $sorting_tabs)
		@slot('param', $sorting_param)
	@endcomponent

	<ul class="cards-list">
		@foreach($questions as $question)
			@include('public.components.question_card')
		@endforeach		
	</ul>

	{{ $questions->links() }}

@endsection

@section('right_sidebar')
	@isset($questions_toplist)
		@component('public.components.toplist')
			@slot('toplist', $questions_toplist)
			@slot('title', 'Interesting questions')
			@slot('component_path', 'public.components.mini_question_card')
		@endcomponent
	@endisset
@endsection