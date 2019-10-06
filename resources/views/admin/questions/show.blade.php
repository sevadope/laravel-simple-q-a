@extends('admin.base')

@section('content_header')
	<h5 class="card-subtitle mb-2">
		@foreach($question->tags as $tag)
		|	<a class="d-inline text-info" 
			href="{{ route('admin.tags.questions', $tag->slug) }}">
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
			Asked: {{ $question->created_at }}
		</p>
		<p class="card-subtitle mt-2 ml-2 text-muted">
			Views: {{ $question->views_count }}
		</p>		
		<div class="btn btn-primary m-2" disabled>
			Subscribers: {{ $question->subscribers_count }}
		</div>

		@component('admin.components.question_comments_tab')
			@slot('question', $question)
		@endcomponent
	
	</div>

	<ul class="answers-tab list-group list-group-flush">

		@if($question->solutions)

			<h3>Solutions</h3>

			@foreach($question->solutions as $answer)	
				@component('admin.components.question.answer')

					@slot('answer', $answer)

					@slot('add_field')
						<a class="btn btn-success mr-2" 
						href="{{ route('admin.answers.changeStatus', $answer->id)}}">
							Remove from solutions
						</a>
					@endslot	

				@endcomponent	
			@endforeach
		@endif
	</ul>

	<ul class="answers-tab list-group list-group-flush">
		
		@if($question->notSolutions)
			<h3>Answers</h3>
			@foreach($question->notSolutions as $answer)
				@component('admin.components.question.answer')

					@slot('answer', $answer)

					@slot('add_field')
						<a href="{{ route('admin.answers.changeStatus', $answer->id)}}" class="btn btn-success mr-2">
							Add to solutions
						</a>
					@endslot	

				@endcomponent	
			@endforeach
		@endif

	</ul>

	<div class="">		
		<h3 class="mt-2">Your answer</h3>
		<br>
		<form action="{{ route('admin.answers.store', $question->id) }}"
		method="POST">
			@csrf
			<input type="hidden" name="question_id" value="{{ $question->id }}">

			<div class="form-group">
				<h5 for="body">Moderator</h5>
			    <textarea class="form-control" name="body" id="body" rows="5" required></textarea>
			</div>

			<button class="btn btn-primary" type="submit">Send</button>
		</form>
	</div>
	
@endsection

@section('right_sidebar')

	<li class="list-group-item">
	 	<a class="btn btn-info" 
	 	href="{{ route('admin.questions.edit', $question->id) }}">
	 		Edit
	 	</a>
	</li>
	<li class="list-group-item">
		<form method="POST"
		action="{{ route('admin.questions.destroy', $question->id) }}">
			@method('DELETE')
			@csrf

			<button class="btn btn-danger" type="submit">
				Delete
			</button>
		</form>
	</li>

@endsection
