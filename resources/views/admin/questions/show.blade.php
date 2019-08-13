@extends('admin.base')

@section('content_header')
<h5 class="card-subtitle mb-2">
	@foreach($question->tags as $tag)
	|	<a class="d-inline text-info" href="{{ route('admin.tags.questions', $tag->slug) }}">
			{{ $tag->title }}
		</a>
	@endforeach
</h5>
<h2>{{ $question->title }}</h2>
@endsection

@section('content')

@include('admin.includes.messages.base')

<div class="question">
	<div class="ml-2">
		{{ $question->description }}
	</div>
	<p class="card-subtitle mt-2 ml-2 text-muted">{{ $question->created_at }}</p>

	<div class="comments-container">
		@if($question->comments->count() > 0)
			<button class="btn btn-link">{{ $question->comments->count() }} comments</button>
		@else
			<button class="btn btn-link">Comment this</button>
		@endif
	
		@component('admin.includes.comments_tab')
		@slot('item', $question)
		@endcomponent

	</div>	
</div>

@component('admin.includes.answers_comments_tab')
	@slot('item', $question)
@endcomponent	

@endsection


@section('right_sidebar')
	<li class="list-group-item">
	  <a class="btn btn-info" href="{{ route('admin.questions.edit', $question->id) }}">Edit</a>
	</li>

	<form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST">
		@method('DELETE')
		@csrf

		<li class="list-group-item">
		  <button type="submit" class="btn btn-danger">Delete</button>
		</li>  	  
		
	</form>	
@endsection