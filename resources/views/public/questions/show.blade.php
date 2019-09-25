@extends('public.base')

@section('head')

@endsection

@section('content_header')
	<h5 class="card-subtitle mb-2">
		@foreach($question->tags as $tag)
		-	<a class="d-inline text-info" href="{{ route('tags.questions', $tag->slug) }}">
				{{ $tag->title }}
			</a>
		@endforeach
	</h5>
	<h2>{{ $question->title }}</h2>
@endsection

@section('content')

	<div class="question">

		<div class="ml-2">
			{{ $question->description }}
		</div>

		<p class="card-subtitle mt-2 ml-2 text-muted">
			{{ $question->created_at }}
		</p>

		@auth
			@user_subscribed($question->subscribers)
				<a href="{{ route('questions.unsubscribe', $question->id) }}"
				class="btn btn-outline-primary m-2 question-subscribe">
					Unsubscribe | {{ $question->subscribers_count }}
				</a>
			@else 
				<a href="{{ route('questions.subscribe', $question->id) }}"
				class="btn btn-primary m-2 question-unsubscribe">
					Subscribe | {{ $question->subscribers_count }}
				</a>
			@enduser_subscribed
		@endauth

		@component('public.components.question_comments_tab')
			@slot('question', $question)
		@endcomponent		

	</div>

	<ul class="answers-tab list-group list-group-flush">

		@if($question->solutions)

			<h3>Solutions</h3>

			@foreach($question->solutions as $answer)	
				@component('public.components.question.answer')

					@slot('answer', $answer)

					@if($question->user_id == auth()->id())
						@slot('add_field')
							<a href="{{ route('answers.changeStatus', $answer->id) }}" class="btn btn-success mr-2">
								Remove from solutions
							</a>
						@endslot	
					@endif

				@endcomponent	
			@endforeach
		@endif
	</ul>

	<ul class="answers-tab list-group list-group-flush">
		
		@if($question->notSolutions)
			<h3>Answers</h3>
			@foreach($question->notSolutions as $answer)
				@component('public.components.question.answer')
					@slot('answer', $answer)

					@if($question->user_id === auth()->id())
						@slot('add_field')
							<a href="{{ route('answers.changeStatus', $answer->id) }}" class="btn btn-success mr-2">
								Add to solutions
							</a>
						@endslot	
					@endif
					
				@endcomponent	
			@endforeach
		@endif

	</ul>

	@auth
		<h3 class="mt-2">Your answer</h3>
		<br>
		<form action="{{ route('answers.store', $question->id) }}" method="POST">
			@csrf
			<input type="hidden" name="question_id" value="{{ $question->id }}">

			<div class="form-group">
				<h5 for="body">{{ auth()->user()->profileName }}</h5>
			    <textarea class="form-control" name="body" id="body" rows="5" required></textarea>
			</div>

			<button class="btn btn-primary" type="submit">Send</button>
		</form>
	@endauth
	
@endsection

@section('right_sidebar')

	@if(auth()->id() === $question->user_id)
		<li class="list-group-item">
		  <a class="btn btn-info" href="{{ route('questions.edit', $question->id) }}">Edit</a>
		</li>
	@endif
<script src="{{ asset('js/q_show_ajax_test.js') }}" defer></script>
@endsection
