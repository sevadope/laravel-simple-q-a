@extends('layouts.base')

@section('brand_title')
Admin Panel
@endsection

@section('left_sidebar')
	<a href="{{ route('admin.questions.index') }}" class="list-group-item list-group-item-action text-light bg-dark">
		Questions
	</a>

	<a href="{{ route('admin.tags.index') }}" class="list-group-item list-group-item-action text-light bg-dark">
		Tags
	</a>

	<a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action text-light bg-dark">
		Users
	</a>

	<a href="{{ route('admin.answers.index') }}" class="list-group-item list-group-item-action text-light bg-dark">
		Answers
	</a>

	<a href="{{ route('admin.comments.index') }}" class="list-group-item list-group-item-action text-light bg-dark">
		Comments
	</a>
@endsection


@section('base_content')
@include('admin.includes.messages.base')
@yield('content')
@endsection
