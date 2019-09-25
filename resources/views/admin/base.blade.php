@extends('layouts.base')

@section('brand_title', 'Admin Panel')

@section('left_sidebar')
	<a href="{{ route('admin.questions.index') }}" class="list-group-item">
		Questions
	</a>

	<a href="{{ route('admin.tags.index') }}" class="list-group-item">
		Tags
	</a>

	<a href="{{ route('admin.users.index') }}" class="list-group-item">
		Users
	</a>

	<a href="{{ route('admin.answers.index') }}" class="list-group-item">
		Answers
	</a>

	<a href="{{ route('admin.comments.index') }}" class="list-group-item">
		Comments
	</a>

	<a class="list-group-item"
	href="{{ route('questions.index') }}">
		<button class="btn btn-primary">To site</button>
	</a>	
@endsection

@section('base_content')
	@include('admin.components.messages.base')
	@yield('content')
@endsection
