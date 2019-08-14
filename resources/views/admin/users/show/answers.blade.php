@extends('admin.users.show.base')

@section('answers', 'active')

@section('tab_content')

	<h3>Answers:</h3>

	@foreach($user->answers as $answer)
		<ul class="list-group list-group-flush">
			@component('admin.includes.answer')
				@slot('answer', $answer)
				@slot('title')
					<h3>
						<a href="{{ route('admin.questions.show', $answer->question->id) }}">
							{{ $answer->question->title }}
						</a>
					</h3>
				@endslot
			@endcomponent
		</ul>
	@endforeach
@endsection