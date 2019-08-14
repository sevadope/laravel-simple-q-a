@extends('admin.users.show.base')

@section('questions', 'active')

@section('tab_content')

	<h3>Questions:</h3>

	<ul class="list-group list-group-flush">
		@foreach($user->questions as $question)
			@include('admin.includes.question')
		@endforeach
	</ul>

@endsection