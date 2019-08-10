@extends('admin.users.show.base')

@section('questions', 'active')

@section('tab_content')

	@foreach($user->questions as $question)
		<div class="card">
			<div class="card-body">
		  		<h6 class="card-subtitle mb-2 text-muted">
		  			{{ $question->tagsTitle }}
		  		</h6>
		    	<h3 class="card-title">
		    		<a href="{{ route('admin.questions.show', $question->id) }}">
		    			{{ $question->title }}
		    		</a>
		    	</h3>
		    	<h6 class="card-subtitle mb-2 text-muted">Answers: {{ $question->answers->count() }}</h6>
		    	<h6 class="card-subtitle mb-2 text-muted">{{ $question->created_at }}</h6>
		  	</div>
		</div>
	@endforeach

@endsection