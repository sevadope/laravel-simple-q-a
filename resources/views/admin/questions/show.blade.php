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

	@component('admin.includes.comments_tab')
		@slot('item', $question)
	@endcomponent
</div>

@component('admin.includes.answers_tab')
	@slot('question', $question)
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