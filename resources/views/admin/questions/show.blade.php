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

	<div class="">
		<img class="small-icon" src="{{ asset('storage/'.$question->user->profile_image) }}" alt="Profile image">

		<a href="{{ route('admin.users.info', $question->user->name) }}">{{ $question->user->profileName }}</a>
	</div>

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

		@component('admin.components.comments_tab')
			@slot('item', $question)
			@slot('send_comment_url', route('admin.comments.storeForQuestion', $question->id))
		@endcomponent
	
	</div>

	<ul class="answers-tab cards-list">

		@if($question->solutions)
			<h3>Solutions</h3>
			@foreach($question->solutions as $answer)	
				@component('admin.components.answer')
					@slot('answer', $answer)
				@endcomponent	
			@endforeach
		@endif

	</ul>

	<ul class="answers-tab cards-list">
		
		@if($question->notSolutions)
			<h3>Answers</h3>
			@foreach($question->notSolutions as $answer)
				@component('admin.components.answer')
					@slot('answer', $answer)
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

	<li class="cards-list-item">
	 	<a class="btn btn-info" 
	 	href="{{ route('admin.questions.edit', $question->id) }}">
	 		Edit
	 	</a>
	</li>
	<li class="cards-list-item">
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
