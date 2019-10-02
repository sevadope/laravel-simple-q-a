@extends('public.base')

@section('head')
	<script src="{{ asset('js/subscribe.js') }}" defer></script>
@endsection

@section('content_header')
	<div class="text-center">{{ $tag->title }}</div>
@endsection

@section('content')

	<div class="text-center mb-2">
		<h5 class="text-muted text-center">{{ $tag->slug }}</h6>
		
		<h5>
			Questions: {{ $tag->questions->count() }}
		</h5>

		@auth
			@component('public.components.subscribe_btn')
				@slot('item', $tag)
				@slot('subscribe_uri', route('tags.subscribe', $tag->slug))
				@slot('unsubscribe_uri', route('tags.unsubscribe', $tag->slug))
			@endcomponent
	    @endauth
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

