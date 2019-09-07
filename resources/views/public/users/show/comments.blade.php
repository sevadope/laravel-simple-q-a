@extends('public.users.show.base')

@section('comments', 'active')

@section('tab_content')

	<h3>Comments:</h3>

	<ul class="list-group list-group-flush">
		@foreach($comments as $comment)
			<h3 class="mt-3">
				<a href="{{ route('questions.show', $comment->question->id) }}">
					{{ $comment->question->title }}
				</a>
			</h3>
			@include('public.components.comment')
		@endforeach
	</ul>

	{{ $comments->links() }}

@endsection