@extends('admin.users.show.base')

@section('comments', 'active')

@section('tab_content')

	<h3>Comments:</h3>

	<ul class="list-group list-group-flush">
		@foreach($user->comments as $comment)

			@component('admin.includes.comment')
				@slot('comment', $comment)
				@slot('title')
					<h3>
						<a href="{{ route('admin.questions.show', $comment->question->id) }}">
							{{ $comment->question->title }}
						</a>
					</h3>					
				@endslot
			@endcomponent
		@endforeach
	</ul>

@endsection