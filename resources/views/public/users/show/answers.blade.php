@extends('public.users.show.base')

@section('answers', 'active')

@section('tab_content')

	<h3>Answers:</h3>

	<ul class="list-group list-group-flush">
		@foreach($answers as $answer)

			<h3 class="mt-3">
				<a href="{{ route('questions.show', $answer->question_id) }}">
					{{ $answer->question->title }}
				</a>
			</h3>

			@component('public.includes.user.answer')
				@slot('answer', $answer)
				@slot('user', $user)		
			@endcomponent
			
		@endforeach
	</ul>

	{{ $answers->links() }}
	
@endsection