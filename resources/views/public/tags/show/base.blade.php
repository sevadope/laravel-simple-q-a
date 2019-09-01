@extends('public.base')

@section('content_header')
	<div class="d-inline">{{ $tag->title }}</div>
@endsection

@section('content')

<h5 class="text-muted">{{ $tag->slug }}</h6>

<div class="">
	<h5 class="d-inline"> Questions: {{ $tag->questions->count() }}</h5>
</div>

<ul class="nav nav-tabs mb-2">
	<li class="nav-item">
		<a href="{{ route('tags.info', $tag->slug) }}" 
		class="nav-link @yield('info')">
			Information
		</a>
	</li>
	<li class="nav-item">
		<a href="{{ route('tags.questions', $tag->slug) }}"
		class="nav-link @yield('questions')">
			Questions
		</a>
	</li>
</ul>

@yield('tab_content')

@endsection

