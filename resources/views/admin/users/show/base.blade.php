@extends('admin.base')

@section('content_header')
<div class="d-inline">{{ $user->profileName }}</div>
<small class="d-inline"><a href="{{ route('admin.users.edit', $user->id) }}">Edit</a></small>

@endsection

@section('content')
<h5 class="text-muted">{{ $user->briefly_about_myself }}</h6>

<div class="">
	<h5 class="d-inline"> Questions: {{ $user->questions()->count() }} |</h5>
	<h5 class="d-inline"> Answers: {{ $user->answers()->count() }}</h5>
</div>

<ul class="nav nav-tabs">
	<li class="nav-item">
		<a href="{{ route('admin.users.info', $user->id) }}" class="nav-link @yield('info')">
			Information
		</a>
	</li>
	<li class="nav-item">
		<a href="{{ route('admin.users.questions', $user->id) }}" class="nav-link @yield('questions')">
			Questions
		</a>
	</li>
	<li class="nav-item">
		<a href="{{ route('admin.users.answers', $user->id) }}" class="nav-link @yield('answers')">
			Answers
		</a>
	</li>
	<li class="nav-item">
		<a href="{{ route('admin.users.comments', $user->id) }}" class="nav-link @yield('comments')">
			Comments
		</a>
	</li>
</ul>

@yield('tab_content')

@endsection



