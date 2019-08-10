@extends('admin.users.show.base')

@section('answers', 'active')

@section('tab_content')

	@foreach($user->answers as $answer)
		<div class="card">
		  <div class="card-body">
		    <h3 class="card-title">
		    	<a href="{{ route('admin.questions.show', 
		    	$answer->question->id) }}">
		    		{{ $answer->question->title }}
		    	</a>
		    </h3>
		    <h6 class="card-subtitle mb-2 d-inline">
		    	{{ $user->profileName }}
		    </h6>
		    <h6 class="card-subtitle d-inline text-muted">
		    	{{ '@' . $user->name }}
		    </h6>
		    <p class="card-text ml-4 mt-2">
		    	{{ $answer->body }}
		    </p>
			<p class="card-subtitle text-muted">{{ $answer->created_at }}</p>
			@if($answer->comments()->count())
				<a href="{{ route('admin.questions.show', 
		    	$answer->question->id) }}" class="card-subtitle d-inline">
					{{ $answer->comments()->count() }} Comments
				</a> 
			@else
				<a href="{{ route('admin.questions.show', 
		    	$answer->question->id) }}" class="card-subtitle d-inline">
					Comment
				</a>
			@endif

		  </div>
		</div>
	@endforeach

@endsection