@extends('public.base')

@section('content_header')
	<div class="text-center">{{ $tag->title }}</div>
@endsection

@section('content')

	<div class="text-center">
		<h5 class="text-muted text-center">{{ $tag->slug }}</h6>
		
		<h5>
			Subscriptions: {{ $tag->subscribers->count() }}
			| Questions: {{ $tag->questions->count() }}
		</h5>

	    @user_subscribed($tag->subscribers)
	      <a href="{{ route('tags.unsubscribe', $tag->slug) }}"
	      class="btn btn-outline-primary m-2">
	        Unsubscribe
	      </a>    
	    @else
	      <a href="{{ route('tags.subscribe', $tag->slug) }}"
	      class="btn btn-primary m-2">
	        Subscribe
	      </a>
	    @enduser_subscribed
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

