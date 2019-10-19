@extends('public.base')

@section('content_header')
	<img class="large-icon" src="{{ asset('storage/'.$user->profile_image) }}" alt="Profile image">
	<div class="">{{ $user->profileName }}</div>
@endsection

@section('content')

	<h5 class="text-muted">{{ $user->briefly_about_myself }}</h6>

	<div class="">
		<h5 class="d-inline"> Questions: {{ $user->questions_count }} |</h5>
		<h5 class="d-inline"> Answers: {{ $user->answers_count }} |</h5>
		<h5 class="d-inline"> Comments: {{ $user->comments_count }}</h5>
	</div>

	<ul class="nav nav-tabs mb-2">
		<li class="nav-item">
			<a href="{{ route('users.info', $user->name) }}" class="nav-link @yield('info')">
				Information
			</a>
		</li>
		<li class="nav-item">
			<a href="{{ route('users.questions', $user->name) }}" class="nav-link @yield('questions')">
				Questions
			</a>
		</li>
		<li class="nav-item">
			<a href="{{ route('users.answers', $user->name) }}" class="nav-link @yield('answers')">
				Answers
			</a>
		</li>
		<li class="nav-item">
			<a href="{{ route('users.comments', $user->name) }}" class="nav-link @yield('comments')">
				Comments
			</a>
		</li>
	</ul>

	@yield('tab_content')

@endsection

@section('right_sidebar')
	@isset($users_toplist)
		@component('public.components.toplist')
			@slot('toplist', $users_toplist)
			@slot('title', 'Most active users')
			@slot('component_path', 'public.components.mini_user_card')
		@endcomponent
	@endisset
@endsection
