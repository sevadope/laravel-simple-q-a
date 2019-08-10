@extends('admin.users.show.base')

@section('comments', 'active')

@section('tab_content')

	@foreach($user->comments as $comment)
		<div class="card">
			<div class="card-body">
		  		<h6 class="card-subtitle mb-2 text-muted"></h6>
		    	<h5 class="card-title">{{ $comment->question->title }}</h5>
		    	<p class="card-text">{{ $comment->body }}</p>
		    	<h6 class="card-subtitle mb-2 text-muted"></h6>
		  	</div>
		</div>
	@endforeach

@endsection