@extends('public.users.show.base')

@section('head')
	<script src="{{ asset('js/like.js') }}" defer></script>
@endsection

@section('comments', 'active')

@section('tab_content')

	@if($comments->isNotEmpty())
		<h3>Comments:</h3>

		<ul class="cards-list">
			@foreach($comments as $comment)
				<h3 class="mt-3">
					<a href="{{ route('questions.show', $comment->question->id) }}">
						{{ $comment->question->title }}
					</a>
				</h3>
				@component('public.components.comment')
					@slot('comment', $comment)
					@slot('like_btn')
					@endslot
				@endcomponent
			@endforeach
		</ul>
		{{ $comments->links() }}
	@else
		<h3>The user has not yet commented on anything</h3>
	@endif
@endsection