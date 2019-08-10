@extends('admin.users.show.base')

@section('answers', 'active')

@section('tab_content')

	@foreach($user->answers as $answer)
		<div class="card">
		  <div class="card-body">
		    <h5 class="card-title">{{ $answer->question->title }}</h5>
		    <p class="card-text">
		    	{{ $answer->body }}
		    </p>
		  </div>
		</div>
	@endforeach

@endsection