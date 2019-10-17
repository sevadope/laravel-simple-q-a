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
		<h5 class="m-2">Interesting questions</h5>
		@foreach($questions_toplist as $list_question)
			@component('public.components.mini_question_card')
				@slot('question', $list_question)
			@endcomponent
		@endforeach
	@endisset
@endsection