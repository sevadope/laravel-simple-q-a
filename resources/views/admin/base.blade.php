@extends('layouts.base')

@section('brand_title', 'Admin Panel')

@section('left_sidebar')
	<a href="{{ route('admin.questions.index') }}" class="cards-list-item">
		Questions
	</a>

	<a href="{{ route('admin.tags.index') }}" class="cards-list-item">
		Tags
	</a>

	<a href="{{ route('admin.users.index') }}" class="cards-list-item">
		Users
	</a>

	<a href="{{ route('admin.answers.index') }}" class="cards-list-item">
		Answers
	</a>

	<a href="{{ route('admin.comments.index') }}" class="cards-list-item">
		Comments
	</a>

	<a class="cards-list-item"
	href="{{ route('questions.index') }}">
		<button class="btn btn-primary">To site</button>
	</a>	
@endsection

