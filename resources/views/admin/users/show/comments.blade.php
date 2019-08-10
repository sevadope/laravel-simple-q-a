@extends('admin.users.show.base')

@section('comments', 'active')

@section('tab_content')

	@foreach($user->comments as $comment)
		<div class="card">
			<div class="card-body">
		  		<h6 class="card-subtitle mb-2 text-muted"></h6>
		    	<h3 class="card-title">
		    		<a href="{{ route('admin.questions.show', $comment->question->id) }}">
		    			{{ $comment->question->title }}
		    		</a>
		    	</h3>
			    <h6 class="card-subtitle mb-2 d-inline">
			    	{{ $user->profileName }}
			    </h6>
			    <h6 class="card-subtitle d-inline text-muted">
			    	{{ '@' . $user->name }}
			    </h6>
		    	<p class="card-text ml-4 mt-2">{{ $comment->body }}</p>
		    	<p class="card-subtitle text-muted">{{ $comment->created_at }}</p>
		  	</div>
		</div>
	@endforeach

@endsection